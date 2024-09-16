<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\DAM\Variation;

use Ibexa\Contracts\Connector\Dam\Asset;
use Ibexa\Contracts\Connector\Dam\Variation\AssetVariation;
use Ibexa\Contracts\Connector\Dam\Variation\AssetVariationGenerator as AssetVariationGeneratorInterface;
use Ibexa\Contracts\Connector\Dam\Variation\Transformation;

final class AssetVariationGenerator implements AssetVariationGeneratorInterface
{
    public function generate(Asset $asset, Transformation $transformation): AssetVariation
    {
        return new AssetVariation(
            $asset,
            $asset->getAssetUri(),
            $transformation
        );
    }
}
