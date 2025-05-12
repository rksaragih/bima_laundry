<?php

namespace App\Filament\Resources\HeroProsesResource\Pages;

use App\Filament\Resources\HeroProsesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroProses extends ListRecords
{
    protected static string $resource = HeroProsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
