<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIConciergeGenerator
{
    public function generate(string $prompt): array
    {
        $systemPrompt = <<<PROMPT
You are a luxury concierge copywriter for a high-end villa rental and lifestyle company.
Based on the user's brief description, generate a complete concierge service entry.

Return ONLY a valid JSON object with these exact keys:
{
  "title": "Compelling service title (max 40 chars)",
  "description": "Rich, enticing HTML paragraph. Use <p> tags. Describe the luxury experience in 2-3 sentences. Make it feel exclusive and personalized.",
  "image_alt": "Descriptive alt text for the service image"
}

Rules:
- Do not wrap the JSON in markdown code blocks.
- Keep descriptions elegant and concise.
PROMPT;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('openai.api_key'),
            'Content-Type' => 'application/json',
        ])->timeout(60)->post('https://api.openai.com/v1/chat/completions', [
            'model' => config('openai.model'),
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 800,
        ]);

        if ($response->failed()) {
            throw new \Exception('OpenAI API error: ' . $response->body());
        }

        $content = $response->json('choices.0.message.content');

        // Clean up markdown code blocks if present
        $content = preg_replace('/^```json\s*/', '', $content);
        $content = preg_replace('/```\s*$/', '', $content);
        $content = trim($content);

        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Failed to parse AI response as JSON: ' . json_last_error_msg());
        }

        return $data;
    }
}
