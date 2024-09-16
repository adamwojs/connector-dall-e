<?php

declare(strict_types=1);

namespace AdamWojs\Bundle\ConnectorDallE\DAM\Tab;

use Ibexa\Connector\Dam\View\Search\Tab\GenericSearchTab;

final class DallE2SearchTab extends GenericSearchTab
{
    public function renderView(array $parameters): string
    {
        return $this->twig->render(
            '@ibexadesign/connector_dalle/tab/dalle2_search.html.twig',
            [
                'form' => $this->getForm()->createView(),
                'source' => $this->source,
            ]
        );
    }
}
