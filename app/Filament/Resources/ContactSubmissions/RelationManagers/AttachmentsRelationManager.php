<?php

namespace App\Filament\Resources\ContactSubmissions\RelationManagers;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $relatedResource = ContactSubmissionResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('original_name')
                    ->label('File Name')
                    ->searchable(),

                TextColumn::make('mime_type')
                    ->label('Type'),

                TextColumn::make('size_bytes')
                    ->label('Size')
                    ->formatStateUsing(fn (int $state): string => number_format($state / 1024, 1) . ' KB'),

                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'asc')
            ->recordActions([
                DeleteAction::make(),
            ]);
    }
}