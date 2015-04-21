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
namespace System\View\Helper;

use System\Model\Grid;
use System\Model\GridColumn;
use System\Model\GridAction;
use Zend\Form\Annotation\AnnotationBuilder;

class GridHelper extends ViewHelper
{
    public function __invoke(Grid $grid)
    {
        $displayGrid = $grid->getGenerateFieldset() ? "<fieldset>" : "";
        $displayGrid .= "<div id='example_wrapper' class='dataTables_wrapper form-inline no-footer'>
                             <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered dataTable no-footer' id='example' role='grid' aria-describedby='example_info'>
                                 <thead>
                                     <tr role='row'>";
        
        // Cria as colunas da grid, baseadas nos atributos da entidade.
        $this->makeGridColumnsByEntity($grid);
        
        // Gera o cabeçalho da grid, caso esitam colunas atribuidas.
        $displayGrid .= $this->generateGridColumns($grid);
        $displayGrid .= "            </tr>
                                 </thead>
                                 <tbody>";
        
        // Gera o corpo da grid, contendo os registros obtidos para a listagem.
        $displayGrid .= $this->generateGridRows($grid);
        $displayGrid .= "        </tbody>
                             </table>
                            </div>";
        $displayGrid .= $grid->getGenerateFieldset() ? "</fieldset>" : "";
        
        return $displayGrid;
    }
    
    /**
     * Primerio oter todos os atributos da classe de forma automática;
     * Depois, obter todos atributos que possuem annotações que serão utilizadas;
     * Estes atributos serão gerados na grid. 
     * 
     * @param \System\Model\Grid $grid
     */
    private function makeGridColumnsByEntity(Grid $grid)
    {
        if ( strlen($grid->getEntity()) > 0 )
        {
            $annotationBuilder = new AnnotationBuilder();
            $formEspecification = $annotationBuilder->getFormSpecification($grid->getEntity());

            foreach ( $formEspecification['elements'] as $element )
            {
                if ( strlen($element['spec']['options']['label']) > 0 )
                {
                    // É possível a partir do tipo, conseguir descobrir o alinhamento dos registros.
                    $gridColumn = new GridColumn($element['spec']['name'], $element['spec']['options']['label']);
                    $grid->addColumn($gridColumn);
                }
            }
        }
    }
    
    /**
     * Gera o cabeçalho da grid.
     * 
     * @param \System\Model\Grid $grid
     * @return string html
     */
    private function generateGridColumns(Grid $grid)
    {
        $headerGrid = "";
        
        if ( count($grid->getColumns()) > 0 )
        {
            foreach ( $grid->getColumns() as $gridColumn )
            {
                $headerGrid .= $this->generateGridColumn($gridColumn);
            }
        }      
        
        // Gera a coluna de ações dos registros na grid.
        $gridColumnActions = new GridColumn(GridColumn::GRID_COLUMN_ACTIONS_ID, GridColumn::GRID_COLUMN_ACTIONS_TITLE);
        $gridColumnActions->setStyle("width: 100px !important");
        $headerGrid .= $this->generateGridColumn($gridColumnActions);
        
        return $headerGrid;
    }
    
    /**
     * Gera o html de uma coluna para a grid.
     * 
     * @param \System\Model\GridColumn $gridColumn
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
                    style='{$gridColumn->getStyle()}'
                    width='{$gridColumn->getWidth()}'
                    height='{$gridColumn->getHeight()}'>
                    {$gridColumn->getTitle()}
                </th>";
    }
    
    /**
     * Gera os registros que serão listados na grid.
     * 
     * @param \System\Model\Grid $grid
     * @return string
     */
    private function generateGridRows(Grid $grid)
    {
        $rows = "";
        $cont = 0;
        
        if ( count($grid->getData()) > 0 )
        {
            foreach ( $grid->getData() as $gridData )
            {
                $classColor = ($cont % 2 == 0) ? 'odd' : 'even'; $cont++;
                $rows .= "<tr class='gradeA {$classColor}' role='row'>";                

                // Gera os dados do registro.
                foreach ( $grid->getColumns() as $gridColumn )
                {
                    if ( $grid->hasEntity() )
                    {
                        $lowerColumn = strtolower($gridColumn->getId());
                        $getFunction = "get" . ucfirst($lowerColumn);
                        $tdValue = "";

                        if ( method_exists($gridData, $getFunction) )
                        {
                            $data = $gridData->$getFunction();
                            $value = $data;

                            // Para registros relacionais.
                            $value = $this->adjustToShowRelationalEntityValue($value);

                            // Para registros booleanos.
                            $value = $this->adjustToShowBooleanValue($value);

                            $tdValue .= $value;
                        }
                    }
                    else
                    {
                        $tdValue = $gridData[$gridColumn->getId()];
                    }   
                    
                    $rows .= "<td>{$tdValue}</td>";
                }
                
                // Gera as ações padrões dos registros na grid (Editar e Excluir).
                $rows .= $this->generateGridRowActions($grid, $gridData);
                $rows .= "</tr>";
            }
        }
        
        return $rows;
    }
    
