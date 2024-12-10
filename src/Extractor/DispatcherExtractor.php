<?php

namespace Stakovicz\JuiceExtractorBundle\Extractor;

use Stakovicz\JuiceExtractorBundle\Event\DisplayExtractionEvent;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsDecorator(ExtractorChainInterface::class)]
readonly class DispatcherExtractor implements ExtractorChainInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private ExtractorChainInterface  $inner)
    {
    }

    public function extract(string $fruit): string
    {
        $extraction = $this->inner->extract($fruit);
        $event = new DisplayExtractionEvent($extraction);
        $this->eventDispatcher->dispatch($event);

        return $event->getExtraction();
    }
}