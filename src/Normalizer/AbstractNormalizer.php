<?php

namespace App\Normalizer;

use App\Normalizer\NormalizerInterface;

abstract class AbstractNormalizer implements NormalizerInterface
{
    private $exceptionTypes;

    public function __construct(array $exceptionTypes)
    {
        $this->exceptionTypes = $exceptionTypes;
    }

    public function supports(\Exception $exception): bool
    {
        return in_array(get_class($exception), $this->exceptionTypes, true);
    }
}
