<?php

declare(strict_types=1);

namespace Zorachka\Directories\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Directories\Directories;
use Zorachka\Directories\DirectoriesConfig;
use Zorachka\Directories\Exception\CouldNotFindDirectoryWithAlias;
use Zorachka\Directories\FilesystemDirectories;

/**
 * @internal
 */
final class FilesystemDirectoriesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeCreatedFromDirectoriesConfig(): void
    {
        $config = DirectoriesConfig::withDefaults([
            '@directory' => __DIR__,
        ]);
        $directories = FilesystemDirectories::fromConfig($config);

        Assert::assertInstanceOf(Directories::class, $directories);
        Assert::assertTrue($directories->has('@directory'));
        Assert::assertEquals(__DIR__ . '/', $directories->get('@directory'));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfDirectoryDoesntExists(): void
    {
        $this->expectException(CouldNotFindDirectoryWithAlias::class);
        $config = DirectoriesConfig::withDefaults([
            '@directory' => __DIR__,
        ]);
        $directories = FilesystemDirectories::fromConfig($config);
        $directories->get('@directories');
    }

    /**
     * @test
     */
    public function shouldBeAbleToCheckThatDirectoryExists(): void
    {
        $config = DirectoriesConfig::withDefaults([
            '@directory' => __DIR__,
        ]);
        $directories = FilesystemDirectories::fromConfig($config);

        Assert::assertTrue($directories->has('@directory'));
        Assert::assertFalse($directories->has('@directories'));
    }

    /**
     * @test
     */
    public function shouldBeAbleToResolveDirectoryWithAlias(): void
    {
        $config = DirectoriesConfig::withDefaults([
            '@root' => __DIR__,
            '@public' => '@root/public',
        ]);
        $directories = FilesystemDirectories::fromConfig($config);
        Assert::assertEquals(__DIR__ . '/public/', $directories->get('@public'));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfDirectoryWithAliasDoesntExists(): void
    {
        $this->expectException(CouldNotFindDirectoryWithAlias::class);
        $config = DirectoriesConfig::withDefaults([
            '@main' => __DIR__,
            '@public' => '@root/public',
        ]);
        $directories = FilesystemDirectories::fromConfig($config);
        $directories->get('@public');
    }
}
