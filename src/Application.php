<?php
namespace DevOp\Core\Framework;

use DevOp\Core\Config;
use DevOp\Core\Container;
use DevOp\Core\Http\UriFactory;
use DevOp\Core\Framework\Controller;

class Application
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @return $this
     */
    private static $instance;

    /**
     * @return $this
     */
    public static function make()
    {
        if (null === self::$instance) {
            self::$instance = new Application();
        }
        return self::$instance;
    }

    /**
     * 
     * @return $this
     */
    public function configure()
    {

        $this->container = new Container();

        $this->container->add('debug', env('APP_DEBUG'));

        $this->container->add('config', function() {
            return new Config([
                '../app/config/framework.php',
                '../app/config/routes.php',
                '../app/config/database.php'
            ]);
        });

        $this->container->add('router', function() {
            return new \DevOp\Core\Router\Router();
        });

        $this->container->add('request', function() {
            return new \DevOp\Core\Http\ServerRequestFactory();
        });

        $this->container->add(Controller::class, function() {
            return new Controller($this->container);
        });

        return $this;
    }

    public function process()
    {

        $this->container->get('router')->get('page1', '/page1/{name:\w+}/{id}', function($request, $response) {
            $response->getBody()->write('Hello world!');
            return $response;
        });

        $uri = (new UriFactory())->createUri('/page1/devop/1');
        $request = (new \DevOp\Core\Http\ServerRequestFactory())->createServerRequest('GET', $uri);

        try {
            /* @var $route \DevOp\Core\Router\Route */
            $route = $this->container->get('router')->dispatch($request);
        } catch (\DevOp\Core\Router\Exceptions\RouteNotFoundException $ex) {
            var_dump($ex);
        } catch (DevOp\Core\Router\Exceptions\RouteIsNotCallableException $ex) {
            var_dump($ex);
        }

        var_dump($route);

        return $this;
    }

    /**
     * 
     */
    public function terminate()
    {
        /* @var $response \Psr\Http\Message\ResponseInterface */
        $response = $this->container->get('response');
        foreach ($response->getHeaders() AS $header) {
            header($header, false);
        }
        echo $response->getBody();
        exit;
    }
}
