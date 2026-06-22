<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identity')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('job_title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('bio')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Photos')
                    ->description('Avatar = round frame. Portrait = full/half body PNG.')
                    ->schema([
                        Select::make('display_mode')
                            ->label('Display mode on About page')
                            ->options([
                                'avatar'   => 'Round avatar',
                                'portrait' => 'Portrait image',
                            ])
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('avatar_path')
                            ->label('Avatar (square crop works best)')
                            ->image()
                            ->disk('public')
                            ->directory('profile')
                            ->imageEditor()
                            ->nullable(),
                        FileUpload::make('portrait_path')
                            ->label('Portrait (PNG with transparent bg recommended)')
                            ->image()
                            ->disk('public')
                            ->directory('profile')
                            ->nullable(),
                    ])->columns(2),

                Section::make('CV / Resume')
                    ->schema([
                        FileUpload::make('cv_path')
                            ->label('CV (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->disk('public')
                            ->directory('profile')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Social Links')
                    ->schema([
                        KeyValue::make('social_links')
                            ->label('Links')
                            ->keyLabel('Platform (e.g. github)')
                            ->valueLabel('URL')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}