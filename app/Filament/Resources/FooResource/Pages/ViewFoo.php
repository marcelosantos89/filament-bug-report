<?php

namespace App\Filament\Resources\FooResource\Pages;

use App\Filament\Resources\FooResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFoo extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = FooResource::class;

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
