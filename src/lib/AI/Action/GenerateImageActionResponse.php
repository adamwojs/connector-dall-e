<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\AI\Action;

use AdamWojs\ConnectorDallE\AI\DataType\UrlList;
use Ibexa\Contracts\ConnectorAi\ActionResponseInterface;
use Ibexa\Contracts\ConnectorAi\DataType;

final class GenerateImageActionResponse implements ActionResponseInterface
{
    private UrlList $urls;

    public function __construct(UrlList $urls)
    {
        $this->urls = $urls;
    }

    public function getOutput(): DataType
    {
        return $this->urls;
    }
}
