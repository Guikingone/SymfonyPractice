<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:28
 */

namespace App\Domain\Models;


class Article
{
    /**
     * @var string
     */
    private $content;

    /**
     * Article constructor.
     *
     * @param string  $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
