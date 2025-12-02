<?php

namespace App\Domains\Page\Blocks;

use App\Domains\Page\BuildingBlock;
use Filament\Forms\Components\RichEditor;

class Text extends BuildingBlock
{
    public function schema(): array
    {
        return [
            RichEditor::make('content')
                ->label('Tartalom')
                ->required(),
        ];
    }
}
