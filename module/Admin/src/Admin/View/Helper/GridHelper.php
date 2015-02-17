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
use Zend\Form\Annotation\AnnotationBuilder;

class GridHelper extends ViewHelper
{
    public function __invoke(Grid $grid)
    {
        $displayGrid = "<div id='example_wrapper' class='dataTables_wrapper form-inline no-footer'>
                            <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered dataTable no-footer' id='example' role='grid' aria-describedby='example_info'>
                                <thead>
                                    <tr role='row'>";
        
        // Gera o checkbox de seleção de todos os registros da grid, se habilitado.
        $displayGrid .= $this->generateComboboxSelectionAll($grid);
        
        // Cria as colunas da grid, baseadas nos atributos da entidade.
        $this->makeGridColumnsByEntity($grid);
        
        // Gera o cabeçalho da grid, caso esitam colunas atribuidas.
        $displayGrid .= $this->generateGridColumns($grid);
        $displayGrid .= "           </tr>
                                </thead>
                                <tbody>";
        
        // Gera o corpo da grid, contendo os registros obtidos para a listagem.
        $displayGrid .= $this->generateGridRows($grid);
        $displayGrid .= "       </tbody>
                            </table>
                        </div>";
        
        return $displayGrid;
    }
    
    /**
     * Gera o html para o combobox responsável por selecionar
     * todos os registros da página, na grid.
     * 
     * @param \Admin\Entity\Grid $grid
     * @return string html
     */
    private function generateComboboxSelectionAll(Grid $grid)
    {
        $comboBoxAll = "";
        
        if ( !$grid->getDisableSelections() )
        {
            $comboBoxAll .= "<th class='selection' tabindex='0' aria-controls='example' rowspan='1' colspan='1' aria-label='Com quais registros devo agir?' style='width: 30px;'>
                                <input type='checkbox' class='form-control checkbox' value='all' />
                             </th>";
        }       
        
        return $comboBoxAll;
    }
    
    /**
     * Primerio oter todos os atributos da classe de forma automática;
     * Depois, obter todos atributos que possuem annotações que serão utilizadas;
     * Estes atributos serão gerados na grid. 
     * 
     * @param \Admin\Entity\Grid $grid
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
     * @param \Admin\Entity\Grid $grid
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
        
        return $headerGrid;
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
        
        if ( count($grid->getData()) > 0 )
        {
            foreach ( $grid->getData() as $entity )
            {
                $classColor = ($cont % 2 == 0) ? 'odd' : 'even'; $cont++;
                $rows .= "<tr class='gradeA {$classColor}' role='row'>";

                // Gera o checkbox de seleção do registro.
                if ( !$grid->getDisableSelections() && strlen($entity->getId()) > 0 )
                {
                    $rows .= "<td><input type='checkbox' class='form-control checkbox' value='{$entity->getId()}'/></td>";
                }

                // Gera os dados do registro.
                foreach ( $grid->getColumns() as $gridColumn )
                {
                    $lowerColumn = strtolower($gridColumn->getId());
                    $getFunction = "get" . ucfirst($lowerColumn);
                    $tdValue = "";

                    if ( method_exists($entity, $getFunction) )
                    {
                        $tdValue .= $entity->$getFunction();
                    }
                    
                    $rows .= "<td>{$tdValue}</td>";
                }

                $rows .= "</tr>";
            }
        }
        
        return $rows;
    }
}

?>
