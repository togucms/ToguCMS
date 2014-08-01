<?php

namespace Application\Togu\ApplicationModelsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    public function indexAction(Request $request)
    {

    	$form = $this->createFormBuilder(array())
	    	->add('name', 'text')
	    	->add('email', 'email')
	    	->add('text', 'textarea')
	    	->add('formId', 'hidden')
    	->getForm();

    	$form->handleRequest( $request );

    	if(! $form->isValid()) {
    		return new JsonResponse(array(
    			"success" => false
    		));
    	}
    	$data = $form->getData();

    	$manager = $this->get('doctrine_phpcr.odm.default_document_manager');
    	$document = $manager->find(null, $data['formId']);

    	$message = \Swift_Message::newInstance()
    	->setSubject('Contact')
    	->setFrom($data['email'])
    	->setTo($document->getEmail())
    	->setBody(
   			$this->renderView(
   				'ApplicationToguApplicationModelsBundle:Contact:email.txt.twig',
   				$data
    		)
    	)
    	;
    	$this->get('mailer')->send($message);

        return new JsonResponse(array(
        	"success" => true
        ));
    }

}
