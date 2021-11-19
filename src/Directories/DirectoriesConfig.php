<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

use Webmozart\Assert\Assert;
use Zorachka\Framework\Directories\Exception\DirectoryWithAliasAlreadyExists;

final class DirectoriesConfig
{
    private array $directories = [];

    private function __construct()
    {
    }

    public static function withDefaults(array $directories = []): self
    {
        $self = new self();

        foreach ($directories as $alias => $path) {
            Assert::string($alias);
            Assert::string($path);

            $self = $self->withDirectory($alias, $path);
        }

        return $self;
    }

    public function directories(): array
    {
        return $this->directories;
    }

    /**
     * @param string $alias Directory alias, ie. "@public".
     * @param string $path Directory path without ending slash.
     * @param bool $rewrite Ability to rewrite path with existing alias.
     * @return DirectoriesConfig
     */
    public function withDirectory(string $alias, string $path, bool $rewrite = false): self
    {
        $new = clone $this;

        $path = str_replace(['\\', '//'], '/', $path);

        $hasDirectory = array_key_exists($alias, $new->directories);
        if ($hasDirectory && !$rewrite) {
            throw new DirectoryWithAliasAlreadyExists(
                \sprintf('Directory alias "%s" already exists with "%" path', $alias, $path)
            );
        }

        $new->directories[$alias] = rtrim($path, '/') . '/';

        return $new;
    }
}
