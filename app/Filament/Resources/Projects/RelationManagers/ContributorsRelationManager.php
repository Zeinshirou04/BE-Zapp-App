<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContributorsRelationManager extends RelationManager
{
    protected static string $relationship = 'contributors';

    protected static ?string $relatedResource = ProjectResource::class;
    
    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
{
    return 'Contributors';
}

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('role'),

                TextColumn::make('user.name')
                    ->label('Linked User')
                    ->placeholder('—'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->form([
                        Select::make('user_id')
                            ->label('Link to User (optional)')
                            ->options(User::pluck('name', 'id'))
                            ->nullable()
                            ->searchable(),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('role')
                            ->default('Member')
                            ->maxLength(255),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->form([
                        Select::make('user_id')
                            ->label('Link to User (optional)')
                            ->options(User::pluck('name', 'id'))
                            ->nullable()
                            ->searchable(),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('role')
                            ->default('Member')
                            ->maxLength(255),
                    ]),
                DeleteAction::make(),
            ]);
    }
}