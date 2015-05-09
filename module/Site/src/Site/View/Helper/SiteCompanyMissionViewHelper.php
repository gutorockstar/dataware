<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteCompanyMissionViewHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteCompanyMissionViewHelper extends ViewHelper
{
    public function __invoke() 
    {
        $content = "";
        $companyMissionView = $this->getCompanyMissionView();
        
        if ( !is_null($companyMissionView) )
        {
            if ( $companyMissionView->getActivecompany() )
            {
                $content .= "<div><h3>Empresa</h3>
                             
                                 {$companyMissionView->getCompany()}
                             </div><br><br>";
            }
            
            if ( $companyMissionView->getActivemission() )
            {
                $content .= "<div><h3>Missão</h3>
                             
                                 {$companyMissionView->getMission()}
                             </div><br><br>";
            }
            
            if ( $companyMissionView->getActiveview() )
            {
                $content .= "<div><h3>Visão</h3>
                             
                                 {$companyMissionView->getView()}
                             </div><br><br>";
            }
        }
        
        return $content;
    }
    
    public function getCompanyMissionView()
    {
        return $this->getEntityManager()->find('Manager\Entity\Companymissionview', 1);
    }
}

?>
