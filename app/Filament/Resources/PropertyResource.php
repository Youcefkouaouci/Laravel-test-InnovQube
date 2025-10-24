<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Propriétés';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nom'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->label('Description'),

                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->numeric()
                    ->prefix('€')
                    ->label('Prix par nuit'),

                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->label('Localisation'),

                Forms\Components\TextInput::make('bedrooms')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Chambres'),

                Forms\Components\TextInput::make('bathrooms')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Salles de bain'),

                Forms\Components\TextInput::make('max_guests')
                    ->required()
                    ->numeric()
                    ->default(2)
                    ->label('Nombre max d\'invités'),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('properties')
                    ->label('Image'),

                Forms\Components\Toggle::make('is_available')
                    ->required()
                    ->default(true)
                    ->label('Disponible'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nom'),

                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label('Localisation'),

                Tables\Columns\TextColumn::make('price_per_night')
                    ->money('EUR')
                    ->sortable()
                    ->label('Prix/nuit'),

                Tables\Columns\TextColumn::make('bedrooms')
                    ->numeric()
                    ->sortable()
                    ->label('Chambres'),

                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Disponible'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Disponibilité'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
