<?php

namespace Stakovicz\JuiceExtractorBundle\Extractor;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

#[AsAlias(id: ExtractorChainInterface::class)]
readonly class ExtractorChain implements ExtractorChainInterface
{
    public function __construct(
        #[AutowireIterator('app.extractor')]
        private iterable $extractors
    )
    {
    }

    public function extract(string $fruit): string
    {
        /** @var ExtractorInterface[] $extractors */
        foreach ($this->extractors as $extractor) {
            if ($extractor->supports($fruit)) {
                return $extractor->displayExtraction($fruit);
            }
        }

        throw new \RuntimeException(sprintf('Extractor not found for fruit: "%s"', $fruit));
    }
}