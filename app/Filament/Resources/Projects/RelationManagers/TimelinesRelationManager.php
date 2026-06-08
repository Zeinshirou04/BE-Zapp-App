<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimelinesRelationManager extends RelationManager
{
    protected static string $relationship = 'timelines';

    protected static ?string $relatedResource = ProjectResource::class;

    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
    {
        return 'Timelines';
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('occurred_at')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('description')
                    ->limit(60)
                    ->placeholder('No description'),
            ])
            ->defaultSort('occurred_at', 'asc')
            ->headerActions([
                CreateAction::make()
                    ->form([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        DatePicker::make('occurred_at')
                            ->required(),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->form([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        DatePicker::make('occurred_at')
                            ->required(),
                    ]),
                DeleteAction::make(),
            ]);
    }
}