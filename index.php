<?php

namespace Foo;

require_once __DIR__.'/vendor/autoload.php';

// @see http://symfony.com/doc/current/components/http_kernel.html#a-full-working-example

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;

use Symfony\Component\EventDispatcher\EventDispatcher;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;


// sorry, ignore my awful php coding...

class FooController
{
  public function homePage()
  {
    $loader = new FilesystemLoader(__DIR__.'/views/%name%');
    $templating = new PhpEngine(new TemplateNameParser(), $loader);
    $content = $templating->render('home.html.php', array());
    return new Response($content);
  }
  public function otherPage()
  {
    $loader = new FilesystemLoader(__DIR__.'/views/%name%');
    $templating = new PhpEngine(new TemplateNameParser(), $loader);
    $content = $templating->render('other-page.html.php', array());
    return new Response($content);
  }
  public function apiAction()
  {
    $response = new JsonResponse();
    $response->setData(array(
      'number' => 123,
      'text' => 'from the API',
    ));
    return $response;
  }
}

$fooController = new FooController();

$routes = new RouteCollection();

// should be able to load them like this but I am too phpstupid...
//'_controller' => 'Foo:FooController::someAction',
$routes->add('homePage', new Route('/', array(
  '_controller' => array($fooController, 'homePage'),
)));
$routes->add('otherPage', new Route('/other-page', array(
  '_controller' => array($fooController, 'otherPage'),
)));
$routes->add('api', new Route('/api/yay', array(
  '_controller' => array($fooController, 'apiAction'),
)));

$request = Request::createFromGlobals();
$context = new RequestContext( '/' ); $context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();

$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);