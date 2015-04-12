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
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"ID"})
     * @Annotation\Attributes({"class":"input-numeric form-control", "readOnly":"true"})
     * @Annotation\AllowEmpty(true)
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Categoria", "disable_inarray_validator":true, "empty_option":null, "entity":"Manager\Entity\Category"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Categoria', é requerido!")
     */
    protected  $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="Brand", fetch="EAGER")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id", nullable=true)
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Marca", "disable_inarray_validator":true, "empty_option":0, "entity":"Manager\Entity\Brand"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected  $brand;
    
    /**
     * @ORM\Column(type="integer", columnDefinition="INT")
     * 
     * @Annotation\Type("Zend\Form\Element\Number")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Código"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $code;
    
    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Título"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Título', é requerido!")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="text", columnDefinition="TEXT")
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Descrição"})
     * @Annotation\Attributes({"class":"input-textarea form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="decimal", columnDefinition="NUMERIC(14,2)")
     * 
     * @Annotation\Type("Zend\Form\Element\Number")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Valor"})
     * @Annotation\Attributes({"class":"input-numeric form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $value;
    
    /**
     * @ORM\ManyToOne(targetEntity="System\Entity\File", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id", nullable=true)
     * 
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Imagem de capa", "entity":"System\Entity\File"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $cover;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT TRUE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Ativo", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"1"})
     */
    protected $active;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT TRUE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Disponível", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"1"})
     */
    protected $available;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT FALSE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Destaque", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"0"})
     */
    protected $featured;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getCategory() 
    {
        return $this->category;
    }

    public function setCategory($category) 
    {
        $this->category = $category;
    }

    public function getBrand() 
    {
        return $this->brand;
    }

    public function setBrand($brand) 
    {
        $this->brand = $brand;
    }

    public function getCode() 
    {
        return $this->code;
    }

    public function setCode($code) 
    {
        $this->code = $code;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function getValue() 
    {
        return $this->value;
    }

    public function setValue($value) 
    {
        $this->value = $value;
    }

    public function getCover() 
    {
        return $this->cover;
    }

    public function setCover($cover) 
    {
        $this->cover = $cover;
    }

    public function getActive() 
    {
        return $this->active;
    }

    public function setActive($active) 
    {
        $this->active = $active;
    }

    public function getAvailable() 
    {
        return $this->available;
    }

    public function setAvailable($available) 
    {
        $this->available = $available;
    }
    
    public function getFeatured() 
    {
        return $this->featured;
    }

    public function setFeatured($featured) 
    {
        $this->featured = $featured;
    }
}

?>
