<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteContentHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteContentHelper extends ViewHelper
{
    public function __invoke() 
    {
        $content = "<div class='content'>
                        <div class='container'>
                            {$this->view->content}
                        </div>
                    </div>";
        
        return $content;
    }
}

?>
