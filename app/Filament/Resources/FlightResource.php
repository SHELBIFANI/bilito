<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Morilog\Jalali\Jalalian;

class FlightResource extends Resource
{
    // protected static ?string $modelLabel = 'لیست پروازها';
    // protected static ?string $recordTitleAttribute = 'پروازها';

    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        // dd($form);
        $city = City::pluck('name', 'id');

        return $form
            ->schema([
                'origin_id' => Select::make('origin_id')
                    ->options(City::pluck('name', 'id'))
                    ->required()
                    ->placeholder('Enter origin'),

                'destination_id' => Select::make('destination_id')
                    ->options(City::pluck('name', 'id'))
                    ->required()
                    ->placeholder('Enter destination'),

                'departure' => DateTimePicker::make('departure')
                    ->required()
                    ->placeholder('Enter departure'),

                'arrival' => Forms\Components\DateTimePicker::make('arrival')
                    ->required()
                    ->placeholder('Enter arrival'),

                'price' => Forms\Components\TextInput::make('price')
                    ->required()
                    ->placeholder('Enter price'),

                'capacity' => Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->placeholder('Enter capacity'),

                'plane' => Forms\Components\Select::make('plane')
                    ->options(['A320', 'A321', 'A330', 'A340', 'A350', 'A380', 'B737', 'B747', 'B757', 'B767', 'B777', 'B787'])
                    ->required()
                    ->placeholder('Enter plane'),

                'airline_id' => Forms\Components\Select::make('airline_id')
                    ->options(Airline::pluck('name', 'id'))
                    ->required()
                    ->placeholder('Enter airline'),

            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                textColumn::make('id')->sortable(),
                TextColumn::make('origin.name')->label('مبدا'),
                TextColumn::make('destination.name')->label('مقصد')->searchable(),
                TextColumn::make('departure')->label('تاریخ پرواز')->formatStateUsing(fn (string $state): string => jdate($state)->format('Y-m-d H:i')),
                TextColumn::make('arrival')->label('تاریخ ورود')->formatStateUsing(fn (string $state): string => jdate($state)->format('Y-m-d H:i')),
                TextColumn::make('price')->label('قیمت')->formatStateUsing(fn (string $state): string => number_format($state)),
                TextColumn::make('capacity')->label('ظرفیت'),
                TextColumn::make('plane')->label('مدل هواپیما'),
                TextColumn::make('airline.name')->label('ایرلاین'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
