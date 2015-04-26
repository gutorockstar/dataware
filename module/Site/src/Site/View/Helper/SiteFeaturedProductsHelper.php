<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteFeaturedProductsHelper
 *
 * @author augusto
 */
namespace Site\View\Helper;

use System\View\Helper\ViewHelper;

class SiteFeaturedProductsHelper extends ViewHelper
{
    public function __invoke() 
    {
        $featuredProducts = "<div class='destaques'>
                                <div class='produtos-destaque'>
                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/1/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 1
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/2/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 2
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/3/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 3
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/4/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 4
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/5/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 5
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/6/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 6
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>

                                    <div class='resumo-produto'>
                                        <div class='capa-produto'>
                                            <img src='{$this->view->basePath()}/img/site/produto/7/capa.jpg'>
                                        </div>
                                        <div class='titulo-produto'>
                                            Produto destaque 7
                                        </div>
                                        <div class='descricao-produto'>
                                            Esta descricção é um teste, 
                                            estou escrevendo qualquer coisa aqui, 
                                            para que tenha uma descrição de exemplo referente ao produto em destaque. 
                                            Poderão ser escritas diversas coisas para o produto.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <nav id='menu'>
                                <ul>
                                    <li style='background: #0075b0'>
                                        <a href='#'>
                                            Veja mais de nossos produtos&nbsp;&nbsp;
                                            <i class='fa fa-arrow-circle-o-right fa-lg'>
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>";
        
        return $featuredProducts;
    }
}

?>
