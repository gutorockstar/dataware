<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author augusto
 */

namespace Manager\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="manager.product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="product_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Nome"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O valor para 'Nome' é requerido.");
     */
    protected $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     */
    protected  $category;
    
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

    public function getCategory() 
    {
        return $this->category;
    }

    public function setCategory($category) 
    {
        $this->category = $category;
    }
}

?>
