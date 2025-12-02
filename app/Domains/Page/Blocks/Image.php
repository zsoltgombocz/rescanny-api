<?php

namespace App\Domains\Page\Blocks;

use App\Domains\Page\BuildingBlock;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class Image extends BuildingBlock
{
    public function schema(): array
    {
        return [
            FileUpload::make('url')
                ->imageEditor()
                ->imageResizeTargetWidth('1280')
                ->imageEditorAspectRatios([
                    '16:9', '2:4',
                ])
                ->hiddenLabel()
                ->image()
                ->required(),

            TextInput::make('alt')->label('Képfelirat'),
        ];
    }
}
