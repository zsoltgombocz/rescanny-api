<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @mixin \App\Models\Page
 */
class PageResource extends JsonResource
{
    public static $wrap = null;

    public function __construct(\App\Models\Page $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'subtitle' => ! empty($this->subtitle) ? $this->subtitle : null,
            'slug' => $this->slug,
            'content' => $this->transformContent($this->getAttributeValue('content')),
        ];
    }

    /**
     * @param  array<array-key, mixed>  $content
     * @return array<array-key, mixed>
     */
    protected function transformContent(array $content): array
    {
        return collect($content)
            ->map(fn (array $block) => $this->normalizeBlock($block))
            ->all();
    }

    /**
     * @param  array<array-key, mixed>  $block
     * @return array<array-key, mixed>
     */
    protected function normalizeBlock(array $block): array
    {
        return match (Arr::get($block, 'type')) {
            'text' => [
                'id' => Arr::get($block, 'data.id'),
                'type' => 'text',
                'content' => Arr::get($block, 'data.content'),
            ],
            'image' => [
                'id' => Arr::get($block, 'data.id'),
                'type' => 'image',
                'alt' => Arr::get($block, 'data.alt'),
                'url' => asset(Arr::get($block, 'data.url')),
            ],
            'button' => [
                'id' => Arr::get($block, 'data.id'),
                'type' => 'button',
                'mode' => Arr::get($block, 'data.mode'),
                'label' => Arr::get($block, 'data.label'),
                'url' => Arr::get($block, 'data.url'),
            ],
            'unordered-list' => [
                'id' => Arr::get($block, 'data.id'),
                'type' => 'unordered-list',
                'items' => Arr::get($block, 'data.items'),
            ],
            default => $block
        };
    }
}
