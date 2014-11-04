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
namespace Innerbridge\View\Helper;

use Innerbridge\View\Helper\ViewHelper;

class GridHelper extends ViewHelper
{
    public function __invoke()
    {
        $table = "<nav class='navbar navbar-default nav-grid'>
                  <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered dataTable' id='example' aria-describedby='example_info'>
                    <thead>
                        <tr role='row'>
                            <th class='sorting grid-action-header' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 163px;'><input type='checkbox' class='form-control checkbox'/></th>
                            <th class='sorting_asc' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending' style='width: 163px;'>Rendering engine</th>
                            <th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Browser: activate to sort column ascending' style='width: 237px;'>Browser</th>
                            <th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Platform(s): activate to sort column ascending' style='width: 217px;'>Platform(s)</th>
                            <th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Engine version: activate to sort column ascending' style='width: 139px;'>Engine version</th>
                            <th class='sorting' role='columnheader' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='CSS grade: activate to sort column ascending' style='width: 98px;'>CSS grade</th>
                        </tr>
                    </thead>
                    <tbody role='alert' aria-live='polite' aria-relevant='all'>
                        <tr class='gradeA odd'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Firefox 1.0</td>
                            <td class=' '>Win 98+ / OSX.2+</td>
                            <td class='center '>1.7</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Firefox 1.5</td>
                            <td class=' '>Win 98+ / OSX.2+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Bçalsdk</td>
                            <td class=' '>Win 98+ / OSX.2+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA odd'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Firefox 2.0</td>
                            <td class=' '>Win 98+ / OSX.2+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Firefox 3.0</td>
                            <td class=' '>Win 2k+ / OSX.3+</td>
                            <td class='center '>1.9</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA odd'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Camino 1.0</td>
                            <td class=' '>OSX.2+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Camino 1.5</td>
                            <td class=' '>OSX.3+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA odd'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Netscape 7.2</td>
                            <td class=' '>Win 95+ / Mac OS 8.6-9.2</td>
                            <td class='center '>1.7</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Netscape Browser 8</td>
                            <td class=' '>Win 98SE+</td>
                            <td class='center '>1.7</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA odd'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Netscape Navigator 9</td>
                            <td class=' '>Win 98+ / OSX.2+</td>
                            <td class='center '>1.8</td>
                            <td class='center '>A</td>
                        </tr>
                        <tr class='gradeA even'>
                            <td class='grid-action-row'><input type='checkbox' class='form-control checkbox'/></td>
                            <td class=' '>Gecko</td>
                            <td class=' '>Mozilla 1.0</td>
                            <td class=' '>Win 95+ / OSX.1+</td>
                            <td class='center '>1</td>
                            <td class='center '>A</td>
                        </tr>
                    </tbody>
                  </table></nav>";
        
        return $table;
    }
}
