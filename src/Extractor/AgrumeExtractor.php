<?php

namespace Stakovicz\JuiceExtractorBundle\Extractor;

use Twig\Environment;

readonly class AgrumeExtractor implements ExtractorInterface
{
    public function __construct(private Environment $twig)
    {
    }

    public function supports(string $fruit): bool
    {
        return $fruit === 'agrume';
    }

    public function displayExtraction(string $fruit): string
    {
        usleep(500_000);
        return $this->twig->render('extractor.html.twig', ['fruit' => $fruit]);
    }
}