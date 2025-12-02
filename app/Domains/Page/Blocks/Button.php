<?php

namespace App\Domains\Page\Blocks;

use App\Domains\Page\BuildingBlock;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;

class Button extends BuildingBlock
{
    public function schema(): array
    {
        return [
            TextInput::make('label')
                ->label('Gomb szövege')
                ->required(),

            TextInput::make('url')
                ->label('URL')
                ->required(),

            ToggleButtons::make('mode')
                ->grouped()
                ->default('navigate')
                ->label('Típus')
                ->options([
                    'navigate' => 'Navigálás',
                    'link' => 'Link (külső)',
                    'scroll' => 'Görgetés',
                ])
                ->required(),
        ];
    }
}
