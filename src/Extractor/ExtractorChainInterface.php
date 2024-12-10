<?php

namespace Stakovicz\JuiceExtractorBundle\Extractor;

interface ExtractorChainInterface
{
    public function extract(string $fruit): string;
}