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
use Zend\Session\Container;
 
use Admin\Entity\Login;

class LoginController extends AbstractActionController
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
            $this->storage = $this->getServiceLocator()->get('Admin\Controller\AuthStorageController');
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
        $form = $this->getFormLogin();
        $form->setData($data);
        
        if ( $this->getServiceLocator()->get('ServiceLocator')->hasIdentity() )
        {
            $this->redirect()->toRoute('admin');
        }
        else if ( array_key_exists('username', $data) )
        {
            if ( $form->isvalid() )
            {
                if ( $this->authenticate($data['username'], $data['password']) ) 
                {
                    $userSession = new Container('user');
                    $userSession->username = $data['username'];
                    $this->redirect()->toRoute('admin');
                }
                else
                {
                    $this->flashMessenger()->addErrorMessage("Usuário e(ou) senha inválidos.");
                    $this->redirect()->toRoute('login');
                }
            }
        }
        
        return array('form' => $form);
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
        $authService = $this->getServiceLocator()->get('ServiceLocator');
        
        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($username);
        $adapter->setCredentialValue($password);
        $authResult = $authService->authenticate();
        
        return $authResult->isValid(); 
    }
    
    /**
     * Gera o formulário de login/autenticação no sistema.
     * 
     * @return type
     */
    private function getFormLogin()
    {
        if ( !$this->form ) 
        {
            $Login = new Login();
            $builder  = new AnnotationBuilder();
            
            $this->form = $builder->createForm($Login);
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
        //$this->getAuthService()->clearIdentity();
        $this->flashMessenger()->addInfoMessage("Você foi desconectado.");
        
        return $this->redirect()->toRoute('login');
    }
}