    /**
     * Verifica se o valor é um objeto relacional, e ajusta
     * os dados necessários para exibição na grid.
     * 
     * @param string $value
     */
    private function adjustToShowRelationalEntityValue($value)
    {
        if ( is_object($value) )
        {
            $value = $value->getId() . ' - ' . $value->getTitle();
        }
        
        return $value;
    }
    
    /**
     * Verifica se o valor é booleano, e ajusta
     * os dados necessários para exibição na grid.
     * 
     * @param type $value
     */
    private function adjustToShowBooleanValue($value)
    {
        if ( $value === true )
        {
            $value = "<font color='green'>" . GridColumn::GRID_VALUE_BOOLEAN_TRUE . "</font>";
        }
        else if ( $value === false )
        {
            $value = "<font color='red'>" . GridColumn::GRID_VALUE_BOOLEAN_FALSE . "</font>";
        }
        
        return $value;
    }
    
    /**
     * Cria as ações padrões para um registro da grid
     * 
     * @param obj $entity
     * @return string html
     */
    private function generateGridRowActions(Grid $grid, $gridData)
    {
        $actions = "<td>";
        $route = $this->getCurrentRoute();
        
        if ( $grid->hasEntity() && !$grid->defaultGridActionsAreHidden() )
        {   
            //$grid->addGridAction(new GridAction(GridAction::GRID_ACTION_VIEW_ID, "Visualizar", $route, array('action' => 'view', 'id' => $gridData->getId()), "fa-eye"));
            $grid->addGridAction(new GridAction(GridAction::GRID_ACTION_ATTACHMENT_ID, "Anexos", $route, array('action' => 'attachments', 'id' => $gridData->getId()), "fa-paperclip"));
            $grid->addGridAction(new GridAction(GridAction::GRID_ACTION_EDIT_ID, "Editar", $route, array('action' => 'edit', 'id' => $gridData->getId()), "fa-pencil-square-o"));
            $grid->addGridAction(new GridAction(GridAction::GRID_ACTION_DELETE_ID, "Excluir", $route, array('action' => 'delete', 'id' => $gridData->getId()), "fa-trash-o"));
        }        
        
        $actions .= $this->generateDefaultGridActions($grid);
        $actions .= $this->generateCustomGridActions($gridData);
        
        return $actions . "</td>";
    }
    
    /**
     * Gera as ações padrões da grid.
     * 
     * @param \System\Model\Grid $grid
     * @return String html
     */
    public function generateDefaultGridActions(Grid $grid)
    {
        $actions = "";
        $gridActions = $grid->getGridActions();
        
        if ( count($gridActions) > 0 )
        {
            foreach ( $gridActions as $gridAction )
            {
                $actions .= $this->view->GridActionHelper($gridAction);
            }
            
            $grid->clearActions();
        }
        
        return $actions;
    }
    
    /**
     * Gera as ações customisadas da grid.
     * 
     * @param array $gridData
     * @return String html
     */
    public function generateCustomGridActions($gridData)
    {
        $actions = "";
        
        if ( is_array($gridData) && is_array($gridData[GridColumn::GRID_COLUMN_ACTIONS_ID]) )
        {
            foreach ( $gridData[GridColumn::GRID_COLUMN_ACTIONS_ID] as $action )
            {
                $actions .= $this->view->GridActionHelper($action);
            }
        }
        
        return $actions;
    }
}

?>
