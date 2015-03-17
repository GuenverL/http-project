<?php

namespace CV\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use CV\Bundle\Form\CVType;
use CV\Bundle\Form\CVEditType;
use CV\Bundle\Form\CVDomaine;
use CV\Bundle\Form\CVDomaineRepository;
use CV\Bundle\Entity\CV;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CVController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 3;

        $listCVs = $this->getDoctrine()
            ->getManager()
            ->getRepository('CVBundle:CV')
            ->getCVs($page,$nbPerPage)
        ;

        $nbPages = ceil(count($listCVs)/$nbPerPage);

        if ($page > $nbPages) {
            if ($page > 1) {
                throw $this->createNotFoundException("La page ".$page." n'existe pas.");
            }
        }

        return $this->render('CVBundle:CV:index.html.twig', array(
        'listCVs' => $listCVs,
        'nbPages' => $nbPages,
        'page'    => $page
        ));
    }
/**
 * @ParamConverter("advert", options={"mapping": {"advert_id": "id"}})
 */
    public function viewAction(Advert $advert, $id)
    {
    /*$em = $this->getDoctrine()->getManager();

    $cv = $em->getRepository('CVBundle:CV')->find($id);

    if ($cv === null) {
      throw $this->createNotFoundException("Le CV d'id ".$id." n'existe pas.");
    }

    $listCVDomaines = $em->getRepository('CVBundle:CVDomaine')->findByCv($cv);

    return $this->render('CVBundle:CV:view.html.twig', array(
      'cv'           => $cv,
      'listCVDomaines' => $listCVDomaines,
    ));  */
    }

  /**
   * @Security("has_role('ROLE_AUTEUR')")
   */
  public function addAction(Request $request)
  {
    $cv = new CV();
   	$form = $this->createForm(new CVType(), $cv);
   	
    if ($form->handleRequest($request)->isValid()) {
        $cv->getImage()->upload();
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($cv);
    	$em->flush();
    	
    	$request->getSession()->getFlashBag()->add('notice', 'CV bien enregistré.');
    	
    	return $this->redirect($this->generateUrl('CV_view', array('id' => $cv->getId())));
    }
    
    return $this->render('CVBundle:CV:add.html.twig', array(
      	'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $cv = $em->getRepository('CVBundle:CV')->find($id);

    if (null === $cv) {
      throw new NotFoundHttpException("Le cv d'id".$id." n'existe pas.");
    }

    $form = $this->createForm(new CVEditType(), $cv);

    if ($form->handleRequest($request)->isValid()) {
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'CV bien modifié.');

      return $this->redirect($this->generateUrl('CV_view', array('id' => $cv->getId())));
    }

    return $this->render('CVBundle:CV:edit.html.twig', array(
      'form'   => $form->createView(),
      'cv' => $cv
    ));
  }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

    $cv = $em->getRepository('CVBundle:CV')->find($id);

    if (null === $cv) {
      throw new NotFoundHttpException("Le CV d'id ".$id." n'existe pas.");
    }

    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($cv);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le CV a bien été supprimé.");
      return $this->redirect($this->generateUrl('CV_home'));
   }

    return $this->render('CVBundle:CV:delete.html.twig', array(
      'cv' => $cv,
      'form'   => $form->createView()
    ));
  }

  public function menuAction($limit = 3)
  {
    $listCVs = $this->getDoctrine()
      ->getManager()
      ->getRepository('CVBundle:CV')
      ->findBy(
        array(),
        array('date' => 'desc'),
        $limit,
        0
    );

    return $this->render('CVBundle:CV:menu.html.twig', array(
      'listCVs' => $listCVs
    ));
  }
    /**
    * @ParamConverter("date", options={"format": "Y-m-d"})
    */
    public function viewListAction(\Datetime $date)

}