<?php

declare(strict_types=1);

/*
 * This file is part of the RollerworksDatagrid package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Bundle\DatagridBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Rollerworks\Bundle\DatagridBundle\DependencyInjection\DatagridExtension;
use Rollerworks\Component\Datagrid\DatagridFactory;
use Symfony\Component\DependencyInjection\Definition;

final class DatagridExtensionTest extends AbstractExtensionTestCase
{
    protected function setUp()
    {
        parent::setUp();

        // Actual class is Symfony\Bundle\TwigBundle\Loader\FilesystemLoader but that is a subclass.
        // and the Twig_Loader_Filesystem doesn't require any additional services.
        $this->setDefinition('twig.loader.filesystem', new Definition('Twig_Loader_Filesystem'));
    }

    public function testDatagridFactoryIsAccessible()
    {
        $this->load();
        $this->compile();

        self::assertInstanceOf(DatagridFactory::class, $this->container->get('rollerworks_datagrid.factory'));
    }

    protected function getContainerExtensions()
    {
        return [
            new DatagridExtension(),
        ];
    }
}
