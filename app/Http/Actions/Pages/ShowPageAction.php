<?php

namespace App\Http\Actions\Pages;

use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

readonly class ShowPageAction
{
    /**
     * @throws \Throwable
     */
    public function __invoke(string $slug): JsonResource
    {
        return Page::findOrFailBySlug($slug)->toResource();
    }
}
