<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroProsesResource\Pages;
use App\Models\HeroProses;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class HeroProsesResource extends Resource
{
    protected static ?string $model = HeroProses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): string
    {
        return 'Hero';  // Mengubah label menjadi "Hero"
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hero_title')
                    ->label('Hero Title')
                    ->required()
                    ->default('Default Hero Title'),

                Forms\Components\TextInput::make('hero_subtitle')
                    ->label('Hero Subtitle')
                    ->required()
                    ->default('Default Hero Subtitle'),

                Forms\Components\Textarea::make('hero_description')
                    ->label('Hero Description')
                    ->required()
                    ->default('Default Hero Description'),

                FileUpload::make('hero_image')
                    ->label('Hero Image')
                    ->image()
                    ->directory('public/heroes')
                    ->maxSize(1024)
                    ->disk('public')
                    ->visibility('public'),

                Forms\Components\TextInput::make('hero_cta_link')
                    ->label('Hero CTA Link')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('hero_cta_text')
                    ->label('Hero CTA Text')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ ])
            ->filters([ ])
            ->actions([ Tables\Actions\EditAction::make() ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make() ]) ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroProses::route('/'),
            'create' => Pages\CreateHeroProses::route('/create'),
            'edit' => Pages\EditHeroProses::route('/{record}/edit'),
        ];
    }

    public static function saveToFile($data)
    {
        $heroProsesData = json_encode([
            'hero_title' => $data['hero_title'],
            'hero_subtitle' => $data['hero_subtitle'],
            'hero_description' => $data['hero_description'],
            'hero_cta_link' => $data['hero_cta_link'],
            'hero_cta_text' => $data['hero_cta_text'],
            // 'hero_image' => asset('storage/' . $data['hero_image']) // Simpan path gambar relatif
            'hero_image' => asset($data['hero_image']) // Simpan path gambar relatif
        ]);

        Storage::disk('local')->put('company_profile_hero_proses.json', $heroProsesData);
    }
}
