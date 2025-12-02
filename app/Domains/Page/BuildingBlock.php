<?php

namespace App\Domains\Page;

use Filament\Forms\Components\Field;
use Filament\Support\Icons\Heroicon;

abstract class BuildingBlock
{
    /**
     * @return Field[]
     */
    abstract public function schema(): array;

    public function icon(): Heroicon
    {
        return Heroicon::OutlinedDocument;
    }
}
