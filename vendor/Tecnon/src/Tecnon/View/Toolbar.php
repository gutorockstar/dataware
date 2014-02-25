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

class Toolbar extends ViewHelper
{    
    public function __invoke()
    {
        $userSession = new Container('user');
        $username    = $userSession->username;
        $baseUri     = $this->getBaseUri();
        
        $toolbar = "<div class='toolbar'>";
        
        if ( strlen($username) > 0 )
        {
            $toolbar .= "<div class='tools'>
                            <a href='{$baseUri}/new' title='Novo registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/new.png' />
                                </div>
                            </a>
                            
                            <a href='{$baseUri}/save' title='Salvar o registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/save.png' />
                                </div>
                            </a>
                            
                            <a href='{$baseUri}/delete' title='Excluir o registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/delete.png' />
                                </div>
                            </a>
                            
                            <a href='{$baseUri}/search' title='Procurar registros'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/search.png' />
                                </div>
                            </a>
                            
                            <a href='{$baseUri}/print' title='Imprimir os dados do registro'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/print.png' />
                                </div>
                            </a>
                            
                            <a href='{$baseUri}' title='Voltar para página anterior'>
                                <div class='tool'>
                                    <img class='img-toolbar' src='/img/toolbar/back.png' />
                                </div>
                            </a>
                        </div>";
        }
        
        return $toolbar . "</div>";
    }
    
    /**
     * Retorna a url base da tela.
     * 
     * @return String
     */
    private function getBaseUri()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        unset($uri[count($uri) - 1]);
        
        $baseUri = implode('/', $uri);
        
        return $baseUri;
    }
}
