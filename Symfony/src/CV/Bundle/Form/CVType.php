<?php

namespace ArchiWeb\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArchiWeb\Bundle\Form\ImageType;

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
      		->add('content',   'textarea')
      		->add('published', 'checkbox', array('required' => false))
      		->add('image',new ImageType())
      		->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArchiWeb\Bundle\Entity\CV'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'archiweb_bundle_cv';
    }
}
