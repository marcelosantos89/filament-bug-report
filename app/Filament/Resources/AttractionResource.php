<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttractionResource\Pages;
use App\Filament\Resources\AttractionResource\RelationManagers\SeoRelationManager;
use App\Models\Attraction;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\Page;
use Filament\Pages\SubNavigationPosition;

class AttractionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Attraction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Main')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->lazy()
                                    ->required()
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                        if (! $get('is_slug_changed_manually') && filled($state)) {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('is_slug_changed_manually', true);
                                    })
                                    ->unique(table: Attraction::class, ignoreRecord: true),

                                Forms\Components\MarkdownEditor::make('description'),

                                CuratorPicker::make('media_id')
                                    ->label('Header Image')
                                    ->required(),

                                Forms\Components\TextInput::make('highlight_text')
                                    ->required(),

                                Forms\Components\MarkdownEditor::make('chat_text'),
                            ]),

                        Section::make('Content')
                            ->schema([
                                Repeater::make('content')
                                    ->label('Top 10')
                                    ->collapsible()
                                    ->collapsed(fn (string $operation): bool => $operation === 'view')
                                    ->reorderable()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),

                                        Forms\Components\MarkdownEditor::make('description')
                                            ->required(),

                                        Forms\Components\TextInput::make('external_url')
                                            ->required(),

                                        // CuratorPicker::make('image')
                                        //     ->required(),
                                    ])
                            ]),
                    ])->columnSpan(['lg' => 8]),

                Group::make()
                    ->schema([
                        Section::make('Options')
                            ->schema([
                                Forms\Components\Select::make('recommended')
                                    ->label('Recommended')
                                    ->options(Attraction::all()->pluck('name', 'id'))
                                    ->searchable(),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->inline(false)
                                    ->required(),
                            ])
                    ])->columnSpan(['lg' => 4])
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('slug')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // SeoRelationManager::class
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewAttraction::class,
            Pages\EditAttraction::class,
            Pages\ManageSeo::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttractions::route('/'),
            'create' => Pages\CreateAttraction::route('/create'),
            'view' => Pages\ViewAttraction::route('/{record}'),
            'edit' => Pages\EditAttraction::route('/{record}/edit'),
            'seo' => Pages\ManageSeo::route('/{record}/seo'),
        ];
    }
}
