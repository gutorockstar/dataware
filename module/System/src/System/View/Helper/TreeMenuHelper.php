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
        $content = "<ul class='treeview'>
                        <li> item 1
                          <ul>
                            <li>subitem 1</li>
                            <li>subitem 2</li>
                          </ul>
                        </li>
                        <li>Foo Item</li>
                        <li> Countries
                          <ul>
                            <li>United States
                              <ul>
                                <li>New York</li>
                                <li>San Francisco</li>
                                <li>Chicago</li>
                                <li>Los Angeles</li>
                              </ul>
                            </li>
                            <li>United Kingdom</li>
                            <li>China</li>
                            <li>India
                              <ul>
                                <li>New Delhi</li>
                                <li>Mumbai</li>
                                <li>Chennai</li>
                                <li>Kolkata</li>
                              </ul>
                            </li>
                            <li>Russia</li>
                            <li>France</li>
                            <li>Germany</li>
                          </ul>
                        </li>
                    </ul>
                    
                    <script>
                        $('.treeview').treeView();
                    </script>";
        
        return $content;
    }
}

?>
