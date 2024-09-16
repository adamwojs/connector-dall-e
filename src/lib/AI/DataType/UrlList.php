<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\AI\DataType;

use Ibexa\Contracts\ConnectorAi\DataType;

/**
 * @implements \Ibexa\Contracts\ConnectorAi\DataType<string>
 */
final class UrlList implements DataType
{
    public const IDENTIFIER = 'url';

    /** @var non-empty-array<string> */
    private array $urls;

    /**
     * @param non-empty-array<string> $urls
     */
    public function __construct(array $urls)
    {
        $this->urls = $urls;
    }

    public function getList(): array
    {
        return $this->urls;
    }

    public static function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }
}
