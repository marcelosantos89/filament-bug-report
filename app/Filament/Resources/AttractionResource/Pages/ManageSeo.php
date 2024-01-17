<?php

namespace App\Filament\Resources\AttractionResource\Pages;

use App\Filament\Resources\AttractionResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions;

class ManageSeo extends ManageRelatedRecords
{
    use \Filament\Resources\RelationManagers\Concerns\Translatable;
    protected static string $resource = AttractionResource::class;

    protected static string $relationship = 'seo';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        return "Manage {$this->getRecordTitle()} SEO";
    }

    public function getBreadcrumb(): string
    {
        return 'SEO';
    }

    public static function getNavigationLabel(): string
    {
        return 'SEO';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Title'),

                        Textarea::make('description')
                            ->label('Description'),

                        CuratorPicker::make('media_id')
                            ->label('Image'),

                        TextInput::make('author')
                            ->label('Author'),

                        TextInput::make('canonical_url')
                            ->label('Canonical Url'),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),

                Tables\Columns\TextColumn::make('description'),

                Tables\Columns\TextColumn::make('author')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add SEO'),
                    // ->disabled(fn (ManageRelatedRecords $livewire): bool => $livewire->getOwnerRecord()?->seo->count() >= 1),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}