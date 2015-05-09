<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteFooterHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteFooterHelper extends ViewHelper
{
    public function __invoke() 
    {
        $applicationConfig = $this->getView()->getHelperPluginManager()->getServiceLocator()->get('config');
        
        $footer = "<div class='footer'>
                       <div class='footer-content'>
                           <div class='footer-data-company'>
                               <b>EMPRESA</b>
                               <p>
                                   {$applicationConfig['site_company_name']}<br>
                                   {$applicationConfig['site_company_contact_email']}<br>
                                   {$applicationConfig['site_company_phone']}
                               </p>
                               
                               <b>ENDEREÇO</b>
                               <p>
                                   {$applicationConfig['site_company_address']} - {$applicationConfig['site_company_number']}<br>
                                   {$applicationConfig['site_company_city']} - {$applicationConfig['site_company_state']}, {$applicationConfig['site_company_neighborhood']}<br>
                                   CEP: {$applicationConfig['site_company_zipcode']}
                               </p>
                               
                           </div>
                       
                           <div class='footer-site-map'>
                               <b>MAPA DO SITE</b>
                               <div class='map'>
                                   {$this->view->SiteMenuHelper()}
                               </div>
                           </div>
                           
                           <div class='footer-data-employees'>
                               <b>DESENVOLVIDO POR</b>
                           </div>
                       </div>
                   </div>";
        
        return $footer;
    }
}

?>
