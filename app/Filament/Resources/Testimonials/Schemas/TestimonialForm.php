<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Client Info')->components([
                TextInput::make('client_name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('client_photo')
                    ->label('Client Photo')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->nullable(),
            ])->columns(2),

            Section::make('Testimonial')->components([
                Textarea::make('quote')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]),

        ]);
    }
}