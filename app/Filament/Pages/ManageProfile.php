<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class ManageProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;
    protected static ?string $navigationLabel = 'Profile';
    protected static ?string $title = 'Manage Profile';
    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public function mount(): void
    {
        $profile = Profile::firstOrFail();
        $this->form->fill($profile->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                            ->rows(4),
                    ])->columns(1),

                Section::make('Photos')
                    ->description('Avatar = round frame. Portrait = full/half body PNG.')
                    ->schema([
                        Select::make('display_mode')
                            ->label('Display mode on About page')
                            ->options([
                                'avatar' => 'Round avatar',
                                'portrait' => 'Portrait image',
                            ])
                            ->required(),
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
                    ])->columns(1),

                Section::make('CV / Resume')
                    ->schema([
                        FileUpload::make('cv_path')
                            ->label('CV (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->disk('public')
                            ->directory('profile')
                            ->nullable(),
                    ]),

                Section::make('Social Links')
                    ->schema([
                        KeyValue::make('social_links')
                            ->label('Links')
                            ->keyLabel('Platform (e.g. github)')
                            ->valueLabel('URL')
                            ->nullable(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        Profile::first()->update($data);

        Notification::make()
            ->title('Profile updated')
            ->success()
            ->send();
    }
}