<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brand
 *
 * @author augusto
 */
namespace Manager\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;


/** 
 * @ORM\Entity
 * @ORM\Table(name="manager.brand")
 */
class Brand 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="brand_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"ID"})
     * @Annotation\Attributes({"class":"input-numeric form-control", "readOnly":"true"})
     * @Annotation\AllowEmpty(true)
     */
    private $id;
    
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
    private $title;
    
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
}

?>
