<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BatterypackType used for batterypack form rendering
 */
class BatterypackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'text')
            ->add('amount', 'integer')
            ->add('name', 'text', array('required' => false))
            ->add('save', 'submit', array('label' => 'Save'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "batterypack";
    }
}
