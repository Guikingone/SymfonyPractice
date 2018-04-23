<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 02/04/2018
 * Time: 11:22
 */

namespace App\Form\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;

interface AddArticleTypeHandlerInterface
{
    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}