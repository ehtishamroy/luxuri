<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageMedia\Pages\CreateHomepageMedia;
use App\Filament\Resources\HomepageMedia\Pages\EditHomepageMedia;
use App\Filament\Resources\HomepageMedia\Pages\ListHomepageMedia;
use App\Models\HomepageMedia;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomepageMediaResource extends Resource
{
    protected static ?string $model = HomepageMedia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Homepage Media';

    protected static ?string $modelLabel = 'Media Item';

    protected static ?string $pluralModelLabel = 'Media Items';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Media Details')
                    ->schema([
                        Select::make('key')
                            ->label('Website Section')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->options([
                                'hero_video_1' => 'Hero Video - Slide 1',
                                'hero_video_2' => 'Hero Video - Slide 2',
                                'hero_video_3' => 'Hero Video - Slide 3',
                                'hero_video_4' => 'Hero Video - Slide 4',
                                'hero_video_5' => 'Hero Video - Slide 5',
                                'middle_section_image' => 'Middle Section (Concierge Background Image)',
                            ])
                            ->helperText('Select the specific section on the homepage where this media should be displayed.'),

                        TextInput::make('label')
                            ->label('Label')
                            ->required()
                            ->placeholder('Hero Video 1'),

                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'image' => 'Image',
                                'video' => 'Video',
                            ])
                            ->required()
                            ->default('image'),

                        FileUpload::make('file_path')
                            ->label('File')
                            ->disk('public')
                            ->directory('homepage')
                            ->maxSize(51200)
                            ->columnSpanFull(),

                        FileUpload::make('poster_path')
                            ->label('Video Poster (optional)')
                            ->image()
                            ->disk('public')
                            ->directory('homepage')
                            ->maxSize(4096)
                            ->visible(fn ($get) => $get('type') === 'video')
                            ->columnSpanFull(),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Section')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'hero_video_1' => 'Hero Video - Slide 1',
                        'hero_video_2' => 'Hero Video - Slide 2',
                        'hero_video_3' => 'Hero Video - Slide 3',
                        'hero_video_4' => 'Hero Video - Slide 4',
                        'hero_video_5' => 'Hero Video - Slide 5',
                        'middle_section_image' => 'Middle Section',
                        default => ucwords(str_replace('_', ' ', $state)),
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'video' => 'warning',
                        default => 'success',
                    }),
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->square()
                    ->height(48),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomepageMedia::route('/'),
            'create' => CreateHomepageMedia::route('/create'),
            'edit' => EditHomepageMedia::route('/{record}/edit'),
        ];
    }
}
