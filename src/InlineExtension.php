<?php

namespace perf\TwigExtensions;

use perf\TwigExtensions\Exception\InlineExtensionException;
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

        return [
            new TwigFunction(
                'inline',
                [
                    $this,
                    'inline',
                ],
                ['is_safe' => ['all']]
            ),
        ];
    }

    /**
     * @throws InlineExtensionException
     */
    public function inline(string $path): string
    {
        $sourcePath = realpath($this->basePath . $path);

        // Ensure provided path is not outside of base path (ex: "../../something.php").
        if (0 !== strpos($sourcePath, $this->basePath)) {
            throw new InlineExtensionException('Cannot inline content outside of base path.');
        }

        if (!file_exists($sourcePath)) {
            throw new InlineExtensionException('File to inline not found.');
        }

        if (!is_file($sourcePath)) {
            throw new InlineExtensionException('File to inline is not a file.');
        }

        return file_get_contents($sourcePath);
    }
}
