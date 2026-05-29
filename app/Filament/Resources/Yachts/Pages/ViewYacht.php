<?php

namespace App\Filament\Resources\Yachts\Pages;

use App\Filament\Resources\Yachts\YachtResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewYacht extends ViewRecord
{
    protected static string $resource = YachtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
