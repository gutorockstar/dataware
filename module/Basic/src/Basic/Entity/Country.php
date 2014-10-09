<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Country
 *
 * @author augusto
 */
namespace Basic\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class Country 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", columnDefinition="INTEGER NOT NULL")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="country_idcountry_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $idcountry;
    
    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(45) NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Nome"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O valor para 'Nome' é requerido.");
     */
    protected $name;
    
    public function getIdcountry() 
    {
        return $this->idcountry;
    }

    public function setIdcountry($idcountry) 
    {
        $this->idcountry = $idcountry;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }


}

?>
