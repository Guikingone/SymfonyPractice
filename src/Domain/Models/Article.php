<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:28
 */

namespace App\Domain\Models;

use ApiPlatform\Core\Annotation\ApiResource;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Article
 *
 * @ApiResource()
 */
class Article implements \JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var string
     *
     * @Groups({"content"})
     */
    private $content;

    /**
     * @var User
     */
    private $author;

    /**
     * Article constructor.
     *
     * @param string  $content
     */
    public function __construct(string $content)
    {
        $this->id = Uuid::uuid4();
        $this->uuid = Uuid::uuid4();
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id->toString();
    }

    /**
     * @param string $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    public function jsonSerialize()
    {
        return [
            '@id' => $this->id,
            '@content' => $this->content,
            'type' => 'Article',
            '_links' => [
                'self' => [
                    'href' => '/api/article/'. $this->id->toString()
                ],
                'delete' => [
                    'href' => '/api/article/'. $this->id->toString()
                ],
                'put' => [
                    'href' => '/api/article/'.$this->id->toString()
                ]
            ]
        ];
    }
}
