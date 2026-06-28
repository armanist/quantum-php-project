<?php

declare(strict_types=1);

/**
 * Quantum PHP Framework
 * An open-source software development framework for PHP
 * @link https://quantumphp.io
 */

namespace Shared\Transformers;

use Quantum\Transformer\Contracts\TransformerInterface;

/**
 * Class PostTransformer
 * @package Shared\Transformers
 */
class PostTransformer implements TransformerInterface
{
    /**
     * Transforms the post data
     * @param mixed $item
     * @return array
     */
    public function transform($item): array
    {
        return [
            'uuid' => $item->uuid,
            'title' => $item->title,
            'content' => markdown_to_html($item->content, true),
            'image' => $this->buildImagePath($item),
            'date' => date('Y/m/d H:i', strtotime($item->updated_at)),
            'author' => $item->firstname . ' ' . $item->lastname,
        ];
    }

    /**
     * Builds the image path for the given item.
     *
     * @param $item
     * @return string|null
     */
    private function buildImagePath($item): ?string
    {
        if ($item->image && $item->user_directory) {
            return $item->user_directory . '/' . $item->image;
        }

        return null;
    }
}
