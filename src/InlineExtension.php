<?php

namespace Jmf\TwigExtensions;

use Jmf\TwigExtensions\Exception\InlineExtensionException;
use Override;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InlineExtension extends AbstractExtension
{
    public final const string PREFIX_DEFAULT = '';

    private readonly string $basePath;

    public function __construct(
        string $basePath,
        private readonly string $functionPrefix = self::PREFIX_DEFAULT,
    ) {
        $this->basePath = realpath($basePath) . '/';
    }

    #[Override]
    public function getFunctions(): iterable
    {
        return [
            new TwigFunction(
                "{$this->functionPrefix}inline",
                $this->inline(...),
                ['is_safe' => ['all']]
            ),
        ];
    }

    /**
     * @throws InlineExtensionException
     */
    public function inline(string $path): string
    {
        $absolutePath = $this->getAbsolutePath($path);

        $this->validatePath($absolutePath);

        return $this->getFileContent($absolutePath);
    }

    /**
     * @throws InlineExtensionException
     */
    private function getAbsolutePath(string $relativePath): string
    {
        $absolutePath = realpath($this->basePath . $relativePath);

        if (false === $absolutePath) {
            throw new InlineExtensionException();
        }

        return $absolutePath;
    }

    /**
     * @throws InlineExtensionException
     */
    private function validatePath(string $path): void
    {
        // Ensure provided path is not outside of base path (ex: "../../something.php").
        if (!str_starts_with($path, $this->basePath)) {
            throw new InlineExtensionException('Cannot inline content outside of base path.');
        }

        if (!file_exists($path)) {
            throw new InlineExtensionException('File to inline not found.');
        }

        if (!is_file($path)) {
            throw new InlineExtensionException('File to inline is not a file.');
        }
    }

    /**
     * @throws InlineExtensionException
     */
    private function getFileContent(string $path): string
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new InlineExtensionException('Failed to retrieve content of inline file.');
        }

        return $content;
    }
}
