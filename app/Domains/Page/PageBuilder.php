<?php

namespace App\Domains\Page;

use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class PageBuilder
{
    public static function make(string $name, string $label): Builder
    {
        return Builder::make($name)
            ->columnSpanFull()
            ->when(filled($label), fn (Builder $b) => $b->label($label))
            ->blocks(self::blocks())
            ->addActionLabel('Új blokk hozzáadása')
            ->collapsible()
            ->deleteAction(
                fn (Action $action) => $action->requiresConfirmation(),
            );
    }

    /**
     * @return Block[]
     */
    public static function blocks(): array
    {
        return collect(BuildingBlockType::cases())
            ->map(function (BuildingBlockType $type) {
                $definition = app()->make("App\\Domains\\Page\\Blocks\\$type->name");

                return Block::make($type->value)
                    ->columnSpanFull()
                    ->columns(1)
                    ->label($type->getLabel())
                    ->icon($definition->icon())
                    ->schema([
                        TextInput::make('id')
                            ->label('Azonosító')
                            ->readOnly()
                            ->formatStateUsing(fn (?string $state) => empty($state) ? Str::random(8) : $state),
                        ...$definition->schema(),
                    ]);
            })
            ->values()
            ->toArray();
    }
}
