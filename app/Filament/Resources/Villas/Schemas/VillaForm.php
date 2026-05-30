<?php

namespace App\Filament\Resources\Villas\Schemas;

use App\Models\Amenity;
use App\Models\Destination;
use App\Services\OpenAIVillaGenerator;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VillaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('AI Villa Generator')
                    ->description('Describe the villa briefly and let AI fill in the details. Images must still be uploaded manually.')
                    ->schema([
                        Textarea::make('ai_prompt')
                            ->label('Describe the villa')
                            ->placeholder('e.g. Luxury beachfront villa in Bali, 4 bedrooms, infinity pool, private chef, $3500 per night')
                            ->rows(3)
                            ->dehydrated(false)
                            ->live()
                            ->columnSpanFull(),

                        \Filament\Schemas\Components\Actions::make([
                            \Filament\Actions\Action::make('generate_with_ai')
                                ->label('Generate Villa with AI')
                                ->icon('heroicon-m-sparkles')
                                ->color('success')
                                ->requiresConfirmation()
                                ->modalHeading('Generate Villa with AI')
                                ->modalDescription('This will overwrite existing values in the form. Make sure you have described the villa clearly.')
                                ->action(function (\Filament\Schemas\Components\Utilities\Set $set, \Filament\Schemas\Components\Utilities\Get $get) {
                                    $prompt = $get('ai_prompt');

                                    if (blank($prompt)) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('Prompt is empty')
                                            ->body('Please describe the villa first.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    try {
                                        $availableAmenities = Amenity::pluck('name')->toArray();
                                        $generator = new OpenAIVillaGenerator();
                                        $data = $generator->generate($prompt, $availableAmenities);

                                        $set('title', $data['title'] ?? '');
                                        $set('slug', $data['slug'] ?? '');
                                        $set('price_per_night', $data['price_per_night'] ?? null);
                                        $set('price_per_hour', $data['price_per_hour'] ?? null);
                                        $set('bedrooms', $data['bedrooms'] ?? 1);
                                        $set('bathrooms', $data['bathrooms'] ?? 1);
                                        $set('max_guests', $data['max_guests'] ?? 2);
                                        $set('description', $data['description'] ?? '');
                                        $set('location', $data['location'] ?? '');
                                        $set('meta_title', $data['meta_title'] ?? '');
                                        $set('meta_description', $data['meta_description'] ?? '');

                                        // Set amenities
                                        if (!empty($data['amenity_names']) && is_array($data['amenity_names'])) {
                                            $matchedIds = Amenity::whereRaw('LOWER(name) IN (' . implode(',', array_map(fn ($n) => "'" . addslashes(strtolower($n)) . "'", $data['amenity_names'])) . ')')
                                                ->pluck('id')
                                                ->toArray();
                                            if (!empty($matchedIds)) {
                                                $set('amenitiesList', $matchedIds);
                                            }
                                        }

                                        \Filament\Notifications\Notification::make()
                                            ->title('Villa generated successfully')
                                            ->body('Title: ' . ($data['title'] ?? 'N/A'))
                                            ->success()
                                            ->send();
                                    } catch (\Exception $e) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('AI generation failed')
                                            ->body($e->getMessage())
                                            ->danger()
                                            ->send();
                                    }
                                })
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => filled($get('ai_prompt'))),
                        ])->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false)
                    ->columnSpanFull(),

                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('destination_id')
                            ->label('Destination')
                            ->options(Destination::pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),

                        RichEditor::make('description')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pricing & Capacity')
                    ->schema([
                        TextInput::make('price_per_night')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('Leave empty for "Contact Us" pricing')
                            ->nullable(),

                        TextInput::make('price_per_hour')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('Optional hourly rate')
                            ->nullable(),

                        TextInput::make('bedrooms')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('bathrooms')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('max_guests')
                            ->numeric()
                            ->default(2)
                            ->required(),
                    ])
                    ->columns(4),

                Section::make('Extra Fees')
                    ->schema([
                        Repeater::make('fees')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('e.g. Cleaning fee'),

                                TextInput::make('amount')
                                    ->numeric()
                                    ->prefix('$')
                                    ->required(),
                            ])
                            ->addable()
                            ->deletable()
                            ->reorderable()
                            ->defaultItems(0)
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    ]),

                Section::make('Location')
                    ->schema([
                        TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('City, Country')
                            ->live()
                            ->nullable(),

                        TextInput::make('address')
                            ->maxLength(255)
                            ->placeholder('Full address')
                            ->nullable(),

                        TextInput::make('latitude')
                            ->numeric()
                            ->placeholder('39.1911')
                            ->nullable(),

                        TextInput::make('longitude')
                            ->numeric()
                            ->placeholder('-106.8175')
                            ->nullable(),

                        \Filament\Schemas\Components\Actions::make([
                            \Filament\Actions\Action::make('fetch_coordinates')
                                ->label('Fetch Coordinates from Location')
                                ->icon('heroicon-m-map-pin')
                                ->color('primary')
                                ->requiresConfirmation()
                                ->modalHeading('Fetch Coordinates')
                                ->modalDescription('This will look up the latitude and longitude for the location you entered using OpenStreetMap.')
                                ->action(function (\Filament\Schemas\Components\Utilities\Set $set, \Filament\Schemas\Components\Utilities\Get $get) {
                                    $location = $get('location');

                                    if (blank($location)) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('Location is empty')
                                            ->body('Please enter a city or location first.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    $address = $get('address') ? $location . ' ' . $get('address') : $location;

                                    try {
                                        $response = \Illuminate\Support\Facades\Http::withHeaders([
                                            'User-Agent' => 'LuxuriVillaApp/1.0 (admin@luxuri.com)',
                                        ])->get('https://nominatim.openstreetmap.org/search', [
                                            'q' => $address,
                                            'format' => 'json',
                                            'limit' => 1,
                                        ]);

                                        $data = $response->json();

                                        if (empty($data) || !isset($data[0]['lat'], $data[0]['lon'])) {
                                            \Filament\Notifications\Notification::make()
                                                ->title('Location not found')
                                                ->body('Could not find coordinates for: ' . $location)
                                                ->warning()
                                                ->send();
                                            return;
                                        }

                                        $set('latitude', $data[0]['lat']);
                                        $set('longitude', $data[0]['lon']);

                                        \Filament\Notifications\Notification::make()
                                            ->title('Coordinates fetched')
                                            ->body('Lat: ' . $data[0]['lat'] . ', Lng: ' . $data[0]['lon'])
                                            ->success()
                                            ->send();
                                    } catch (\Exception $e) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('Geocoding failed')
                                            ->body($e->getMessage())
                                            ->danger()
                                            ->send();
                                    }
                                })
                                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => filled($get('location'))),
                        ])->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image (Hero Background)')
                            ->image()
                            ->disk('public')
                            ->directory('villa-images')
                            ->nullable(),

                        FileUpload::make('images')
                            ->label('Gallery Images')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->reorderable()
                            ->directory('villa-images')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Amenities')
                    ->schema([
                        Select::make('amenitiesList')
                            ->label('Select Amenities')
                            ->relationship('amenitiesList', 'name')
                            ->options(Amenity::pluck('name', 'id'))
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Policies & Contact')
                    ->schema([
                        TextInput::make('security_deposit_amount')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('Leave empty to hide on front-end')
                            ->nullable(),

                        Textarea::make('policies_text')
                            ->rows(3)
                            ->placeholder('Payment terms, cancellation policy, etc.')
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('contact_phone')
                            ->tel()
                            ->placeholder('+1 234 567 8900')
                            ->nullable(),

                        TextInput::make('contact_email')
                            ->email()
                            ->placeholder('concierge@luxuri.com')
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('Settings')
                    ->schema([
                        Toggle::make('featured')
                            ->default(false),

                        Toggle::make('active')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make('meta_description')
                            ->rows(2)
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }
}
