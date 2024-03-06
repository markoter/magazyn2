<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Transaction;
use App\Entity\User;
use App\Entity\Warehouse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity')
            ->add('is_in')
            ->add('vat')
            ->add('unit_price')
            ->add('transaction_date')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'username',
            ])
            ->add('warehouse', EntityType::class, [
                'class' => Warehouse::class,
'choice_label' => 'name',
            ])
            ->add('article', EntityType::class, [
                'class' => Article::class,
'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
