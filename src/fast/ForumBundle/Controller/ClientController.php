<?php

namespace fast\ForumBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Forms;
use fast\ForumBundle\Entity\Threat;
use fast\ForumBundle\Entity\Message;
use fast\ForumBundle\Form\ThreatType;
use fast\ForumBundle\Form\MessageType;

class ClientController extends Controller
{
    public function isAuthorized(){
      $session = new Session();
      if ($session->get('apodo')) {
        return true;
      }
      return false;
    }
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      if (!self::isAuthorized()) {
        return $this->redirect('/login');
      }
      $em = $this->getDoctrine()->getManager();
      $threats=$em->getRepository("fastForumBundle:Threat")->findAll();
      return $this->render('fastForumBundle:Client:index.html.twig',array('threats'=>$threats));
    }
    public function loginAction(Request $request)
    {
      if ($request->isMethod('POST')) {
        if ($request->get('login')) {
          $session = new Session();
          $session->set('apodo',$request->get('apodo'));
          return $this->redirect('/');
        }
      }
      return $this->render('fastForumBundle:Client:login.html.twig');
    }
    public function threatAction($id, Request $request){
      $em = $this->getDoctrine()->getManager();
      $threat = $em->getRepository('fastForumBundle:Threat')->findOneBy(array('id'=>$id));
      $message = new Message();
      $form = $this->createForm(MessageType::class,$message);
      $form->handleRequest($request);
      $session = new Session();
      $messages = $em->getRepository('fastForumBundle:Message')->findByIdthreat($threat);
      if ($form->isSubmitted() && $form->isValid()) {
        $message->setUsername($session->get('apodo'));
        $message->setIdthreat($threat);
        $em->persist($message);
        $em->flush();
      }
      return $this->render('fastForumBundle:Client:threat.html.twig', array('threat'=>$threat,
      'form'=>$form->createView(),
      'messages'=>$messages
    ));
    }
    public function addthreatAction(Request $request){
      $threat = new Threat();
      $em = $this->getDoctrine()->getManager();
      $form = $this->createForm(ThreatType::class,$threat);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($threat);
        $em->flush();
        return $this->redirect('/');
      }
      return $this->render('fastForumBundle:Client:addthreat.html.twig',array('form'=>$form->createView()));
    }
}
