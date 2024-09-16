<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\AI\Handler;

use AdamWojs\ConnectorDallE\AI\Action\GenerateImageAction;
use AdamWojs\ConnectorDallE\AI\Action\GenerateImageActionResponse;
use AdamWojs\ConnectorDallE\AI\DataType\UrlList;
use Ibexa\Contracts\ConnectorAi\Action\ActionHandlerInterface;
use Ibexa\Contracts\ConnectorAi\ActionInterface;
use Ibexa\Contracts\ConnectorAi\ActionResponseInterface;
use Ibexa\Contracts\ConnectorOpenAi\ClientProviderInterface;

final class DallE3GenerateImageActionHandler implements ActionHandlerInterface
{
    private const MODEL = 'dall-e-3';
    private const IDENTIFIER = 'openai-generate-image/dall-e-v2';

    private ClientProviderInterface $clientProvider;

    public function __construct(
        ClientProviderInterface $clientProvider
    ) {
        $this->clientProvider = $clientProvider;
    }

    public function supports(ActionInterface $action): bool
    {
        return $action instanceof GenerateImageAction;
    }

    /**
     * @param \AdamWojs\ConnectorDallE\AI\Action\GenerateImageAction $action
     */
    public function handle(ActionInterface $action, array $context = []): ActionResponseInterface
    {
        $client = $this->clientProvider->getClient();

        $response = $client->images()->create([
            'model' => self::MODEL,
            'prompt' => $action->getInput()->getText(),
            'n' => $action->getNumberOfImages(),
            'size' => $action->getSize(),
            'response_format' => 'url',
        ]);

        $urls = [];
        foreach ($response->data as $data) {
            $urls[] = $data->url;
        }

        /** @phpstan-ignore-next-line */
        return new GenerateImageActionResponse(new UrlList($urls));
    }

    public static function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }
}
