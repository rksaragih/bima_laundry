<?php

namespace App\Filament\Resources\HeroProsesResource\Pages;

use App\Filament\Resources\HeroProsesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeroProses extends EditRecord
{
    protected static string $resource = HeroProsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
