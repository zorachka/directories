<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

final class DirectoriesConfig
{
    private array $directories = [];

    private function __construct()
    {
    }

    public static function withDefaults(array $directories = []): self
    {
        $self = new self();

        foreach ($directories as $name => $path) {
            $self = $self->withDirectory($name, $path);
        }

        return $self;
    }

    public function directories(): array
    {
        return $this->directories;
    }

    /**
     * @param string $name Directory alias, ie. "@public".
     * @param string $path Directory path without ending slash.
     */
    public function withDirectory(string $name, string $path): self
    {
        $new = clone $this;

        $path = str_replace(['\\', '//'], '/', $path);
        $new->directories[$name] = rtrim($path, '/') . '/';

        return $new;
    }
}
