<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 07/09/2016
 * Time: 17:42
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('body', TextareaType::class)
            ->add(
                'publishedAt',
                DateTimeType::class,
                [
                    'data' => new \DateTime("now"),
                ]
            );


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Article',
                'attr' => ['novalidate' => 'novalidate'],
            ]
        );
    }


    public function getName()
    {
        return 'app_bundle_article_type';
    }
}