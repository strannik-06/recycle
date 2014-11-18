<?php
namespace Stas\RecycleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Stas\RecycleBundle\Entity\Batterypack;
use Stas\RecycleBundle\Entity\BatterypackRepository;
use Stas\RecycleBundle\Form\Type\BatterypackType;

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
        $repository = $this->getDoctrine()->getRepository('StasRecycleBundle:Batterypack');
        /* @var BatterypackRepository$repository */
        $batterypacks = $repository->findAllGroupedByType();

        return $this->render('StasRecycleBundle:Batterypack:index.html.twig',
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

            return $this->redirect($this->generateUrl('stas_recycle_batterypack_index'));
        }

        return $this->render('StasRecycleBundle:Batterypack:new.html.twig',
            array('form' => $form->createView()));
    }
}
