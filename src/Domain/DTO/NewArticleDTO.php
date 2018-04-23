<?php

declare(strict_types=1);

/*
 * This file is part of the TOTO project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class NewArticleDTO.
 *
 * @author
 */
class NewArticleDTO
{
    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $title;

    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * NewArticleDTO constructor.
     *
     * @param string $content
     */
    public function __construct(string $content, string $title, UploadedFile $image = null)
    {
        $this->content = $content;
        $this->title = $title;
        $this->image = $image;
    }
}
