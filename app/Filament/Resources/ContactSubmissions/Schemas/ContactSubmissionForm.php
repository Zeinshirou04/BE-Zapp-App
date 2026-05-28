<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Sender Info')->components([
                TextInput::make('from_name')
                    ->disabled(),

                TextInput::make('from_email')
                    ->email()
                    ->disabled(),

                TextInput::make('from_phone')
                    ->disabled(),

                TextInput::make('subject')
                    ->disabled()
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Message')->components([
                Textarea::make('content')
                    ->disabled()
                    ->rows(6)
                    ->columnSpanFull(),
            ]),

            Section::make('Status')->components([
                Select::make('status')
                    ->required()
                    ->options([
                        'unread'    => 'Unread',
                        'read'      => 'Read',
                        'replied'   => 'Replied',
                        'archived'  => 'Archived',
                    ]),
            ]),

        ]);
    }
}