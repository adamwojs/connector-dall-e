<?php

declare(strict_types=1);

namespace AdamWojs\Bundle\ConnectorDallE\Form\Type;

use Ibexa\Connector\Dam\Form\Search\GenericSearchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class DallE3SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'size',
            SizeChoiceType::class,
            [
                'label' => 'Size',
            ]
        );

        $builder->add(
            'quality',
            QualityChoiceType::class,
            [
                'label' => 'Quality',
            ]
        );
    }

    public function getParent(): string
    {
        return GenericSearchType::class;
    }
}
