<?php

namespace App\Filament\Resources\FooResource\Pages;

use App\Filament\Resources\FooResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoo extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = FooResource::class;

    public static function getNavigationLabel(): string
    {
        return 'Edit';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
