<?php

namespace App\Filament\Resources\HomepageMedia\Pages;

use App\Filament\Resources\HomepageMediaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomepageMedia extends ListRecords
{
    protected static string $resource = HomepageMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
