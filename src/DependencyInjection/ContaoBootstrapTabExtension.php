<?php

/**
 * Contao Bootstrap
 *
 * @package    contao-bootstrap
 * @subpackage Tab
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2013-2020 netzmacht David Molineus. All rights reserved.
 * @license    LGPL-3.0-or-later https://github.com/contao-bootstrap/tab/blob/master/LICENSE
 * @filesource
 */

declare(strict_types=1);

namespace ContaoBootstrap\Tab\DependencyInjection;

use ContaoBootstrap\Tab\Component\ContentElement\TabElementFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ContaoBootstrapTabExtension
 */
final class ContaoBootstrapTabExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__) . '/Resources/config')
        );

        $loader->load('services.xml');
        $loader->load('listener.xml');

        $this->configureTabElementFactory($container);
    }

    /**
     * Configure the tab element factory.
     *
     * @param ContainerBuilder $container The container builder.
     *
     * @return void
     */
    private function configureTabElementFactory(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition(TabElementFactory::class);
        if (!$definition) {
            return;
        }

        $bundles = $container->getParameter('kernel.bundles');

        // if (!isset($bundles['ContaoBootstrapGridBundle'])) {
        //     return;
        // }

        // $definition->setArgument(5, new Reference('contao_bootstrap.grid.grid_provider'));
    }
}
