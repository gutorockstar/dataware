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
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Form;
use Zend\Form\Element\Select;

class CrudController extends Controller
{
    /**
     * Ajusta os elementos especiais do formulário,
     * como por exemplo os campos de tipo select, que
     * deverão listar todos os registros de uma entidade
     * por padrão.
     * 
     * @param \Zend\Form\Form $form
     */
    private function adjustOfSpecialElements(Form $form)
    {
        foreach ( $form->getElements() as $element )
        {
            if ( $element instanceof Select && !is_null($element->getOption('entity')) )
            {
                // Obtém os registros de listagens padrões, a partir da entidade definida para o campo.
                $results = $this->getListValuesToSelectElement($element);
                $listValues = array(null => null);
        
                foreach ( $results as $result )
                {
                    $listValues[$result['id']] = $result['title'];
                }
                
                $form->get($element->getAttribute('name'))->setValueOptions($listValues);
            }
        }
    }
            
    /**
     * Retorna todos os registros para serem populados em campos de tipo select,
     * conforme registros padrões 'id' e 'title'.
     * 
     * @param Select $element
     * @return array
     */
    public function getListValuesToSelectElement(Select $element)
    {
        $entity = $element->getOption('entity');
        
        $repository = $this->getObjectManager()->getRepository($entity);
        $query = $repository->createQueryBuilder('list')
                            ->select("list.id, list.title")
                            ->orderBy("list.title")
                            ->getQuery();        
        
        return $query->getResult();
    }
    
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
        $entityClass = $this->getCurrentEntity();        
        $entity = new $entityClass();
            
        if ( $this->request->isPost() ) 
        {
            $this->populateEntity($entity);

            $this->getObjectManager()->persist($entity);
            $this->getObjectManager()->flush();
            $id = $entity->getId();

            return $this->redirect()->toRoute($this->getCurrentRoute(), array('id' => $id));
        }
        
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
        $this->adjustOfSpecialElements($form);
        
        return array('form' => $form);
    }
    
    /**
     * Ação padrão para edição de registros.
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $entityClass = $this->getCurrentEntity();
        $entity = $this->getObjectManager()->find($entityClass, $id);

        if ( $this->request->isPost() ) 
        {
            $this->populateEntity($entity);

            $this->getObjectManager()->persist($entity);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute($this->getCurrentRoute());
        }
        
        $builder  = new AnnotationBuilder();    
        $form = $builder->createForm($entity);
        $this->adjustOfSpecialElements($form);
        
        $form->setHydrator(new DoctrineHydrator($this->getObjectManager(), $entityClass));
        $form->bind($entity);

        return array('form' => $form);
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
