<?php

declare(strict_types=1);

namespace Zorachka\Directories\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Zorachka\Directories\Directories;
use Zorachka\Directories\DirectoriesConfig;
use Zorachka\Directories\DirectoriesServiceProvider;

/**
 * @internal
 */
final class DirectoriesServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldContainDefinitions(): void
    {
        Assert::assertEquals([
            Directories::class,
            DirectoriesConfig::class,
        ], \array_keys(DirectoriesServiceProvider::getDefinitions()));
    }
}
