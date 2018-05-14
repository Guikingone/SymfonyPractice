<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 14/05/2018
 * Time: 10:48
 */

namespace App\UI\Responder\API;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetArticleResponder
{
    public function __invoke($data)
    {
        return new JsonResponse($data);
    }
}
