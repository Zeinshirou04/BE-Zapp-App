<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LinksRelationManager extends RelationManager
{
    protected static string $relationship = 'links';

    protected static ?string $relatedResource = ProjectResource::class;

    protected static ?string $title = 'Links';
    protected static ?string $modelLabel = 'Link';

    private function linkForm(): array
    {
        return [
            TextInput::make('label')
                ->required()
                ->maxLength(100)
                ->placeholder('e.g. GitHub Repo, Live Site, Demo Video'),

            Select::make('type')
                ->options([
                    'repo'  => 'Repository',
                    'site'  => 'Live Site',
                    'video' => 'Video',
                    'doc'   => 'Document / PDF',
                    'other' => 'Other',
                ])
                ->default('other')
                ->required(),

            TextInput::make('url')
                ->url()
                ->required()
                ->maxLength(2048)
                ->columnSpanFull(),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable(),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'repo'  => 'gray',
                        'site'  => 'success',
                        'video' => 'danger',
                        'doc'   => 'warning',
                        default => 'primary',
                    }),

                TextColumn::make('url')
                    ->limit(50)
                    ->copyable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                CreateAction::make()->form($this->linkForm()),
            ])
            ->recordActions([
                EditAction::make()->form($this->linkForm()),
                DeleteAction::make(),
            ]);
    }
}