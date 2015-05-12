<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace System\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Session\Container;
 
use System\Entity\Login;

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
            $this->storage = $this->getServiceLocator()->get('System\Controller\AuthStorageController');
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
        
        $dataLogin = $this->findLoginByUsername($data['username']);
        $data['name'] = $dataLogin['name'] ? $dataLogin['name'] : "Não nomeado";
        
        $form->setData($data);
        $sucessRoute = \System\Controller\Controller::MODULE_MANAGER;
        
        if ( $this->getServiceLocator()->get('ServiceLocator')->hasIdentity() )
        {
            $this->redirect()->toRoute($sucessRoute);
        }
        else if ( array_key_exists('username', $data) )
        {
            if ( $form->isvalid() )
            {
                if ( $this->authenticate($data['username'], $data['password']) ) 
                {
                    $userSession = new Container('Login');
                    $userSession->username = $data['username'];
                    $userSession->nameuser = $data['name'];
                    $userSession->iduser = $dataLogin['id'];
                    
                    $this->redirect()->toRoute($sucessRoute);
                }
                else
                {
                    $this->flashMessenger()->addErrorMessage("Usuário e(ou) senha inválidos.");
                    $this->redirect()->toRoute('login');
                }
            }
            else
            {                
                foreach ( $form->getMessages() as $errorTypes )
                {
                    foreach ( $errorTypes as $errorType => $message )
                    {
                        $this->flashMessenger()->addErrorMessage(str_replace("'", "\\'", $message));
                    }
                }
                
                $this->redirect()->toRoute('login');
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
            $login = new Login();
            $builder  = new AnnotationBuilder();
            
            $this->form = $builder->createForm($login);
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
        //$this->getSessionStorage()->forgetMe();
        $this->getServiceLocator()->get('AuthenticationService')->clearIdentity();
        
        $userSession = new Container('Login');
        unset($userSession->username);
        unset($userSession->nameuser);
        unset($userSession->iduser);
        
        $this->flashMessenger()->addInfoMessage("Você foi desconectado.");
        
        return $this->redirect()->toRoute('login');
    }
    
    /**
     * Obtém dados do login, pelo username.
     * 
     * @param String $username
     * @return array
     */
    private function findLoginByUsername($username)
    {
        $repository = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('System\Entity\Login');
        $query = $repository->createQueryBuilder('l')
                            ->select("l.id, l.username, l.name, l.email")
                            ->andWhere("l.username = :username")
                            ->setParameter('username', $username)
                            ->getQuery();
        
        $result = $query->getResult();
        
        return $result[0];
    }
}
