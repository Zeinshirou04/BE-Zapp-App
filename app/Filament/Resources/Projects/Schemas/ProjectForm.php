<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Basic Info')->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Set $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Project::class, 'slug', ignoreRecord: true),

                Select::make('type')
                    ->required()
                    ->options([
                        'web'    => 'Web',
                        'api'    => 'API',
                        'mobile' => 'Mobile',
                        'other'  => 'Other',
                    ]),

                Textarea::make('brief')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Media & Stack')->components([
                FileUpload::make('cover_image_url')
                    ->label('Cover Image')
                    ->image()
                    ->disk('public')
                    ->directory('projects/covers')
                    ->columnSpanFull(),

                TagsInput::make('stack')
                    ->label('Tech Stack')
                    ->placeholder('e.g. Laravel, Next.js')
                    ->columnSpanFull(),
            ]),

            Section::make('Details')->components([
                TextInput::make('earning')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),

                Toggle::make('is_maintained')
                    ->label('Currently Maintained')
                    ->default(false),

                DatePicker::make('started_at')
                    ->required(),

                DatePicker::make('ended_at'),
            ])->columns(2),

        ]);
    }
}