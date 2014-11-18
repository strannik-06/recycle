<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Batterypack;
use AppBundle\Entity\BatterypackRepository;
use AppBundle\Form\Type\BatterypackType;

/**
 * Class BatterypackController
 */
class BatterypackController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Batterypack');
        /* @var BatterypackRepository$repository */
        $batterypacks = $repository->findAllGroupedByType();

        return $this->render('AppBundle:Batterypack:index.html.twig',
            array('batterypacks' => $batterypacks));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        $batterypack = new Batterypack();
        $form = $this->createForm(new BatterypackType(), $batterypack);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batterypack);
            $em->flush();

            return $this->redirect($this->generateUrl('batterypack_index'));
        }

        return $this->render('AppBundle:Batterypack:new.html.twig',
            array('form' => $form->createView()));
    }
}
