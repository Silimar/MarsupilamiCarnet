<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PrincipaleController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $marsus = $em->getRepository("AppBundle:User")->findAll();

        return $this->render(':marsupilami/Principale:principale.html.twig', array("marsus" => $marsus));
    }

    /**
     * @Route("/ajouterAmi/{idAmi}", name="ajouter")
     */
    public function AddAmiAction(Request $request, $idAmi)
    {
        $user = $this->getUser();
        $ami = $this->getDoctrine()->getManager()->getRepository("AppBundle:User")->find($idAmi);
        $user->addAmi($ami);
        $this->getDoctrine()->getManager()->persist($user);
        return $this->redirectToRoute("homepage");
    }
}
