<?php

declare(strict_types=1);

namespace AdamWojs\ConnectorDallE\DAM;

use AdamWojs\ConnectorDallE\AI\Action\GenerateImageAction;
use Ibexa\Contracts\Connector\Dam\Asset;
use Ibexa\Contracts\Connector\Dam\AssetCollection;
use Ibexa\Contracts\Connector\Dam\AssetIdentifier;
use Ibexa\Contracts\Connector\Dam\AssetMetadata;
use Ibexa\Contracts\Connector\Dam\AssetSource;
use Ibexa\Contracts\Connector\Dam\AssetUri;
use Ibexa\Contracts\Connector\Dam\Handler\Handler as HandlerInterface;
use Ibexa\Contracts\Connector\Dam\Search\AssetSearchResult;
use Ibexa\Contracts\Connector\Dam\Search\Query;
use Ibexa\Contracts\ConnectorAi\Action\ActionHandlerInterface;
use Ibexa\Contracts\ConnectorAi\Action\DataType\Text;
use Ibexa\Contracts\ConnectorAi\ActionServiceInterface;

final class Handler implements HandlerInterface
{
    private ActionServiceInterface $actionService;

    private ?ActionHandlerInterface $handler;

    private string $source;

    public function __construct(
        ActionServiceInterface $actionService,
        ?ActionHandlerInterface $handler,
        string $source
    ) {
        $this->actionService = $actionService;
        $this->handler = $handler;
        $this->source = $source;
    }

    /**
     * @param \AdamWojs\ConnectorDallE\DAM\Query\Query $query
     */
    public function search(Query $query, int $offset = 0, int $limit = 20): AssetSearchResult
    {
        $response = $this->actionService->execute(
            $this->createAssetFormQuery($query),
            null,
            $this->handler
        )->getOutput();

        $assets = [];
        foreach ($response->getList() as $url) {
            $assets[] = new Asset(
                new AssetIdentifier($url),
                new AssetSource($this->source),
                new AssetUri($url),
                new AssetMetadata([
                    'alternativeText' => $query->getPhrase(),
                ]),
            );
        }

        return new AssetSearchResult(count($assets), new AssetCollection($assets));
    }

    public function fetchAsset(string $id): Asset
    {
        return new Asset(
            new AssetIdentifier($id),
            new AssetSource($this->source),
            new AssetUri($id),
            new AssetMetadata([
                'alternativeText' => '',
            ]),
        );
    }

    /**
     * @param \AdamWojs\ConnectorDallE\DAM\Query\Query $query
     */
    private function createAssetFormQuery(Query $query): GenerateImageAction
    {
        $action = new GenerateImageAction(new Text([$query->getPhrase()]));
        $action->setSize($query->getSize() ?? GenerateImageAction::SIZE_PORTRAIT);
        $action->setQuality($query->getQuality() ?? GenerateImageAction::QUALITY_HD);
        $action->setNumberOfImages($query->getNumberOfImages() ?? 1);

        return $action;
    }
}
