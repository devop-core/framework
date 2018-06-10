<?php
namespace DevOp\Core\Framework;

use Psr\Container\ContainerInterface;

class Controller
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function getParamater($name, $default = null)
    {
        return $this->container->get($name, $default);
    }

    public function getEntityManager()
    {

    }
}
