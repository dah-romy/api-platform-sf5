<?php

namespace App\Normalizer;

interface NormalizerInterface
{
    public function normalize(\Exception $exception): array;
    public function supports(\Exception $exception): bool;
}