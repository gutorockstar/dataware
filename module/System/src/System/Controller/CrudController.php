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
        $argsAction = array(
            'entity' => $this->getCurrentEntity(),
            'caption' => $this->getCurrentCaption(),
            'dataGrid' => $dataGrid
        );
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel($argsAction), 'index');
        
        return $viewModel;
    }
    
    /**
     * Ação padrão para adicionar novos registros.
     */
    public function addAction()
    {
        $request = $this->getRequest();
        $caption = $this->getCurrentCaption();
        
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
            else
            {
                $this->displayErrorMessages($form->getMessages(), array('form' => $form, 'caption' => $caption));
            }
        }
        
        $this->adjustOfSpecialElements($form);
        $viewModel = $this->defineViewModelTemplate(new ViewModel(array('form' => $form, 'caption' => $caption)), $this->getCurrentAction());
        return $viewModel;
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
        
        $formBind = $this->getFormBindByEntity($entity);
        $argsAction = array(
            'id' => $id,
            'form' => $formBind,
            'caption' => $this->getCurrentCaption()
        );

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
                $argsAction['form'] = $form;
                
                $this->displayErrorMessages($form->getMessages(), $argsAction);
            }
        }
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel($argsAction), $this->getCurrentAction());        
        return $viewModel;
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
        
        $this->flashMessenger()->addWarningMessage("Você têm certeza de que deseja excluir este registro?");
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel(), $this->getCurrentAction());        
        return $viewModel;
    }
    
    /**
     * Manutenção de arquivos e anexos.
     * 
     * @return type
     */
    public function attachmentsAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $argsAction = array(
            'id' => $id,
            'caption' => $this->getCurrentCaption()
        );
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel($argsAction), $this->getCurrentAction());
        return $viewModel;
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
