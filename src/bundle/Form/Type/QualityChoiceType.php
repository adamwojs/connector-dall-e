<?php

declare(strict_types=1);

namespace AdamWojs\Bundle\ConnectorDallE\Form\Type;

use Ibexa\Contracts\ConnectorAi\Action\TextToImage\Action as TextToImageAction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class QualityChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'Standard' => TextToImageAction::QUALITY_STANDARD,
                'HD' => TextToImageAction::QUALITY_HD,
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
