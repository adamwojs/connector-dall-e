<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\DAM\Query;

use Ibexa\Contracts\Connector\Dam\Search\Query as BaseQuery;

final class Query extends BaseQuery
{
    private ?string $size = null;

    private ?string $quality = null;

    private ?int $numberOfImages = null;

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): void
    {
        $this->size = $size;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(?string $quality): void
    {
        $this->quality = $quality;
    }

    public function getNumberOfImages(): ?int
    {
        return $this->numberOfImages;
    }

    public function setNumberOfImages(?int $numberOfImages): void
    {
        $this->numberOfImages = $numberOfImages;
    }
}
