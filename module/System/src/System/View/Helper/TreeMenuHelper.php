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
        $content = "<div class='tree-menu'>
                    </div>
                    
                    <script>
                    var data = [
                        {
                            label: 'node1',
                            children: [
                                { label: 'child1' },
                                { label: 'child2' }
                            ]
                        },
                        {
                            label: 'node2',
                            children: [
                                { label: 'child3' }
                            ]
                        }
                    ];
                
                    $(function() {
                        $('.tree-menu').tree({
                            data: data
                        });
                    });
                    

                    </script>";
        
        /**
         * Alternatively, get the data from the server.
         * 
         * $.getJSON(
                '/some_url/',
                function(data) {
                    $('#tree1').tree({
                        data: data
                    });
                }
            );
         */
        
        return $content;
    }
}

?>
