<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 16/04/2018
 * Time: 10:42
 */

namespace App\Tests\UI\Action;


use App\Form\Handler\Interfaces\AddArticleTypeHandlerInterface;
use App\Helper\FileUploaderHelper;
use App\UI\Action\HomeAction;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\HomeResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class HomeActionTest extends KernelTestCase
{
    use TestCaseTrait;

    /**
     * @var AddArticleTypeHandlerInterface
     */
    private $addArticleTypeHandler;

    /**
     * @var FileUploaderHelper
     */
    private $fileUploader;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();

        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->addArticleTypeHandler = $this->createMock(AddArticleTypeHandlerInterface::class);

        $this->fileUploader = $this->createMock(FileUploaderHelper::class);
        $this->fileUploader->method('getImageFolder')->willReturn('./public/images');
    }

    public function testConstruct()
    {

        $homeAction = new HomeAction(
            $this->formFactory,
            $this->eventDispatcher,
            $this->fileUploader,
            $this->addArticleTypeHandler
        );

        static::assertInstanceOf(
            HomeActionInterface::class,
            $homeAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $request = Request::create(
            '/',
            'POST'
        );

        $this->addArticleTypeHandler->method('handle')->willReturn(false);
        $responder = new HomeResponder(
            $this->createMock(Environment::class)
        );

        $homeAction = new HomeAction(
            $this->formFactory,
            $this->eventDispatcher,
            $this->fileUploader,
            $this->addArticleTypeHandler
        );

        $probe = static::$blackfire->createProbe();

        $homeAction($request, $responder);

        static::$blackfire->endProbe($probe);

        static::assertInstanceOf(
            Response::class,
            $homeAction($request, $responder)
        );
    }
}
