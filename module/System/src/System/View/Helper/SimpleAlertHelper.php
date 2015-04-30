<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteAlertHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\Model\Alert;

class SimpleAlertHelper extends ViewHelper
{
    public function __invoke(Alert $alert)
    {
        $buttonClose = !$alert->getShowButtonClose() ? "" : "<button type='button' class='close' data-dismiss='alert' aria-label='Fechar'>
                                                                 <span aria-hidden='true'>&times;</span>
                                                             </button>";
        
        return "<div style='margin-top: 10px' class='alert alert-{$alert->getType()} alert-dismissible' role='alert'>
                    {$buttonClose}
                    {$alert->getMessage()}
                </div>";
    }
}

?>
