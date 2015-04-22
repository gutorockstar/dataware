<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TecnonAlertsViewl
 *
 * @author augusto
 */

namespace System\View\Helper;

use System\View\Helper\ViewHelper,
    \Zend\Mvc\Controller\Plugin\FlashMessenger;

class AlertHelper extends ViewHelper
{
    /**
     * Constantes dos headers.
     */
    const TITLE_INFO    = 'Só para constar! :)';
    const TITLE_SUCCESS = 'Tudo certo! :D';
    const TITLE_ERROR   = 'Ops! :(';
    const TITLE_WARNING   = 'Ei, atenção! :o';
    
    /**
     * Verifica o alert que deve ser exibido na tela, caso tenha sido chamado.
     * 
     * @return String html
     */
    public function __invoke()
    {       
        $this->infoMessage();
        $this->successMessage();
        $this->warningMessage();
        $this->errorMessage();
    }
    
    /**
     * Retorna alert de Aviso.
     * 
     * @param array $messages
     * @return String html
     */
    private function infoMessage()
    {
        if ( $this->view->flashMessenger()->hasInfoMessages() )
        {
            $text = "";
            
            foreach ( $this->view->flashMessenger()->getInfoMessages() as $message )
            {
                $text .= "- {$message} \\n\\r";
            }

            echo $this->showAlert(self::TITLE_INFO, $text, FlashMessenger::NAMESPACE_INFO);
        }
    }
    
    /**
     * Retorna alert de Sucesso.
     * 
     * @param array $messages
     * @return String html
     */
    private function successMessage()
    {
        if ( $this->view->flashMessenger()->hasSuccessMessages() )
        {
            $text = "";
            
            foreach ( $this->view->flashMessenger()->getSuccessMessages() as $message )
            {
                $text .= "- {$message} \\n\\r";
            }

            echo $this->showAlert(self::TITLE_SUCCESS, $text, FlashMessenger::NAMESPACE_SUCCESS);
        }
    }
    
    /**
     * Retorna alert de Aviso/escolha.
     * 
     * @param array $messages
     * @return String html
     */
    private function warningMessage()
    {
        if ( $this->view->flashMessenger()->hasWarningMessages() )
        {
            $text = "";
            
            foreach ( $this->view->flashMessenger()->getWarningMessages() as $message )
            {
                $text .= "- {$message} \\n\\r";
            }

            echo $this->showAlert(self::TITLE_WARNING, $text, FlashMessenger::NAMESPACE_WARNING);
        }
    }
    
    /**
     * Retorna alert de Erro.
     * 
     * @param array $messages
     * @return String html
     */
    private function errorMessage()
    {
        if ( $this->view->flashMessenger()->hasErrorMessages() )
        {
            $text = "";
            
            foreach ( $this->view->flashMessenger()->getErrorMessages() as $message )
            {
                $text .= "- {$message} \\n\\r";
            }

            echo $this->showAlert(self::TITLE_ERROR, $text, FlashMessenger::NAMESPACE_ERROR);
        }
    }
    
    /**
     * Retorna alert html.
     * 
     * @param String $namespace
     * @param String $header
     * @param String $text
     * @return String html
     */
    private function showAlert($title, $text, $type)
    {
        if ( $type == FlashMessenger::NAMESPACE_WARNING )
        {
            return "<div id='obscure'>
                        <script>
                            swal(
                            {
                                title: '{$title}',   
                                text: '{$text}',   
                                type: '{$type}',   
                                showCancelButton: true,   
                                confirmButtonColor: '#DD6B55',   
                                confirmButtonText: 'Sim, remover!',   
                                cancelButtonText: 'Não, cancelar!',   
                                closeOnConfirm: false,   
                                closeOnCancel: false 
                            }, 
                            function ( isConfirm )
                            {   
                                if ( isConfirm ) 
                                {     
                                    swal('" . self::TITLE_SUCCESS . "', 
                                         'Seu registro foi removido com sucesso!', 
                                         '" . FlashMessenger::NAMESPACE_SUCCESS . "');   
                                } 
                                else 
                                {     
                                    swal('Cancelado', 
                                         'Processo de remoção do registro foi cancelado!', 
                                         '" . FlashMessenger::NAMESPACE_ERROR . "');   
                                } 
                            });
                        </script>
                    </div>";
        }
        
        return "<div id='obscure'>
                    <script>
                        sweetAlert('{$title}', '{$text}', '{$type}');
                    </script>
                </div>";
    }
}

?>
