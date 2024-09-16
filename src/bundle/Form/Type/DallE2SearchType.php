<?php

declare(strict_types=1);

namespace AdamWojs\Bundle\ConnectorDallE\Form\Type;

use Ibexa\Connector\Dam\Form\Search\GenericSearchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;

final class DallE2SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'numberOfImages',
            RangeType::class,
            [
                'label' => 'Number of images',
                'required' => false,
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                ],
                'data' => 3,
            ]
        );
    }

    public function getParent(): string
    {
        return GenericSearchType::class;
    }
}
