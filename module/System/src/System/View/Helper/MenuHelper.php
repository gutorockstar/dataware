<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonMenuView
 *
 * @author augusto
 */

namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use Zend\Session\Container;
use Zend\View\Helper\BasePath;

class MenuHelper extends ViewHelper
{    
    public function __invoke()
    {        
        $userSession = new Container('Login');
        $username = $userSession->username;
        $nameUser = $userSession->nameuser;
        $idUser = $userSession->iduser;
        
        if ( strlen($username) > 0 )
        {            
            $menu .= "<nav class='menu' role='navigation'>
                          <div class='container'>
                              <div class='collapse navbar-collapse'>
                                  <a href='/manager' title='Home' class='loading'>
                                      <div class='home'>
                                          <i class='img-home fa fa-home fa-3x'></i>
                                      </div>
                                  </a>
                                  
                                  {$this->getModules()}
                                  
                                  <ul class='nav navbar-nav' style='float: right'>
                                      <li class='dropdown'>
                                          <a href='' class='dropdown-toggle' data-toggle='dropdown'>
                                              {$nameUser}&nbsp;&nbsp;<i class='fa fa-user'></i>
                                              <b class='caret'></b>
                                          </a>
                                          <ul class='dropdown-menu'>
                                              <li>
                                                  <a class='loading' href='/manager/user/edit/{$idUser}'>Editar perfil</a>
                                              </li>
                                              <li>
                                                  <a href='javascript:void(0)' onclick='javascript:logoutMessage()'>
                                                      Efetuar logout&nbsp;&nbsp;<i class='img-logout fa fa-power-off'></i>
                                                  </a>
                                              </li>
                                          </ul>
                                      </li>
                                  </ul>
                                  
                              </div>
                          </div>
                      </nav>";
               
        }
        
        return $menu;
    }
    
    /**
     * Retorna os módulos para popular o menu conforme permições do usuário.
     * 
     * @return string html
     */
    private function getModules()
    {
        $modulesArray = array(
            "Principal" => array(
                "Banner" => '/manager/banner',
            ),
            "Produtos" => array(
                "Categorias" => '/manager/category',
                "Marcas" => '/manager/brand',
                "Produtos" => '/manager/product'
            ),
            "Sobre nós" => array(
                "Empresa, Missão e Visão" => '/manager/companymissionview'
            ),
            "Configurações" => array(
                "Usuários" => '/manager/user'
            )
        );
        
        return $this->getOptionsMenu($modulesArray);
    }
    
    /**
     * Monta as opções do menu.
     * 
     * @param type $options
     * @return type
     */
    public function getOptionsMenu($options, $dropDown = false)
    {
        $ulClass = $dropDown ? 'dropdown-menu' : 'nav navbar-nav';
        $optionsMenu .= "<ul class='{$ulClass}'>";
        
        foreach ( $options as $name => $action )
        {
            if ( is_array($action) )
            {
                $optionsMenu .= "<li class='dropdown'>
                                    <a href='' class='dropdown-toggle' data-toggle='dropdown'>{$name}<b class='caret'></b></a>";
                $optionsMenu .= $this->getOptionsMenu($action, true);
                $optionsMenu .= "</li>";
            }
            else
            {
                $optionsMenu .= "<li><a class='loading' href='{$action}'>{$name}</a></li>";
            }
        }
        
        $optionsMenu .= "</ul>";
        
        return $optionsMenu;
    }
}

?>
