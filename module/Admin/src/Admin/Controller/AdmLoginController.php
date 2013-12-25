<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
 
use Admin\Entity\AdmLogin;

class AdmLoginController extends AbstractActionController
{
    protected $form;
    protected $storage;
     
    /**
     * Retorna o controle de armazenamento da sessão.
     * 
     * @return type
     */
    public function getSessionStorage()
    {
        if ( !$this->storage ) 
        {
            $this->storage = $this->getServiceLocator()
                                  ->get('Admin\Controller\AdmAuthStorageController');
        }
         
        return $this->storage;
    }
     
    /**
     * Ação de login no sistema.
     * 
     * @return array
     */    
    public function loginAction()
    {
        $data = $this->getRequest()->getPost();
        
        if ( strlen($data['username']) > 0 )
        {
            if ( $this->authenticate($data['username'], $data['password']) ) 
            {
                return $this->redirect()->toRoute('home');
            }
        }
        
        $form = $this->getFormLogin();
        //$this->flashmessenger()->addMessage($message);
        
        return array(
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }
    
    /**
     * Método de autenticação do sistema.
     * 
     * @param String $username
     * @param String $password
     * @return boolean
     */
    private function authenticate($username, $password)
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        
        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($username);
        $adapter->setCredentialValue($password);
        $authResult = $authService->authenticate();
        
        exit(var_dump($authResult));
        
        return $authResult->isValid(); 
    }
    
    /**
     * Gera o formulário de login/autenticação no sistema.
     * 
     * @return type
     */
    public function getFormLogin()
    {
        if ( !$this->form ) 
        {
            $AdmLogin = new AdmLogin();
            $builder  = new AnnotationBuilder();
            
            $this->form = $builder->createForm($AdmLogin);
        }
         
        return $this->form;
    }
     
    /**
     * Ação de logout.
     * 
     * @return type
     */
    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
         
        $this->flashmessenger()->addMessage("Você foi desconectado do sistema.");
        return $this->redirect()->toRoute('login');
    }
}
