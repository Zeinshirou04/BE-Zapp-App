<?php

namespace App\Filament\Resources\Profiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_path')
                    ->label('Avatar')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('job_title')
                    ->searchable(),
                TextColumn::make('display_mode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'avatar'   => 'success',
                        'portrait' => 'info',
                        default    => 'gray',
                    }),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}