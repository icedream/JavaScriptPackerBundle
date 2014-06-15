<?php

namespace Icedream\JavaScriptPackerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Process\ExecutableFinder;

/**
 * {@inherit-doc}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inherit-doc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $finder = new ExecutableFinder();

        echo "jspacker at work\r\n";

        return $builder;
    }
}
