<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

use Psr\Container\ContainerInterface;
use Zorachka\Container\ServiceProvider;

final class DirectoriesServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            Directories::class => static fn(ContainerInterface $container): Directories =>
                FilesystemDirectories::fromConfig(
                    $container->get(DirectoriesConfig::class)
                ),
            DirectoriesConfig::class => static fn() => DirectoriesConfig::withDefaults(),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getExtensions(): array
    {
        return [];
    }
}
