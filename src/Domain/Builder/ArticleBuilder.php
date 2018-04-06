<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:54
 */

namespace App\Domain\Builder;

use App\Domain\Models\Article;

class ArticleBuilder
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @param string $content
     *
     * @return ArticleBuilder
     */
    public function create(string $content): self
    {
        $this->article = new Article($content);

        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }
}
