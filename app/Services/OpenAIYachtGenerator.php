<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OpenAIYachtGenerator
{
    public function generate(string $prompt): array
    {
        $systemPrompt = <<<PROMPT
You are a luxury yacht charter listing copywriter. Based on the user's brief description, generate a complete yacht listing.

Return ONLY a valid JSON object with these exact keys:
{
  "title": "Compelling yacht title (max 60 chars)",
  "slug": "url-friendly-slug",
  "make": "Yacht manufacturer",
  "style": "Motor Yacht / Sailing Yacht / Catamaran",
  "length_ft": 108,
  "cabins": 4,
  "max_guests": 13,
  "price_per_hour": 1875.00,
  "charter_4h_price": 7500.00,
  "charter_6h_price": 11250.00,
  "charter_8h_price": 14000.00,
  "includes": "10ft floating island, Jet ski, Snorkeling gear",
  "description": "Rich, detailed HTML description paragraphs. Use <p> tags. Make it luxurious and enticing. At least 3 paragraphs.",
  "location": "Miami, Florida",
  "crew_included": true,
  "catering_available": true,
  "meta_title": "SEO title (max 60 chars)",
  "meta_description": "SEO meta description (max 160 chars)"
}

Rules:
- Guess max_guests based on cabins and yacht size (typically 2-3 guests per cabin for charters).
- price_per_hour should be a reasonable hourly rate for the yacht described.
- charter_4h_price = price_per_hour * 4 (with slight discount possible)
- charter_6h_price = price_per_hour * 6 (with slight discount)
- charter_8h_price = price_per_hour * 8 (with best discount)
- includes should be a comma-separated list of notable inclusions/toys.
- crew_included and catering_available should be true for most luxury charters.
- Slug must be kebab-case, no special chars.
- All numeric values must be numbers, not strings.
- Do not wrap the JSON in markdown code blocks.
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
            'max_tokens' => 1500,
        ]);

        if ($response->failed()) {
            throw new \Exception('OpenAI API error: ' . $response->body());
        }

        $content = $response->json('choices.0.message.content');

        $content = preg_replace('/^```json\s*/', '', $content);
        $content = preg_replace('/```\s*$/', '', $content);
        $content = trim($content);

        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Failed to parse AI response as JSON: ' . json_last_error_msg());
        }

        $data['slug'] = Str::slug($data['slug'] ?? $data['title'] ?? 'yacht');

        return $data;
    }
}
