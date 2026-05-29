<?php

namespace App\Filament\Resources\MagazinePosts\Pages;

use App\Filament\Resources\MagazinePosts\MagazinePostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMagazinePost extends CreateRecord
{
    protected static string $resource = MagazinePostResource::class;
}
