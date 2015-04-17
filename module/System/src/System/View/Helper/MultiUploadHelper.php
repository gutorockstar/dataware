<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MultiUploadHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\MultiUpload;

class MultiUploadHelper extends ViewHelper
{
    public function __invoke(MultiUpload $multiUpload) 
    {        
        $content = "
            <script>
                $(document).ready(function() {
                    $('#file_upload').uploadify({
                        'uploader'  : '{$this->view->basePath('uploadify/uploadify.swf')}',
                        'script'    : '{$this->view->basePath('uploadify/uploadify.php')}',
                        'cancelImg' : '{$this->view->basePath('uploadify/cancel.png')}',
                        'folder'    : '{$this->view->basePath('files/teste')}',
                        'auto'      : false, // False para não começar automaticamente, e True para começar o upload automaticamente.
                        'multi'     : true, // False para fazer upload apenas de um arquivo e True para vários arquivos.
                        'onAllComplete' : function(event,data) 
                        {
                            //refreshPage(); 
                        } 
                    });
                });
            </script>
            
            <fieldset>
                <div class='multiupload'>
                    <div class='btn-browser-multiupload'>
                        <input type='file' class='input-text btn' id='file_upload'/>
                    </div>
                    <div class='btn-save-multiupload'>
                        <a href=\"javascript:$('#file_upload').uploadifyUpload();\" >
                            <button class='btn btn-primary'>Salvar arquivos</button>
                        </a>
                    </div>
                </div>
            </fieldset>";
        
        return $content;
    }
}

?>
