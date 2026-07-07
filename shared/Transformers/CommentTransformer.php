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
 * Class CommentTransformer
 * @package Shared\Transformers
 */
class CommentTransformer implements TransformerInterface
{
    public function transform($item): array
    {
        return [
            'uuid' => $item->uuid,
            'author' => [
                'firstname' => $item->firstname,
                'lastname' => $item->lastname,
                'image' => $item->image,
            ],
            'content' => $item->content,
            'date' => date('Y-m-d H:i', strtotime($item->created_at)),
        ];
    }
}
