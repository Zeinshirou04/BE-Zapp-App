<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image_url')
                    ->label('Cover')
                    ->disk('public')
                    ->width(60)
                    ->height(40),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'web',
                        'success' => 'api',
                        'warning' => 'mobile',
                        'gray'    => 'other',
                    ]),

                IconColumn::make('is_maintained')
                    ->label('Maintained')
                    ->boolean(),

                TextColumn::make('started_at')
                    ->date('M Y')
                    ->sortable(),

                TextColumn::make('ended_at')
                    ->date('M Y')
                    ->placeholder('Ongoing'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('started_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'web'    => 'Web',
                        'api'    => 'API',
                        'mobile' => 'Mobile',
                        'other'  => 'Other',
                    ]),
                TernaryFilter::make('is_maintained')
                    ->label('Maintained'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}