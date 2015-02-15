<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridColumn
 *
 * @author augusto
 */
namespace Admin\Entity;

class GridColumn 
{
    /**
     * Código de referência da coluna.
     * 
     * @var String
     */
    private $id;
    
    /**
     * Título da coluna.
     * 
     * @var String
     */
    private $title;
    
    /**
     * Classe css.
     * 
     * @var String
     */
    private $class;
    
    /**
     * Especifica a ordem de tabulação do elemento 
     * (quando a tecla "tab" é usada para navegação).
     * 
     * @var integer
     */
    private $tabIndex;
    
    /**
     * Define ou recupera a lista de elementos que são 
     * controlados pelo elemento atual.
     * 
     * @var String
     */
    private $ariaControls;
    
    /**
     * Especifica o número de linhas que uma célula 
     * deve se espalhar.
     * 
     * @var integer
     */
    private $rowSpan = 1;
    
    /**
     * Especifica o número de colunas que uma célula
     * deve se espalhar.
     * 
     * @var integer
     */
    private $colSpan = 1;
    
    /**
     * Indica se os itens em uma tabela ou grid são classificadas 
     * em ordem crescente ou decrescente.
     * Possiveis valores: ascending, descending, none, other
     * 
     * @var String
     */
    private $ariaSort;
    
    /**
     * String de rótulo (hint) da coluna.
     * 
     * @var String
     */
    private $ariaLabel;
    
    /**
     * Seta estilo costumizado para a coluna.
     * 
     * @var String
     */
    private $style;
    
    /**
     * Método contrutor
     * 
     * @param String $title
     * @param String $ariaLabel (rótulo)
     */
    public function __construct($id, $title, $ariaLabel) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->ariaLabel = $ariaLabel;
        $this->class = "sorting";
        $this->tabIndex = 0;
        $this->ariaControls = "example";
        $this->rowSpan = 1;
        $this->colSpan = 1;
        $this->ariaSort = "ascending";
        $this->style = "width: auto;";
    }
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }
        
    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getClass() 
    {
        return $this->class;
    }

    public function setClass($class) 
    {
        $this->class = $class;
    }

    public function getTabIndex() 
    {
        return $this->tabIndex;
    }

    public function setTabIndex($tabIndex) 
    {
        $this->tabIndex = $tabIndex;
    }

    public function getAriaControls() 
    {
        return $this->ariaControls;
    }

    public function setAriaControls($ariaControls) 
    {
        $this->ariaControls = $ariaControls;
    }

    public function getRowSpan() 
    {
        return $this->rowSpan;
    }

    public function setRowSpan($rowSpan) 
    {
        $this->rowSpan = $rowSpan;
    }

    public function getColSpan() 
    {
        return $this->colSpan;
    }

    public function setColSpan($colSpan) 
    {
        $this->colSpan = $colSpan;
    }

    public function getAriaSort() 
    {
        return $this->ariaSort;
    }

    public function setAriaSort($ariaSort) 
    {
        $this->ariaSort = $ariaSort;
    }

    public function getAriaLabel() 
    {
        return $this->ariaLabel;
    }

    public function setAriaLabel($ariaLabel) 
    {
        $this->ariaLabel = $ariaLabel;
    }

    public function getStyle() 
    {
        return $this->style;
    }

    public function setStyle($style) 
    {
        $this->style = $style;
    }
}

?>
