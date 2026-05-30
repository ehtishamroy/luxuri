<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OpenAIVillaGenerator
{
    public function generate(string $prompt, array $availableAmenities): array
    {
        $amenitiesList = implode(', ', $availableAmenities);

        $systemPrompt = <<<PROMPT
You are a luxury villa listing copywriter. Based on the user's brief description, generate a complete villa listing.

Return ONLY a valid JSON object with these exact keys:
{
  "title": "Compelling villa title (max 60 chars)",
  "slug": "url-friendly-slug",
  "price_per_night": 2500.00,
  "price_per_hour": 350.00,
  "bedrooms": 5,
  "bathrooms": 3,
  "max_guests": 10,
  "description": "Rich, detailed HTML description paragraphs. Use <p> tags. Make it luxurious and enticing. At least 3 paragraphs.",
  "amenity_names": ["Pool", "WiFi", "Air Conditioning"],
  "location": "City, Country",
  "meta_title": "SEO title (max 60 chars)",
  "meta_description": "SEO meta description (max 160 chars)"
}

Rules:
- Guess max_guests based on bedrooms (typically 2 guests per bedroom, plus maybe 2 extra).
- price_per_hour should be roughly 1/7th to 1/10th of price_per_night.
- Only include amenity_names from this available list: {$amenitiesList}
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

        // Clean up markdown code blocks if present
        $content = preg_replace('/^```json\s*/', '', $content);
        $content = preg_replace('/```\s*$/', '', $content);
        $content = trim($content);

        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Failed to parse AI response as JSON: ' . json_last_error_msg());
        }

        // Ensure slug is valid
        $data['slug'] = Str::slug($data['slug'] ?? $data['title'] ?? 'villa');

        return $data;
    }
}
