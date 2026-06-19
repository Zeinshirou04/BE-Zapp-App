<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
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

            Section::make('Media')->components([
                FileUpload::make('cover_image_url')
                    ->label('Cover Image')
                    ->image()
                    ->disk('public')
                    ->directory('projects/covers')
                    ->columnSpanFull(),
            ]),

            Section::make('Tech Stack')->components([
                Repeater::make('stack')
                    ->label('')
                    ->schema([
                        TextInput::make('name')
                            ->label('Technology')
                            ->required()
                            ->placeholder('e.g. Laravel')
                            ->maxLength(100),

                        TextInput::make('version')
                            ->label('Version')
                            ->placeholder('e.g. 12.x')
                            ->maxLength(50),
                    ])
                    ->columns(2)
                    ->addActionLabel('Add Technology')
                    ->reorderable()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string =>
                        $state['name']
                            ? trim($state['name'] . ' ' . ($state['version'] ?? ''))
                            : null
                    )
                    // Deduplicate by name (case-insensitive) on save
                    ->mutateDehydratedStateUsing(function (?array $state): array {
                        if (empty($state)) return [];

                        $seen = [];
                        $result = [];

                        foreach ($state as $item) {
                            $key = strtolower(trim($item['name'] ?? ''));
                            if ($key === '' || isset($seen[$key])) continue;
                            $seen[$key] = true;
                            $result[] = [
                                'name'    => trim($item['name']),
                                'version' => trim($item['version'] ?? ''),
                            ];
                        }

                        return $result;
                    })
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