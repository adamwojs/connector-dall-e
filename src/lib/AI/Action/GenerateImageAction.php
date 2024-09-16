<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\AI\Action;

use Ibexa\Contracts\ConnectorAi\Action\DataType\Text;
use Ibexa\Contracts\ConnectorAi\Action\TextToImage\Action;
use Ibexa\Contracts\ConnectorAi\DataType;

final class GenerateImageAction extends Action
{
    private Text $text;

    private int $numberOfImages = 1;

    public function __construct(
        Text $text,
        string $size = self::SIZE_SQUARE,
        string $quality = self::QUALITY_STANDARD
    ) {
        parent::__construct($size, $quality);

        $this->text = $text;
    }

    public function getNumberOfImages(): int
    {
        return $this->numberOfImages;
    }

    public function setNumberOfImages(int $numberOfImages): void
    {
        $this->numberOfImages = $numberOfImages;
    }

    public function getInput(): Text
    {
        return $this->text;
    }

    public function getActionTypeIdentifier(): string
    {
        return 'generate_image';
    }
}
