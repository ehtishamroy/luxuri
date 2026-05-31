<?php

namespace App\Filament\Resources\ConciergeService\Pages;

use App\Filament\Resources\ConciergeServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ManageConciergeServices extends ListRecords
{
    protected static string $resource = ConciergeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
