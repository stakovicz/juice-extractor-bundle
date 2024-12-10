<?php

namespace Stakovicz\JuiceExtractorBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class DisplayExtractionEvent extends Event
{
    public function __construct(private string $extraction)
    {
    }

    public function getExtraction(): string
    {
        return $this->extraction;
    }

    public function setExtraction(string $extraction): void
    {
        $this->extraction = $extraction;
    }

}