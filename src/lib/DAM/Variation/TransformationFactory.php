<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\DAM\Variation;

use Ibexa\Contracts\Connector\Dam\Variation\Transformation;
use Ibexa\Contracts\Connector\Dam\Variation\TransformationFactory as TransformationFactoryInterface;

final class TransformationFactory implements TransformationFactoryInterface
{
    /**
     * @param array<string, mixed> $transformationParameters
     */
    public function build(?string $transformationName = null, array $transformationParameters = []): Transformation
    {
        return new Transformation($transformationName, $transformationParameters);
    }

    public function buildAll(): iterable
    {
        return [];
    }
}
