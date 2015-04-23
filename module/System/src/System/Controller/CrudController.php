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
        $warningConfirm = $this->params()->fromQuery('warningConfirm');
        
        if ( (boolean)$warningConfirm )
        {
            $this->deleteAction();
        }
        
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
        
        $queryData = $this->params()->fromQuery();
        
        if ( !empty($queryData) )
        {
            $form->setData($queryData);
        }
            
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

                $this->flashMessenger()->addSuccessMessage("Registro inserido com sucesso!");
                return $this->redirect()->toRoute($this->getCurrentRoute(), array('id' => $id));
            }
            else
            {
                $this->displayErrorMessages($form->getMessages(), array(), array('query' => $postData));
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
        
        $queryData = $this->params()->fromQuery();
        $formBind = $this->getFormBindByEntity($entity);
        
        if ( !empty($queryData) )
        {
            $formBind->setData($queryData);
        }
        
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

                $this->flashMessenger()->addSuccessMessage("Registro atualizado com sucesso!");
                return $this->redirect()->toRoute($this->getCurrentRoute());
            }
            else
            {
                $this->displayErrorMessages($form->getMessages(), $argsAction, array('query' => $postData));
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
        $warningConfirm = $this->params()->fromQuery('warningConfirm');
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);

        if ( (boolean)$warningConfirm ) 
        {
            $this->getObjectManager()->remove($entity);
            $this->getObjectManager()->flush();

            $this->flashMessenger()->addSuccessMessage("Registro removido com sucesso!");
        }
        else
        {
            $this->flashMessenger()->addWarningMessage("Você têm certeza de que deseja remover este registro?");
        }
        
        $this->redirect()->toRoute($this->getCurrentRoute(), array('id' => $id));
    }
    
    /**
     * Interface de manutenção de arquivos e anexos.
     * 
     * @return type
     */
    public function attachmentsAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $entityExp = explode("\\", $this->getCurrentEntity());
        
        $attachment = $this->params()->fromQuery('attachment');
        $warningConfirm = $this->params()->fromQuery('warningConfirm');
        
        // Para remoção de anexos.
        if ( (boolean)$warningConfirm && strlen($attachment) > 0 )
        {
            $this->removeattachmentAction();
        }
        
        $argsAction = array(
            'id' => $id,
            'entity' => $entityExp[count($entityExp) -1],
            'caption' => $this->getCurrentCaption()
        );
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel($argsAction), $this->getCurrentAction());
        return $viewModel;
    }
    
    /**
     * Remove um anexo do servidor.
     */
    public function removeattachmentAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0); // id proprietário do anexo.
        $attachment = $this->params()->fromQuery('attachment');  // From GET
        $warningConfirm = $this->params()->fromQuery('warningConfirm'); // Verificação de confirmação da remoção.
        
        if ( (boolean)$warningConfirm && strlen($attachment) > 0 )
        {
            $filePath = dirname(__DIR__) . "/../../../../public/uploads/entities/" . strtolower($this->getCurrentRoute()) . "/" . $id . "/" . $attachment;
            
            if ( file_exists($filePath) )
            {
                unlink($filePath);
                $this->flashMessenger()->addSuccessMessage("Anexo removido com sucesso!");
            }
            else
            {
                $this->flashMessenger()->addErrorMessage("Ocorreram alguns problemas ao tentar remover o anexo!");
            }
        }
        else
        {
            $this->flashMessenger()->addWarningMessage("Você têm certeza de que deseja remover o anexo \"{$attachment}\"?");
        }
        
        $args = array(
            'action' => 'attachments',
            'id' => $id,
            'attachment' => $attachment
        );
        $this->redirect()->toRoute($this->getCurrentRoute(), $args);
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
}

?>
