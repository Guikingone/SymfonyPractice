<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 16/04/2018
 * Time: 11:21
 */

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeActionFunctionalTest extends WebTestCase
{
    /**
     * @group e2e
     */
    public function testHomePageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    /**
     * @group e2e
     */
    public function testHomePageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Soumettre')->form();

        $form['register[username]'] = 'Toto';
        $form['register[email]'] = 'toto@gmail.com';
        $form['register[password][first]'] = 'Ie1FDLTOTo';
        $form['register[password][second]'] = 'Ie1FDLTOTo';

        $crawler = $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
