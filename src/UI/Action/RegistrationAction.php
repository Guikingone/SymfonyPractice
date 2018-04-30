<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: guillaumeloulier
 * Date: 09/04/2018
 * Time: 11:24
 */

namespace App\UI\Action;


use App\Domain\Builder\UserBuilder;
use App\Domain\Models\User;
use App\Form\Type\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class RegistrationAction
 *
 * @Route(
 *     path="/register",
 *     name="register"
 * )
 */
class RegistrationAction
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UserBuilder
     */
    private $userBuilder;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegistrationAction constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     * @param UserBuilder $userBuilder
     * @param Environment $twig
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker, EncoderFactoryInterface $encoderFactory, FormFactoryInterface $formFactory, UserBuilder $userBuilder, Environment $twig)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->userBuilder = $userBuilder;
        $this->twig = $twig;
    }


    public function __invoke(Request $request)
    {
        $form = $this->formFactory->create(RegisterType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encoder = $this->encoderFactory->getEncoder(User::class);

            $this->userBuilder->createFromRegistration(
                'Toto',
                'toto@gmail.com',
                'ie1FDLTOTO',
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );
        }

        return new Response(
            $this->twig->render('register.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}
