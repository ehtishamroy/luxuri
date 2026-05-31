<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConciergeService\Pages\CreateConciergeService;
use App\Filament\Resources\ConciergeService\Pages\EditConciergeService;
use App\Filament\Resources\ConciergeService\Pages\ManageConciergeServices;
use App\Models\ConciergeService;
use App\Services\OpenAIConciergeGenerator;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ConciergeServiceResource extends Resource
{
    protected static ?string $model = ConciergeService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Concierge Services';

    protected static ?string $modelLabel = 'Concierge Service';

    protected static ?string $pluralModelLabel = 'Concierge Services';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('AI Generator')
                    ->description('Describe the service briefly and let AI write the content. Images must still be uploaded manually.')
                    ->schema([
                        Textarea::make('ai_prompt')
                            ->label('Describe the service')
                            ->placeholder('e.g. Private yacht dinner with a Michelin-star chef in Miami')
                            ->rows(2)
                            ->dehydrated(false)
                            ->live()
                            ->columnSpanFull(),

                        Actions::make([
                            \Filament\Actions\Action::make('generate_with_ai')
                                ->label('Generate with AI')
                                ->icon('heroicon-m-sparkles')
                                ->color('success')
                                ->requiresConfirmation()
                                ->modalHeading('Generate with AI')
                                ->modalDescription('This will overwrite the Title and Description fields.')
                                ->action(function (\Filament\Schemas\Components\Utilities\Set $set, \Filament\Schemas\Components\Utilities\Get $get) {
                                    $prompt = $get('ai_prompt');

                                    if (blank($prompt)) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('Prompt is empty')
                                            ->body('Please describe the service first.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    try {
                                        $generator = new OpenAIConciergeGenerator();
                                        $data = $generator->generate($prompt);

                                        $set('title', $data['title'] ?? '');
                                        $set('description', $data['description'] ?? '');

                                        \Filament\Notifications\Notification::make()
                                            ->title('AI content generated successfully')
                                            ->success()
                                            ->send();
                                    } catch (\Exception $e) {
                                        \Filament\Notifications\Notification::make()
                                            ->title('AI generation failed')
                                            ->body($e->getMessage())
                                            ->danger()
                                            ->send();
                                    }
                                }),
                        ]),
                    ])
                    ->collapsible()
                    ->collapsed(fn ($record) => $record !== null),

                Section::make('Service Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('concierge')
                            ->maxSize(4096)
                            ->columnSpanFull(),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->square()
                    ->size(60),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageConciergeServices::route('/'),
            'create' => CreateConciergeService::route('/create'),
            'edit' => EditConciergeService::route('/{record}/edit'),
        ];
    }
}
