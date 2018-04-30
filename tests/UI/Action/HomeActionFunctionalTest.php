<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 16/04/2018
 * Time: 11:21
 */

namespace App\Tests\UI\Action;

use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeActionFunctionalTest extends WebTestCase
{
    use TestCaseTrait;

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
     * @group Blackfire
     */
    public function testHomePageFormSubmission()
    {
        $probe = static::$blackfire->createProbe();

        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Soumettre')->form();

        $form['register[username]'] = 'Toto';
        $form['register[email]'] = 'toto@gmail.com';
        $form['register[password][first]'] = 'Ie1FDLTOTo';
        $form['register[password][second]'] = 'Ie1FDLTOTo';

        $crawler = $client->submit($form);

        static::$blackfire->endProbe($probe);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
