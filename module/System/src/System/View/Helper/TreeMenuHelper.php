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
            $title = $content['title'];
            
            if ( !is_null($content['href']) )
            {
                $title = "<a href='{$content['href']}'>$title</a>";
            }
            
            $treeMenuContent .= "<li>{$title}";
            
            if ( count($content['subitens']) > 0 )
            {
                $treeMenuContent .= "<ul>";
                
                foreach ( $content['subitens'] as $subitem )
                {
                    $subtitle = $subitem['title'];
                    
                    if ( !is_null($subitem['href']) )
                    {
                        $subtitle = "<a href='{$subitem['href']}'>$subtitle</a>";
                    }
                    
                    $treeMenuContent .= "<li>{$subtitle}</li>";
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
