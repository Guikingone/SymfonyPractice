<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 16/04/2018
 * Time: 11:11
 */

namespace App\Tests\Form\Type;


use App\Form\Type\RegisterType;
use Symfony\Component\Form\Test\TypeTestCase;


class RegisterTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(RegisterType::class);

        $form->submit([
            'username' => 'toto',
            'email' => 'toto@gmail.com',
            'password' => [
                'first' => 'Ie1FDLTOTo',
                'second' => 'Ie1FDLTOTo'
            ]
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertSame([
                'username' => 'toto',
                'email' => 'toto@gmail.com',
                'password' => 'Ie1FDLTOTo'
            ],
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}
