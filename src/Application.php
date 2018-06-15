<?php
namespace DevOp\Core;

use DevOp\Core\Container;

class Application
{

    /**
     * @var self
     */
    private static $instance;

    /**
     * @var Container
     */
    private $container;

    /**
     * @return self
     */
    public static function make()
    {
        if (null === self::$instance) {
            self::$instance = new Application();
        }
        return self::$instance;
    }

    public function configure()
    {
        $this->container = new Container();

        $this->container->add('debug', env('APP_DEBUG'));

        $this->container->add(Controller::class, function() {
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
