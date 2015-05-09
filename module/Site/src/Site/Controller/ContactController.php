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
        
        return new ViewModel(array('form' => $form, 'flashSuccessMessages' => $this->flashMessenger()->getSuccessMessages()));
    }
    
    /**
     * Ação de envio do email de contato pelo site.
     */
    private function sendcontactAction()
    {
        $request = $this->getRequest();
        $postData = $request->getPost()->toArray();
        
        $toEmails = $this->getEmailsFromActiveLogins();
        $applicationConfig = $this->getServiceLocator()->get('config');
        
        if ( count($toEmails) > 0 )
        {
            foreach ( $toEmails as $toEmail )
            {
                /**
                
                
                $mail = new Mail\Message();
                $mail->setBody('This is the text of the email.');
                $mail->setFrom('Freeaqingme@example.org', 'Sender\'s name');
                $mail->addTo('Matthew@example.com', 'Name of recipient');
                $mail->setSubject('TestSubject');

                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);                
                 * 
                 */
            }
        }

        $this->flashMessenger()->addSuccessMessage("Contato enviado com sucesso! Em breve estaremos retornando, obrigado.");
        
        return $this->redirect()->toRoute('contact');
    }
    
    /**
     * Obtém todos e-mails de todos os logins
     * ativos do sistema, para receberem o contato
     * enviado pelo site.
     * 
     * @return array
     */
    private function getEmailsFromActiveLogins()
    {
        $login = $this->getEntityManager()->getRepository('System\Entity\Login');
        $queryBuilder = $login->createQueryBuilder("l");
        
        $result = $queryBuilder->select("l.email, l.name")
                               ->where("l.active = TRUE")
                               ->andWhere("l.email <> ''")
                               //->andWhere($queryBuilder->expr()->isNotNull("l.email"))
                               ->getQuery()
                               ->getResult();
            
        return $result;
    }
    
    /**
     * Gera o corpo da mensagem para ser 
     * enviado para o email.
     * 
     * @param type $data
     * @return type
     */
    private function generateBodyMessage($data)
    {
        $body = "<strong>Nome: </strong>{$data['name']}<br>";
        $body .= "<strong>Cidade: </strong>{$data['city']}<br>";
        $body .= "<strong>E-mail: </strong>{$data['email']}<br>";
        
        if ( strlen($data['phone']) > 0 )
        {
            $body .= "<strong>Telefone: </strong>{$data['phone']}<br>";
        }
        
        if ( strlen($data['cpf']) > 0 )
        {
            $body .= "<strong>CPF: </strong>{$data['cpf']}<br>";
        }
        else if ( strlen($data['cnpj']) > 0 )
        {
            $body .= "<strong>CNPJ: </strong>{$data['cnpj']}<br>";
        }
        
        $body .= "<br>{$data['message']}";
        
        return $body;
    }
}

?>
