<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Basic Info')->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->required()
                    ->options([
                        'saas'        => 'SaaS Application',
                        'api'         => 'REST API',
                        'frontend'    => 'Front End',
                        'maintenance' => 'Maintenance & Support',
                    ]),

                Textarea::make('description')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                TagsInput::make('includes')
                    ->label('What\'s Included')
                    ->placeholder('e.g. Source code, Documentation')
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Pricing & Availability')->components([
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),

                TextInput::make('duration')
                    ->required()
                    ->placeholder('e.g. 2-4 weeks')
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label('Active / Visible')
                    ->default(false),
            ])->columns(2),

        ]);
    }
}