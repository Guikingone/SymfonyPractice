<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:26
 */

namespace App\Domain\DTO;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewArticleDTO
{
    /**
     * @var string
     */
    public $content;

    public $title;

    public $image;

    /**
     * NewArticleDTO constructor.
     *
     * @param string $content
     */
    public function __construct(string $content, string $title, UploadedFile $image)
    {
        $this->content = $content;
        $this->title = $title;
        $this->image = $image;
    }
}
