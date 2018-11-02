<?php
namespace DevOp\Core\Framework;

use DevOp\Core\Container;
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

        $this->container->add(Controller::class,
            function() {
            return new Controller($this->container);
        });

        return $this;
    }

    public function process()
    {

        return $this;
    }

    public function end()
    {
        return $this;
    }
}