<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttachmentFilesHelper
 *
 * @author augusto
 */
namespace System\View\Helper;

use System\View\Helper\ViewHelper;
use System\Model\Attachment;
use System\Model\Grid;
use System\Model\GridColumn;
use System\Model\GridAction;

class ListAttachmentFilesHelper extends ViewHelper
{
    public function __invoke(Attachment $attachment)
    {
        $folder = "uploads/entities/" . $attachment->getEntityName() . '/' . $attachment->getEntityId();
        $filePath = dirname(__DIR__) . "/../../../../../public/" . $folder;
        $route = $this->getCurrentRoute();
        
        $grid = new Grid();
        $grid->setHasEntity(false);
        $grid->setGenerateFieldset(false);
        
        $grid->addColumn(new GridColumn('file', "Arquivo", 50));
        $grid->addColumn(new GridColumn('title', "Título"));
        $grid->addColumn(new GridColumn('type', "Tipo"));
        $grid->addColumn(new GridColumn('size', "Tamanho"));

        $gridData = array();

        if ( is_dir($filePath) )
        {
            $dir = opendir($filePath);
            
            while ( $read = readdir($dir) ) 
            {
                if ( ( $read != '.' ) && ( $read != '..' ) ) 
                {
                    $fileName = $filePath . '/' . $read;
                    $path = $this->view->basePath($folder . '/' . $read);
                    $pathInfo = pathinfo($path);
                    $mimeType = mime_content_type($fileName);
                    $fileSize = filesize($fileName);
                    
                    $gridData[] = array(
                        'file' => "<a href=\"javascript:popupImage('{$path}');\">
                                       <img src='{$path}' title='Clique para ampliar' width='50' height='50'/>
                                   </a>",
                        'title' => $pathInfo['basename'],
                        'type' => $mimeType,
                        'size' => $fileSize,
                        \System\Model\GridColumn::GRID_COLUMN_ACTIONS_ID => array(
                            new GridAction(GridAction::GRID_ACTION_DELETE_ID, "Excluir anexo", $route, array('action' => 'removeattachment', 'path' => $path), "fa-trash-o")
                        )
                    );
                }       
            }
            
            $grid->setData($gridData);
        }
        
        return $this->view->GridHelper($grid);;
    }
}

?>
