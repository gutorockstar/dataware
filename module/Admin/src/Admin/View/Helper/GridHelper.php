<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridHelper
 *
 * @author augusto
 */
namespace Admin\View\Helper;

use Admin\Entity\Grid;
use Admin\Entity\GridColumn;

class GridHelper extends ViewHelper
{
    public function __invoke(Grid $grid)
    {
        $displayGrid = "<div id='example_wrapper' class='dataTables_wrapper form-inline no-footer'>
                            <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered dataTable no-footer' id='example' role='grid' aria-describedby='example_info'>
                                <thead>
                                    <tr role='row'>";
        
        // Gera o checkbox de seleção de todos os registros da grid, se habilitado.
        if ( !$grid->getDisableSelections() )
        {
            $displayGrid .= "<th class='selection' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Com quais registros devo agir?' style='width: 30px;'>
                                <input type='checkbox' class='form-control checkbox' value='all' />
                             </th>";
        }
        
        // Gera o cabeçalho da grid, caso esitam colunas atribuidas.
        if ( count($grid->getColumns()) > 0 )
        {
            foreach ( $grid->getColumns() as $gridColumn )
            {
                $displayGrid .= $this->generateGridColumn($gridColumn);
            }
        }
        
        $displayGrid .= "</tr></thead><tbody>";
        
        // Gera o corpo da grid, contendo os registros obtidos para a listagem.
        if ( count($grid->getData()) > 0 )
        {
            $displayGrid .= $this->generateGridRows($grid);
        }
        
        $displayGrid .= "</tbody></table></div>";
        return $displayGrid;
    }
    
    /**
     * Gera o html de uma coluna para a grid.
     * 
     * @param \Admin\Entity\GridColumn $gridColumn
     * @return string
     */
    private function generateGridColumn(GridColumn $gridColumn)
    {
        return "<th class='{$gridColumn->getClass()}' 
                    tabindex='{$gridColumn->getTabIndex()}' 
                    aria-controls='{$gridColumn->getAriaControls()}' 
                    rowspan='{$gridColumn->getRowSpan()}' 
                    colspan='{$gridColumn->getColSpan()}' 
                    aria-sort='{$gridColumn->getAriaSort()}' 
                    aria-label='{$gridColumn->getAriaLabel()}' 
                    style='{$gridColumn->getStyle()}'>
                    {$gridColumn->getTitle()}
                </th>";
    }
    
    /**
     * Gera os registros que serão listados na grid.
     * 
     * @param \Admin\Entity\Grid $grid
     * @return string
     */
    private function generateGridRows(Grid $grid)
    {
        $rows = "";
        $cont = 0;
        
        foreach ( $grid->getData() as $data )
        {
            $classColor = ($cont % 2 == 0) ? 'odd' : 'even'; $cont++;
            $rows .= "<tr class='gradeA {$classColor}' role='row'>";

            // Gera o checkbox de seleção do registro.
            if ( !$grid->getDisableSelections() && strlen($data->getId()) > 0 )
            {
                $rows .= "<td><input type='checkbox' class='form-control checkbox' value='{$data->getId()}'/></td>";
            }
            
            
            // PENSAR EM UMA MANEIRA DE OBTER O TÍTULO DA COLUNA E ID, DIRETOS PELA ENTIDADE.
            
            

            // Gera os dados do registro.
            foreach ( $grid->getColumns() as $gridColumn )
            {
                $lowerColumn = strtolower($gridColumn->getId());
                $getFunction = "get" . ucfirst($lowerColumn);
                
                $rows .= "<td>{$data->$getFunction()}</td>";
            }

            $rows .= "</tr>";
        }
        
        return $rows;
    }
}

?>
