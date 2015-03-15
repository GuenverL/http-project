<?php

namespace CV\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CVType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
      		->add('date',      'date')
      		->add('title',     'text')
      		->add('author',    'text')
      		->add('file',      'file')
      		->add('published', 'checkbox', array('required' => false))
      		->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CV\Bundle\Entity\CV'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cv_bundle_cv';
    }
}
