<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrudController
 *
 * @author augusto
 */
namespace System\Controller;

use System\Controller\Controller;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;

class CrudController extends Controller
{    
    /**
     * Primeira ação a ser executada.
     * Por padrão, executa a ação de busca, responsável por carregar
     * a grid.
     */
    public function indexAction()
    {
        $dataGrid = $this->getObjectManager()->getRepository($this->getCurrentEntity())->findAll();

        return new ViewModel(array('dataGrid' => $dataGrid));
    }
    
    /**
     * Ação padrão para adicionar novos registros.
     */
    public function addAction()
    {
        $request = $this->getRequest();
        
        $entityClass = $this->getCurrentEntity();        
        $entity = new $entityClass();
        
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
            
        if ( $request->isPost() ) 
        {
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            
            $form->setData($postData);
            
            if ( $form->isValid() )
            {
                $this->populateEntityToPersist($entity, $postData);

                $this->getObjectManager()->persist($entity);
                $this->getObjectManager()->flush();
                $id = $entity->getId();

                return $this->redirect()->toRoute($this->getCurrentRoute(), array('id' => $id));
            }
        }
        
        $this->adjustOfSpecialElements($form);
        return array('form' => $form);
    }
    
    /**
     * Ação padrão para edição de registros.
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $request = $this->getRequest();
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);
        
        $objEntity = new $entityClass();
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($objEntity);

        if ( $request->isPost() ) 
        {
            $postData = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            
            $form->setData($postData);
            
            if ( $form->isValid() )
            {
                $this->populateEntityToPersist($entity, $postData);
                
                $this->getObjectManager()->persist($entity);
                $this->getObjectManager()->flush();

                return $this->redirect()->toRoute($this->getCurrentRoute());
            }
            else
            {
                $this->adjustOfSpecialElements($form);
                return array('form' => $form);
            }
        }
        
        $formBind = $this->getFormBindByEntity($entity);
        return array('form' => $formBind);
    }
    
    /**
     * Ação padrão de exclusão de registros.
     * 
     * 
     *   PENSAR EM FAZER AS VIEWS PADRÕES .phtml !!!!!!!!
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);

        if ( $this->request->isPost() ) 
        {
            $this->getObjectManager()->remove($entity);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute($this->getCurrentRoute());
        }
        
        return array('entity' => $entity);
    }
    
    /**
     * Ação padrão de visualização de registros.
     */
    public function viewAction()
    {
    }
    
    /**
     * Ação padrão de impressão de registros.
     */
    public function printAction()
    {   
    }
    
    /**
     * Ação padrão para voltar.
     */
    public function backAction()
    {
    }
}

?>
