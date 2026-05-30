<?php

namespace App\Filament\Resources\HomepageSetting\Pages;

use App\Filament\Resources\HomepageSettingResource;
use App\Models\HomepageSetting;
use Filament\Resources\Pages\Page;

class ManageSettings extends Page
{
    protected static string $resource = HomepageSettingResource::class;

    protected string $view = 'filament.resources.homepage-setting.pages.manage-settings';

    public function mount(): void
    {
        $settings = HomepageSetting::firstOrCreate([]);
        $this->redirect('/admin/homepage-settings/' . $settings->id . '/edit');
    }
}
