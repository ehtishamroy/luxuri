<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Lead\Pages\ManageLeads;
use App\Models\Lead;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'Leads';

    protected static ?string $modelLabel = 'Lead';

    protected static ?string $pluralModelLabel = 'Leads';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->options([
                                'villa' => 'Villa',
                                'yacht' => 'Yacht',
                            ])
                            ->required(),

                        TextInput::make('villa.title')
                            ->label('Villa')
                            ->disabled()
                            ->visible(fn ($record) => $record?->villa_id),

                        TextInput::make('yacht.title')
                            ->label('Yacht')
                            ->disabled()
                            ->visible(fn ($record) => $record?->yacht_id),
                    ])
                    ->columns(2),

                Section::make('Inquiry Details')
                    ->schema([
                        DatePicker::make('check_in')
                            ->nullable(),

                        DatePicker::make('check_out')
                            ->nullable(),

                        TextInput::make('guests')
                            ->numeric()
                            ->nullable(),

                        Textarea::make('message')
                            ->rows(3)
                            ->nullable(),

                        TextInput::make('referral_source')
                            ->label('Referral Source')
                            ->nullable(),

                        Toggle::make('marketing_consent')
                            ->label('Marketing Consent')
                            ->disabled(),
                    ])
                    ->columns(2),

                Section::make('Admin')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'converted' => 'Converted',
                                'closed' => 'Closed',
                            ])
                            ->required(),

                        Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3)
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'villa',
                        'success' => 'yacht',
                    ]),

                TextColumn::make('villa.title')
                    ->label('Villa')
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('yacht.title')
                    ->label('Yacht')
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('check_in')
                    ->date('M j, Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('check_out')
                    ->date('M j, Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('guests')
                    ->placeholder('—')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'contacted',
                        'success' => 'converted',
                        'secondary' => 'closed',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('new')
                    ->label('New')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'new')),

                Filter::make('contacted')
                    ->label('Contacted')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'contacted')),

                Filter::make('converted')
                    ->label('Converted')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'converted')),

                Filter::make('villa')
                    ->label('Villa Leads')
                    ->query(fn (Builder $query): Builder => $query->where('type', 'villa')),

                Filter::make('yacht')
                    ->label('Yacht Leads')
                    ->query(fn (Builder $query): Builder => $query->where('type', 'yacht')),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLeads::route('/'),
        ];
    }
}
