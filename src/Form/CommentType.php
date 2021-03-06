<?php
/**
 * Comment type.
 */

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecipeType.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param array $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'user_nick',
            TextType::class,
            [
                'label' => 'label_nick',
                'required' => true,
                'attr' => ['max_length' => 25],
            ]
        );
        $builder->add(
            'user_email',
            EmailType::class,
            [
                'label' => 'label_email',
                'required' => true,
                'attr' => ['max_length' => 128],
            ]
        );
        $builder->add(
            'content',
            TextType::class,
            [
                'label' => 'content',
                'required' => true,
                'attr' => ['max_length' => 1020],
            ]
        );
        $builder->add(
            'recipe',
            EntityType::class,
            [
                'class' => Recipe::class,
                'choice_label' => function ($recipe) {
                    return $recipe->getId();
                },
                'label' => 'label_id_recipe',
                'placeholder' => 'label_none',
                'required' => true,
            ]
        );
    }

    /**
     * Configures the options for this type.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Comment::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'comment';
    }
}
