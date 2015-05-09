<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author augusto
 */
namespace Site\Controller;

use Zend\Mail;
use System\Controller\Controller;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;

class ContactController extends Controller
{
    public function contactAction()
    {   
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm("Site\Entity\Contact");
        $request = $this->getRequest();
        
        $queryData = $this->params()->fromQuery();
        
        if ( !empty($queryData) )
        {
            $form->setData($queryData);
        }
        
        if ( $request->isPost() ) 
        {
            $postData = $request->getPost()->toArray();
            $form->setData($postData);
            
            if ( $form->isValid() )
            {
                $this->sendcontactAction();
            }
        }
        
        return new ViewModel(array('form' => $form));
    }
    
    public function sendcontactAction()
    {
        $request = $this->getRequest();
        $postData = $request->getPost()->toArray();
        
        exit(var_export($postData));
        
        
        //Obter os emails dos usuários que serão enviados.
        
        /**
        $mail = new Mail\Message();
        $mail->setBody('This is the text of the email.');
        $mail->setFrom('Freeaqingme@example.org', 'Sender\'s name');
        $mail->addTo('Matthew@example.com', 'Name of recipient');
        $mail->setSubject('TestSubject');

        $transport = new Mail\Transport\Sendmail();
        $transport->send($mail);

        $this->flashMessenger()->addSuccessMessage("Contato enviado com sucesso, em breve estaremos retornando, obrigado!");
        
        return $this->redirect()->toRoute('contact');
         * 
         */
    }
}

?>
