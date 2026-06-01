<?php

namespace App\Filament\Resources\Yachts\Schemas;

use App\Services\OpenAIYachtGenerator;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class YachtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('AI Yacht Generator')
                    ->description('Describe the yacht briefly and let AI fill in the details. Images must still be uploaded manually.')
                    ->schema([
                        Textarea::make('ai_prompt')
                            ->label('Describe the yacht')
                            ->placeholder('e.g. 108ft Mangusta motor yacht in Miami, 4 cabins, 13 guests, includes floating island and jet ski, $1875/hour')
                            ->rows(3)
                            ->dehydrated(false)
                            ->live()
                            ->columnSpanFull(),

                        \Filament\Schemas\Components\Actions::make([
                            \Filament\Actions\Action::make('generate_with_ai')
                                ->label('Generate Yacht with AI')
                                ->icon('heroicon-m-sparkles')
                                ->color('success')
                                ->requiresConfirmation()
                                ->modalHeading('Generate Yacht with AI')
                                ->modalDescription('This will overwrite existing values in the form. Make sure you have described the yacht clearly.')
                                ->action(function (\Filament\Schemas\Components\Utilities\Set $set, \Filament\Schemas\Components\Utilities\Get $get) {
                                    $prompt = $get('ai_prompt');

                                    if (blank($prompt)) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('Prompt is empty')
                                            ->body('Please describe the yacht first.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    try {
                                        $generator = new OpenAIYachtGenerator();
                                        $data = $generator->generate($prompt);

                                        $set('title', $data['title'] ?? '');
                                        $set('slug', $data['slug'] ?? '');
                                        $set('make', $data['make'] ?? '');
                                        $set('style', $data['style'] ?? '');
                                        $set('length_ft', $data['length_ft'] ?? null);
                                        $set('cabins', $data['cabins'] ?? 1);
                                        $set('max_guests', $data['max_guests'] ?? 2);
                                        $set('price_per_hour', $data['price_per_hour'] ?? null);
                                        $set('charter_4h_price', $data['charter_4h_price'] ?? null);
                                        $set('charter_6h_price', $data['charter_6h_price'] ?? null);
                                        $set('charter_8h_price', $data['charter_8h_price'] ?? null);
                                        $set('includes', $data['includes'] ?? '');
                                        $set('description', $data['description'] ?? '');
                                        $set('location', $data['location'] ?? '');
                                        $set('crew_included', $data['crew_included'] ?? false);
                                        $set('catering_available', $data['catering_available'] ?? false);
                                        $set('meta_title', $data['meta_title'] ?? '');
                                        $set('meta_description', $data['meta_description'] ?? '');

                                        \Filament\Notifications\Notification::make()
                                            ->title('Yacht generated successfully')
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
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('make')
                            ->maxLength(255)
                            ->placeholder('e.g. Sunseeker, Ferretti, Azimut')
                            ->nullable(),

                        TextInput::make('style')
                            ->maxLength(255)
                            ->placeholder('e.g. Motor Yacht, Sailing Yacht, Catamaran')
                            ->nullable(),

                        Textarea::make('includes')
                            ->label('Includes')
                            ->placeholder('e.g. 10ft floating island, Jet ski, Snorkeling gear')
                            ->rows(2)
                            ->nullable()
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Specifications & Pricing')
                    ->schema([
                        TextInput::make('length_ft')
                            ->numeric()
                            ->label('Length (ft)')
                            ->placeholder('108')
                            ->nullable(),

                        TextInput::make('cabins')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        TextInput::make('max_guests')
                            ->numeric()
                            ->default(2)
                            ->required(),

                        TextInput::make('price_per_day')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('Leave empty for "Contact Us" pricing')
                            ->nullable(),

                        TextInput::make('price_per_hour')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('e.g. 1875')
                            ->nullable(),

                        TextInput::make('charter_4h_price')
                            ->numeric()
                            ->prefix('$')
                            ->label('4 Hour Charter Price')
                            ->placeholder('e.g. 7500')
                            ->nullable(),

                        TextInput::make('charter_6h_price')
                            ->numeric()
                            ->prefix('$')
                            ->label('6 Hour Charter Price')
                            ->placeholder('e.g. 11250')
                            ->nullable(),

                        TextInput::make('charter_8h_price')
                            ->numeric()
                            ->prefix('$')
                            ->label('8 Hour Charter Price')
                            ->placeholder('e.g. 14000')
                            ->nullable(),
                    ])
                    ->columns(4),

                Section::make('Crew & Services')
                    ->schema([
                        Toggle::make('crew_included')
                            ->label('Captain & Crew Included')
                            ->default(false),

                        Toggle::make('catering_available')
                            ->label('Catering Available')
                            ->default(false),
                    ])
                    ->columns(2),

                Section::make('Location')
                    ->schema([
                        TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('e.g. Monaco, French Riviera')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image (Hero Background)')
                            ->image()
                            ->disk('public')
                            ->directory('yacht-images')
                            ->nullable(),

                        FileUpload::make('images')
                            ->label('Gallery Images')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->reorderable()
                            ->directory('yacht-images')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Tags')
                    ->schema([
                        TagsInput::make('tags')
                            ->placeholder('Add tags')
                            ->separator(',')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

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
