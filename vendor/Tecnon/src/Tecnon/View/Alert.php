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

namespace Tecnon\View;

use Tecnon\View\ViewHelper,
    \Zend\Mvc\Controller\Plugin\FlashMessenger;

class Alert extends ViewHelper
{
    /**
     * Título do alert de Aviso.
     */
    const HEADER_INFO = 'Aviso!';
    
    /**
     * Título do alert de Aviso.
     */
    const HEADER_SUCCESS = 'Sucesso!';
    
    /**
     * Título do alert de Aviso.
     */
    const HEADER_ERROR = 'Erro!';
    
    /**
     * Verifica o alert que deve ser exibido na tela, caso tenha sido chamado.
     * 
     * @param String $namespace
     * @return String html
     */
    public function __invoke($namespace = null)
    {        
        $FlashMessenger = $this->view->flashMessenger();        
        
        $infoMessages    = $FlashMessenger->getInfoMessages();
        $successMessages = $FlashMessenger->getSuccessMessages();
        $errorMessages   = $FlashMessenger->getErrorMessages();
        
        if ( count($infoMessages) > 0 )
        {
            $alert = $this->infoMessage($infoMessages);
        }
        else if ( count($successMessages) > 0 )
        {
            $alert = $this->successMessage($successMessages);
        }
        else if ( count($errorMessages) > 0 )
        {
            $alert = $this->errorMessage($errorMessages);
        }
        
        echo ($alert) ? $alert : null;
    }
    
    /**
     * Retorna alert de Aviso.
     * 
     * @param array $messages
     * @return String html
     */
    private function infoMessage($messages)
    {
        foreach($messages as $message)
        {
            $content .= "<p>{$message}</p>";
        }
        
        return $this->popupAlert(FlashMessenger::NAMESPACE_INFO, self::HEADER_INFO, $content);
    }
    
    /**
     * Retorna alert de Sucesso.
     * 
     * @param array $messages
     * @return String html
     */
    private function successMessage($messages)
    {
        foreach($messages as $message)
        {
            $content .= "<p>{$message}</p>";
        }
        
        return $this->popupAlert(FlashMessenger::NAMESPACE_SUCCESS, self::HEADER_SUCCESS, $content);
    }
    
    /**
     * Retorna alert de Erro.
     * 
     * @param array $messages
     * @return String html
     */
    private function errorMessage($messages)
    {
        foreach($messages as $message)
        {
            $content .= "<p>{$message}</p>";
        }
        
        return $this->popupAlert('danger', self::HEADER_ERROR, $content);
    }
    
    /**
     * Retorna alert html.
     * 
     * @param String $namespace
     * @param String $header
     * @param String $content
     * @return String html
     */
    private function popupAlert($namespace, $header, $content)
    {
        return "<div id='obscure'>
                    <div id='popup_box'>
                        <div class='alertPanel panel panel-{$namespace}'>
                            <div class='panel-heading'>
                                <div class='heading'>{$header}</div>
                            </div>
                        <div class='panel-body'>
                            {$content}
                            <input type='submit' name='submit' id='popupBoxClose' class='btn btn-default' value='ok'>
                        </div>
                      </div>
                    </div>
                </div>
                <script>ALERT=true;</script>";
    }
}

?>
