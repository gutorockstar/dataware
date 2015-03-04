<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountryController
 *
 * @author augusto
 */
namespace Admin\Controller;

use System\Controller\Controller;
use Admin\Entity\Country;
use Zend\View\Model\ViewModel;

class CountryController extends Controller
{   

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $country = $this->getObjectManager()->find('\Admin\Entity\Country', $id);

        if ( $this->request->isPost() ) 
        {
            $this->getObjectManager()->remove($country);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('country');
        }

        return new ViewModel(array('country' => $country));
    }
}

?>
