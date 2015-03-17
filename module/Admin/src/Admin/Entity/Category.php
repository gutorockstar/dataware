<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author augusto
 */
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;


/** 
 * @ORM\Entity
 * @ORM\Table(name="admin.category")
 */
class Category 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="country_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Código"})
     * @Annotation\Attributes({"class":"input-numeric form-control", "readOnly":"true"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Título"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O valor para 'Nome' é requerido.")
     */
    protected $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="categoryfather_id", referencedColumnName="id", nullable=true)
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Categoria pai", "entity":"Admin\Entity\Category"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     */
    protected  $categoryfather;
    
    /**
     * @ORM\Column(type="string", length=255, columnDefinition="VARCHAR(255)")
     * 
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Imagem de capa"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     */
    protected $cover;
    
    /**
     * @ORM\Column(type="text", columnDefinition="TEXT")
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Descrição"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     */
    protected $description;
    
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
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Salvar", "class":"input-submit btn btn-primary"})
     */
    protected $save;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getCategoryfather() 
    {
        return $this->categoryfather;
    }

    public function setCategoryfather($categoryfather) 
    {
        $this->categoryfather = $categoryfather;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getCover() 
    {
        return $this->cover;
    }

    public function setCover($cover) 
    {
        $this->cover = $cover;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    public function getActive() 
    {
        return $this->active;
    }

    public function setActive($active) 
    {
        $this->active = $active;
    }
}

?>
