<?php

namespace ArchiWeb\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use CV\Bundle\Form\CVType;
use CV\Bundle\Entity\CV;

class CVController extends Controller
{
    public function indexAction($page)
  {
    
    $mailer = $this->container->get('mailer'); 
    
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
    
	$listCVs = array(
      array(
        'title'   => 'Recherche développpeur Symfony2',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );
    
    return $this->render('SiteBundle:CV:index.html.twig', array(
      'listCVs' => $listCVs
    ));

  }

  public function viewAction()
  {
    $cv = new CV;
    $cv->setContent("Recherche développeur Symfony2.");
	
    return $this->render('SiteBundle:CV:view.html.twig', array(
      'cv' => $cv
    ));
  }

  public function addAction(Request $request)
  {
    $cv = new CV();
   	$form = $this->get('form.factory')->create(new CVType, $cv);
   	
    if ($form->handleRequest($request)->isValid()) {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($cv);
    	$em->flush();
    	
    	$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
    	
    	return $this->redirect($this->generateUrl('Site_view', array('id' => $cv->getId())));
    }
    
    return $this->render('SiteBundle:CV:add.html.twig', array(
      	'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {
    $cv = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('SiteBundle:CV:edit.html.twig', array(
      'cv' => $cv
    ));
  }

  public function deleteAction($id)
  {

    return $this->render('SiteBundle:CV:delete.html.twig');
  }
  
  public function menuAction()
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listCVs = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('SiteBundle:CV:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listCVs' => $listCVs
    ));
  }
}