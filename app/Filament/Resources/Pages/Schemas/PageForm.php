<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Domains\Page\PageBuilder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Cím')
                    ->required(),
                TextInput::make('subtitle')
                    ->label('Alcím'),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),

                PageBuilder::make('content', 'Tartalom'),
            ]);
    }
}
