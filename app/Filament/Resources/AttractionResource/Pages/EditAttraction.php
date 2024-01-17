<?php

namespace App\Filament\Resources\AttractionResource\Pages;

use App\Filament\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttraction extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = AttractionResource::class;

    public static function getNavigationLabel(): string
    {
        return 'Edit';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
