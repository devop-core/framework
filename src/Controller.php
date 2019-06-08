<?php
namespace DevOp\Core\Framework;

use Psr\Container\ContainerInterface;

final class Controller
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $name
     * @param mixed $default
     * @return mixed
     */
    public function getParamater($name, $default = null)
    {
        return $this->container->get($name, $default);
    }
}
