<?php

declare(strict_types=1);

namespace Zorachka\Directories;

use Psr\Container\ContainerInterface;
use Zorachka\Container\ServiceProvider;

final class DirectoriesServiceProvider implements ServiceProvider
{
    public static function getDefinitions(): array
    {
        return [
            Directories::class => static function (ContainerInterface $container): Directories {
                /** @var DirectoriesConfig $directoriesConfig */
                $directoriesConfig = $container->get(DirectoriesConfig::class);

                return FilesystemDirectories::fromConfig(
                    $directoriesConfig
                );
            },
            DirectoriesConfig::class => static fn () => DirectoriesConfig::withDefaults(),
        ];
    }

    public static function getExtensions(): array
    {
        return [];
    }
}
