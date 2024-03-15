<?php

namespace App\Filament\Resources\FooResource\Pages;

use App\Filament\Resources\FooResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoos extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = FooResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
