<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeMenuHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\Model\TreeMenu;

class TreeMenuHelper extends ViewHelper
{
    public function __invoke(TreeMenu $treeMenu) 
    {
        $treeMenuContent = "<ul class='treeview'>";
        
        foreach ( $treeMenu->getContent() as $content )
        {
            $treeMenuContent .= "<li>" . $content['title'];
            
            if ( count($content['subitens']) > 0 )
            {
                $treeMenuContent .= "<ul>";
                
                foreach ( $content['subitens'] as $subitem )
                {
                    $treeMenuContent .= "<li>" . $subitem['title'] . "</li>";
                }
                
                $treeMenuContent .= "</ul>";
            }
            
            $treeMenuContent .= "</li>";
        }
        
        $treeMenuContent .= "</ul>
                             <script>
                                 $('.treeview').treeView();
                             </script>";
        
        return $treeMenuContent;
    }
}

?>
