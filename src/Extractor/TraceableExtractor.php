<?php

declare(strict_types=1);

namespace Stakovicz\JuiceExtractorBundle\Extractor;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Component\DependencyInjection\Attribute\When;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsDecorator(ExtractorChainInterface::class)]
#[When('dev')]
final readonly class TraceableExtractor implements ExtractorChainInterface
{
    public function __construct(
        private Stopwatch                                    $stopwatch,
        #[AutowireDecorated] private ExtractorChainInterface $inner
    )
    {
    }

    public function extract(string $fruit): string
    {
        $this->stopwatch->start($fruit);
        $return = $this->inner->extract($fruit);
        $this->stopwatch->stop($fruit);

        return $return;
    }
}