<?php
namespace Stas\RecycleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Stas\RecycleBundle\Entity\Batterypack;

/**
 * Class BatterypackController
 */
class BatterypackController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('StasRecycleBundle:Batterypack');
        $batterypacks = $repository->findAllGroupedByType();

        return $this->render('StasRecycleBundle:Batterypack:index.html.twig',
            array('batterypacks' => $batterypacks));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $batterypack = new Batterypack();
        $form = $this->createFormBuilder($batterypack)
            ->add('type', 'text')
            ->add('amount', 'integer')
            ->add('name', 'text', array('required' => false))
            ->add('save', 'submit', array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batterypack);
            $em->flush();

            return $this->redirect($this->generateUrl('stas_recycle_batterypack_index'));
        }

        return $this->render('StasRecycleBundle:Batterypack:new.html.twig',
            array('form' => $form->createView()));
    }
}
