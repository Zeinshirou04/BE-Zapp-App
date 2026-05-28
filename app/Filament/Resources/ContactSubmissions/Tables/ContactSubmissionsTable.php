<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('from_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('from_email')
                    ->searchable(),

                TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'unread',
                        'primary' => 'read',
                        'success' => 'replied',
                        'gray'    => 'archived',
                    ]),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'unread'   => 'Unread',
                        'read'     => 'Read',
                        'replied'  => 'Replied',
                        'archived' => 'Archived',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}