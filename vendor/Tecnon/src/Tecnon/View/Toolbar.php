<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toolbar
 *
 * @author augusto
 */
namespace Tecnon\View;

use Tecnon\View\ViewHelper;
use Zend\Session\Container;
use Zend\View\Helper\BasePath;

class Toolbar extends ViewHelper
{    
    public function __invoke()
    {
        $userSession = new Container('user');
        $username    = $userSession->username;
        
        $toolbar = "<div class='toolbar'>";
        
        if ( strlen($username) > 0 )
        {
            $toolbar .= "<div class='tools'>
                            <a href='' title='Novo registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/new.png' />
                                </div>
                            </a>
                            
                            <a href='' title='Salvar o registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/save.png' />
                                </div>
                            </a>
                            
                            <a href='' title='Excluir o registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/delete.png' />
                                </div>
                            </a>
                            
                            <a href='' title='Procurar registros'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/search.png' />
                                </div>
                            </a>
                            
                            <a href='' title='Imprimir os dados do registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/print.png' />
                                </div>
                            </a>
                            
                            <a href='' title='Voltar para página anterior'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='img/toolbar/back.png' />
                                </div>
                            </a>
                        </div>";
        }
        
        return $toolbar . "</div>";
    }
}
