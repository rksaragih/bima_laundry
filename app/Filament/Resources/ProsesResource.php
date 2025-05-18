<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProsesResource\Pages;
use App\Models\Proses;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;

class ProsesResource extends Resource
{
    protected static ?string $model = Proses::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->required(),
            FileUpload::make('image')
                ->image()
                ->directory('proses')
                ->maxSize(1024)
                ->disk('public')
                ->visibility('public')
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state) {
                        $set('image', $state->hashName());
                    }
                }),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('title'),
            TextColumn::make('image')
                ->url(fn ($record) => Storage::url($record->image))
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProses::route('/'),
            'create' => Pages\CreateProses::route('/create'),
            'edit' => Pages\EditProses::route('/{record}/edit'),
        ];
    }
}
