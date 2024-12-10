<?php

namespace Stakovicz\JuiceExtractorBundle\Extractor;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Twig\Environment;

#[AsDecorator(decorates: AgrumeExtractor::class)]
readonly class SuperAgrumeExtractor implements ExtractorInterface
{
    public function __construct(
        private Environment        $twig,
        #[AutowireDecorated]
        private ExtractorInterface $inner,
    )
    {
    }

    public function supports(string $fruit): bool
    {
        return $this->inner->supports($fruit);
    }

    public function displayExtraction(string $fruit): string
    {
        //usleep(150_000);
        return $this->twig->render('agrume.html.twig', [
            'fruit' => $fruit,
            'inner' => $this->inner->displayExtraction($fruit),
        ]);
    }
}