<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageSetting\Pages\EditHomepageSetting;
use App\Filament\Resources\HomepageSetting\Pages\ManageSettings;
use App\Models\HomepageSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class HomepageSettingResource extends Resource
{
    protected static ?string $model = HomepageSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog;

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $modelLabel = 'Setting';

    protected static ?string $pluralModelLabel = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Branding')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Website Logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->maxSize(4096)
                            ->columnSpanFull(),

                        FileUpload::make('contact_image')
                            ->label('Contact Page Image')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->maxSize(4096)
                            ->columnSpanFull(),
                    ]),

                Section::make('Global Contact & Policies')
                    ->description('These values are used as fallbacks when a villa does not have its own contact info or policies set.')
                    ->schema([
                        TextInput::make('global_contact_phone')
                            ->label('Global Contact Phone')
                            ->tel()
                            ->placeholder('+1 234 567 8900')
                            ->nullable(),

                        TextInput::make('global_contact_email')
                            ->label('Global Contact Email')
                            ->email()
                            ->placeholder('concierge@luxuri.com')
                            ->nullable(),

                        Textarea::make('global_policies_text')
                            ->label('Global Policies')
                            ->rows(4)
                            ->placeholder('Payment terms, cancellation policy, house rules, etc.')
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('global_processing_fee_text')
                            ->label('Processing Fee Notice')
                            ->rows(2)
                            ->placeholder('For those using credit cards, you will be subject to a 3% processing fee once Luxuri confirms your booking.')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Global Yacht Contact & Policies')
                    ->description('These values are used on yacht detail pages and inquiry forms.')
                    ->schema([
                        TextInput::make('global_yacht_contact_phone')
                            ->label('Global Yacht Contact Phone')
                            ->tel()
                            ->placeholder('+1 (786) 981-0924')
                            ->nullable(),

                        TextInput::make('global_yacht_contact_email')
                            ->label('Global Yacht Contact Email')
                            ->email()
                            ->placeholder('yachts@luxuri.com')
                            ->nullable(),

                        Textarea::make('global_yacht_policies_text')
                            ->label('Global Yacht Policies')
                            ->rows(4)
                            ->placeholder('• Rates do not include fuel, docking fees, or crew gratuity\n• Captain and crew included\n• Catering available upon request')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->description('General contact details displayed in the footer and contact page.')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+1 (786) 981-0924')
                            ->nullable(),

                        TextInput::make('mobile_phone')
                            ->label('Mobile Number')
                            ->tel()
                            ->placeholder('+1 (305) 645-3336')
                            ->nullable(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->placeholder('hello@luxteria.co')
                            ->nullable(),

                        TextInput::make('copyright_text')
                            ->label('Copyright Text')
                            ->placeholder('&copy; 2026 LUXTERIA. All rights reserved.')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Social Media Links')
                    ->description('Leave empty to hide a social icon from the footer.')
                    ->schema([
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->placeholder('https://www.instagram.com/luxuri/')
                            ->nullable(),

                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->placeholder('https://www.facebook.com/luxurirentals')
                            ->nullable(),

                        TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->placeholder('https://www.tiktok.com/@luxuri.rent')
                            ->nullable(),

                        TextInput::make('pinterest_url')
                            ->label('Pinterest URL')
                            ->url()
                            ->placeholder('https://www.pinterest.com/luxuri1/')
                            ->nullable(),

                        TextInput::make('google_maps_url')
                            ->label('Google Maps URL')
                            ->url()
                            ->placeholder('https://www.google.com/maps/place/...')
                            ->nullable(),

                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->placeholder('https://www.linkedin.com/company/luxuri/')
                            ->nullable(),

                        TextInput::make('threads_url')
                            ->label('Threads URL')
                            ->url()
                            ->placeholder('https://www.threads.net/@luxuri')
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSettings::route('/'),
            'edit' => EditHomepageSetting::route('/{record}/edit'),
        ];
    }
}
