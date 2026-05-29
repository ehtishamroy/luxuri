<?php

namespace App\Filament\Resources\Yachts\Pages;

use App\Filament\Resources\Yachts\YachtResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListYachts extends ListRecords
{
    protected static string $resource = YachtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
