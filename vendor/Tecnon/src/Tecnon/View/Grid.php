<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grid
 *
 * @author augusto
 */
namespace Tecnon\View;

use Tecnon\View\ViewHelper;

class Grid extends ViewHelper
{
    public function __invoke()
    {
        $table = "<div id='example_wrapper' class='dataTables_wrapper form-inline' role='grid'>
                    <div class='row'>
                        <div class='span6'>
                            <div id='example_length' class='dataTables_length'>
                                <label>
                                    <select size='1' name='example_length' aria-controls='example'>
                                        <option value='10' selected='selected'>10</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                    </select>
                                    records per page
                                </label>
                            </div>
                        </div>
                    <div class='span6'>
                    
                    <div class='dataTables_filter' id='example_filter'>
                        <label>Search: <input type='text' aria-controls='example'></label>
                    </div> 
                  </div>
                  
                  </div>
                    <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered dataTable' id='example' aria-describedby='example_info'>
                        <thead>
                            <tr role='row'><th class='sorting_asc' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 163px;'>Rendering engine</th><th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Browser: activate to sort column ascending' style='width: 237px;'>Browser</th><th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Platform(s): activate to sort column ascending' style='width: 217px;'>Platform(s)</th><th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Engine version: activate to sort column ascending' style='width: 139px;'>Engine version</th><th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='CSS grade: activate to sort column ascending' style='width: 98px;'>CSS grade</th></tr>
                        </thead>
                        <tbody role='alert' aria-live='polite' aria-relevant='all'>
                            <tr class='gradeA odd'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Firefox 1.0</td>
                                <td class=' '>Win 98+ / OSX.2+</td>
                                <td class='center '>1.7</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA even'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Firefox 1.5</td>
                                <td class=' '>Win 98+ / OSX.2+</td>
                                <td class='center '>1.8</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA odd'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Firefox 2.0</td>
                                <td class=' '>Win 98+ / OSX.2+</td>
                                <td class='center '>1.8</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA even'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Firefox 3.0</td>
                                <td class=' '>Win 2k+ / OSX.3+</td>
                                <td class='center '>1.9</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA odd'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Camino 1.0</td>
                                <td class=' '>OSX.2+</td>
                                <td class='center '>1.8</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA even'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Camino 1.5</td>
                                <td class=' '>OSX.3+</td>
                                <td class='center '>1.8</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA odd'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Netscape 7.2</td>
                                <td class=' '>Win 95+ / Mac OS 8.6-9.2</td>
                                <td class='center '>1.7</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA even'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Netscape Browser 8</td>
                                <td class=' '>Win 98SE+</td>
                                <td class='center '>1.7</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA odd'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Netscape Navigator 9</td>
                                <td class=' '>Win 98+ / OSX.2+</td>
                                <td class='center '>1.8</td>
                                <td class='center '>A</td>
                            </tr>
                            <tr class='gradeA even'>
                                <td class=' sorting_1'>Gecko</td>
                                <td class=' '>Mozilla 1.0</td>
                                <td class=' '>Win 95+ / OSX.1+</td>
                                <td class='center '>1</td>
                                <td class='center '>A</td>
                            </tr>
                        </tbody>
                    </table>
                  <div class='row'>
                  
                  <div class='span6'>
                    <div class='dataTables_info' id='example_info'>
                        Showing 1 to 10 of 57 entries
                    </div>
                  </div>
                  
                  <div class='span6'>
                    <div class='dataTables_paginate paging_bootstrap pagination'>
                        <ul>
                            <li class='prev disabled'>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>← Previous</a>
                            </li>
                            <li class='active'>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>1</a>
                            </li>
                            <li>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>2</a>
                            </li>
                            <li>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>3</a>
                            </li>
                            <li>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>4</a>
                            </li>
                            <li>
                                <a href='http://datatables.net/media/blog/bootstrap_2/#'>5</a>
                            </li>
                            <li class='next'><a href='http://datatables.net/media/blog/bootstrap_2/#'>Next → </a>
                            </li>
                        </ul>
                    </div>
                  </div>
              </div>";
        
        return $table;
    }
}
