<?php

declare(strict_types=1);

namespace Zorachka\Framework\Directories;

use Zorachka\Framework\Directories\Exception\CouldNotFindDirectoryWithAlias;

final class FilesystemDirectories implements Directories
{
    private function __construct(
        private array $directories,
    ) {}

    public static function fromConfig(DirectoriesConfig $config): self
    {
        return new self(
            $config->directories()
        );
    }

    /**
     * @inheritDoc
     */
    public function has(string $alias): bool
    {
        return array_key_exists($alias, $this->directories);
    }

    /**
     * @inheritDoc
     */
    public function get(string $alias): string
    {
        if (!$this->has($alias)) {
            throw new CouldNotFindDirectoryWithAlias(
                \sprintf('Undefined directory with alias %s', $alias)
            );
        }

        $directory = $this->directories[$alias];

        $pattern = '/^@[[:alnum:]]+/';
        $isMatched = \preg_match($pattern, $directory, $matches);
        if ($isMatched) {
            $matchedAlias = $matches[0];

            if (!$this->has($matchedAlias)) {
                throw new CouldNotFindDirectoryWithAlias(
                    \sprintf('Undefined directory with alias %s in %s', $matchedAlias, $directory)
                );
            }

            $matchedDirectory = $this->get($matchedAlias);
            $replaced = \preg_replace('/' . $matchedAlias . '/', $matchedDirectory, $directory);

            return str_replace(['\\', '//'], '/', $replaced);
        }

        return $directory;
    }
}
