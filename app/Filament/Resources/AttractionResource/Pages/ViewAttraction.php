<?php

namespace App\Filament\Resources\AttractionResource\Pages;

use App\Filament\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttraction extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = AttractionResource::class;

    public static function getNavigationLabel(): string
    {
        return 'View';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // Actions\EditAction::make(),
        ];
    }
}
