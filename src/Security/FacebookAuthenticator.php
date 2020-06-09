<?php

namespace App\Security;

use App\Entity\User;
use App\Services\Slugger;
use App\Services\AvatarVerification;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


/**
 * Created by IntelliJ IDEA.
 * User: mert
 * Date: 12/18/17
 * Time: 12:00 PM
 */
class FacebookAuthenticator extends SocialAuthenticator
{

    use TargetPathTrait;

    private $slugger;
    private $clientRegistry;
    private $em;
    private $router;
    private $avatar;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router, Slugger $slugger, AvatarVerification $avatar)
    {
        $this->slugger = $slugger;
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
        $this->avatar = $avatar;
    }

    public function supports(Request $request)
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->getPathInfo() == '/connect/facebook/check' && $request->isMethod('GET');
    }

    public function getCredentials(Request $request)
    {
        // this method is only called if supports() returns true
        return $this->fetchAccessToken($this->getFacebookClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider )
    {
        
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->getFacebookClient()
            ->fetchUserFromToken($credentials);

        /** @var FacebookUser ID $fbId */
        $fbId = $facebookUser->getId();

        /** @var FacebookUser Email $email */
        $email = $facebookUser->getEmail();


        // check for facebook_id in database and compare
        $existingUser = $this->em->getRepository(User::class)
        ->findOneBy(['facebook_id' => $fbId]);
        
        // if a user has this id in db
        if ($existingUser) 
        {
            $user = $existingUser;

        } else {
            // check users email in database and compare
            $existingEmail = $this->em->getRepository(User::class)
            ->findOneBy(['email' => $email]);

            // if a user has the same email in db
            if ($existingEmail) 
            {
                $user = $existingEmail;

                $user->setFacebook_id($fbId);

                $this->em->persist($user);
                $this->em->flush();
            }
            /** 
             * if no facebook ID correspond
             * or no email correspond
            */
            else
            {

                $user = new User();
                $user->setFacebook_id($fbId);

                $user->setEmail($email);

                $facebookName = $facebookUser->getFirstName();

                /* Generate a default avatar */
                $this->avatar->default($user);
                

                $existingUsername = $this->em->getRepository(User::class)
                ->findOneBy(['username' => $facebookName]);

                if($existingUsername)
                {
                    $user->setusername($facebookName . substr(uniqid(rand(),1), 0, 5));
                }else{
                    $user->setusername($facebookName);
                }

                $user->setPassword('no password');

                $slugUsername = $facebookUser->getFirstName();
                $usernameSluggified = $this->slugger->sluggify($slugUsername);
                $user->setSlug($usernameSluggified);

                $user->setCreatedAt(new \DateTime('now'));

                $user->setValidate(1);

                $this->em->persist($user);
                $this->em->flush();
            }
        }
    
        return $user;
        
    }

    /**
     * @return \KnpU\OAuth2ClientBundle\Client\OAuth2Client
     */
    private function getFacebookClient()
    {
        return $this->clientRegistry
            ->getClient('facebook');
    }

    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *  A) For a form login, you might redirect to the login page
     *      return new RedirectResponse('/login');
     *  B) For an API token authentication system, you return a 401 response
     *      return new Response('Auth header required', 401);
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param \Symfony\Component\Security\Core\Exception\AuthenticationException $authException The exception that started the authentication process
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('login');
    }

    /**
     * Called when authentication executed, but failed (e.g. wrong username password).
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the login page or a 403 response.
     *
     * If you return null, the request will continue, but the user will
     * not be authenticated. This is probably not what you want to do.
     *
     * @param Request $request
     * @param \Symfony\Component\Security\Core\Exception\AuthenticationException $exception
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @param Request $request
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     *
     * @return void
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('homepage'));
        
    }

}