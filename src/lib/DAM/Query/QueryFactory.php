<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\DAM\Query;

use Ibexa\Contracts\Connector\Dam\Search\Query as BaseQuery;
use Ibexa\Contracts\Connector\Dam\Search\QueryFactory as QueryFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class QueryFactory implements QueryFactoryInterface
{
    /** @var string[] */
    private array $allowedSizes;

    /** @var string[] */
    private array $allowedQualities;

    /**
     * @param string[] $allowedSizes
     * @param string[] $allowedQualities
     */
    public function __construct(array $allowedSizes = [], array $allowedQualities = [])
    {
        $this->allowedSizes = $allowedSizes;
        $this->allowedQualities = $allowedQualities;
    }

    public function buildFromRequest(Request $request): BaseQuery
    {
        $prompt = $request->query->get('query');
        if ($prompt === null) {
            throw new BadRequestHttpException('Request do not contain all required arguments');
        }

        $query = new Query($prompt);

        $size = $request->query->get('size');
        if (is_string($size)) {
            $this->assertValidSize($size);
            $query->setSize($size);
        }

        $quality = $request->query->get('quality');
        if (is_string($quality)) {
            $this->assertValidQuality($quality);
            $query->setQuality($quality);
        }

        $numberOfImages = $request->query->getInt('numberOfImages');
        if ($numberOfImages > 0) {
            $query->setNumberOfImages($numberOfImages);
        }

        return $query;
    }

    private function assertValidSize(string $size): void
    {
        if (!in_array($size, $this->allowedSizes, true)) {
            throw new BadRequestHttpException('Invalid size value. Allowed values: ' . implode(', ', $this->allowedSizes));
        }
    }

    private function assertValidQuality(string $quality): void
    {
        if (!in_array($quality, $this->allowedQualities, true)) {
            throw new BadRequestHttpException('Invalid quality value. Allowed values: ' . implode(', ', $this->allowedQualities));
        }
    }
}
