<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $relatedResource = ProjectResource::class;

    protected static ?string $title = 'Images';
    protected static ?string $modelLabel = 'Image';

    private function imageForm(): array
    {
        return [
            FileUpload::make('path')
                ->label('Image')
                ->image()
                ->disk('public')
                ->directory('projects/images')
                ->required()
                ->columnSpanFull(),

            Select::make('type')
                ->options([
                    'screenshot'  => 'Screenshot',
                    'certificate' => 'Certificate',
                    'documentary' => 'Documentary',
                    'other'       => 'Other',
                ])
                ->default('screenshot')
                ->required(),

            TextInput::make('caption')
                ->maxLength(255),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->disk('public')
                    ->width(80)
                    ->height(50),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'certificate' => 'warning',
                        'documentary' => 'info',
                        'other'       => 'gray',
                        default       => 'primary', // screenshot
                    }),

                TextColumn::make('caption')
                    ->placeholder('No caption'),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                CreateAction::make()->form($this->imageForm()),
            ])
            ->recordActions([
                EditAction::make()->form($this->imageForm()),
                DeleteAction::make(),
            ]);
    }
}