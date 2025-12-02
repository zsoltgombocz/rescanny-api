<?php

namespace App\Domains\Page\Blocks;

use App\Domains\Page\BuildingBlock;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class UnorderedList extends BuildingBlock
{
    public function schema(): array
    {
        return [
            Repeater::make('items')
                ->addActionLabel('Új elem')
                ->hiddenLabel()
                ->minItems(1)
                ->schema([
                    TextInput::make('title')
                        ->label('Cím')
                        ->required(),

                    Textarea::make('description')
                        ->label('Leírás')
                        ->rows(3),
                ]),
        ];
    }
}
