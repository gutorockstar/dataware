<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMissionViewController
 *
 * @author augusto
 */
namespace Manager\Controller;

use System\Controller\CrudController;
use Zend\View\Model\ViewModel;
use Manager\Entity\Companymissionview;
use Zend\Form\Annotation\AnnotationBuilder;

class CompanymissionviewController extends CrudController
{
    public function indexAction() 
    {
        $request = $this->getRequest();
        $companyMissionView = $this->getObjectManager()->find('Manager\Entity\Companymissionview', 1);
        
        if ( is_null($companyMissionView) )
        {
            $companyMissionView = new Companymissionview();
        }
        
        $form = $this->getFormBindByEntity($companyMissionView);
        
        $argsAction = array(
            'form' => $form,
            'caption' => $this->getCurrentCaption()
        );
        
        if ( $request->isPost() ) 
        {
            $postData = $request->getPost();
            $form->setData($postData);
            
            $this->populateEntityToPersist($companyMissionView, $postData);
            $this->getObjectManager()->persist($companyMissionView);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute($this->getCurrentRoute());
        }
        
        $viewModel = $this->defineViewModelTemplate(new ViewModel($argsAction), $this->getCurrentAction());        
        return $viewModel;
    }
}

?>
