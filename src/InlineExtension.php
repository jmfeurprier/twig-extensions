<?php

namespace perf\TwigExtensions;

use RuntimeException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InlineExtension extends AbstractExtension
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = realpath($basePath) . '/';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions(): array
    {
        // @todo Ensure provided path is not upper than base path (ex: "../../something.php").

        return [
            new TwigFunction(
                'inline',
                function (string $path) {
                    if (!file_exists($this->basePath . $path)) {
                        throw new RuntimeException('File not found.');
                    }

                    return file_get_contents($this->basePath . $path);
                },
                ['is_safe' => ['all']]
            ),
        ];
    }
}
