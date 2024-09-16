<?php

declare(strict_types=1);

namespace AdamWojs\Bundle\ConnectorDallE\Form\Type;

use Ibexa\Contracts\ConnectorAi\Action\TextToImage\Action as TextToImageAction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SizeChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'Square (1024x1024)' => TextToImageAction::SIZE_SQUARE,
                'Portrait (1024x1792)' => TextToImageAction::SIZE_PORTRAIT,
                'Landscape (1792x1024)' => TextToImageAction::SIZE_LANDSCAPE,
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
