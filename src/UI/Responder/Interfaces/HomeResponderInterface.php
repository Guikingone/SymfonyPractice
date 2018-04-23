<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;

interface HomeResponderInterface
{
    /**
     * @param bool $redirect
     * @param FormInterface $form
     *
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null);
}
