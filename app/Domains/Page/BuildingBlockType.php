<?php

namespace App\Domains\Page;

enum BuildingBlockType: string
{
    case Text = 'text';
    case Image = 'image';
    case UnorderedList = 'unordered-list';
    case Button = 'button';

    public function getLabel(): string
    {
        return match ($this) {
            self::Text => 'Szöveg',
            self::Image => 'Kép',
            self::UnorderedList => 'Felsorolás',
            self::Button => 'Gomb (CTA)',
        };
    }
}
