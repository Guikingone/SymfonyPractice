<?php

declare(strict_types=1);

namespace App\Helper;

class FileUploaderHelper
{
    /**
     * @var string
     */
    private $imageFolder;

    /**
     * FileUploaderHelper constructor.
     *
     * @param string $imageFolder
     */
    public function __construct(string $imageFolder)
    {
        $this->imageFolder = $imageFolder;
    }

    /**
     * @return string
     */
    public function getImageFolder(): string
    {
        return $this->imageFolder;
    }
}
