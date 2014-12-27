<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adm_User
 *
 * @author augusto
 */

namespace Basic\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class State
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="state_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     */
    protected $id;
        
    /**
     * @ORM\ManyToOne(targetEntity="Country", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     */
    protected  $country;
    
    /**
     * @ORM\Column(type="string", length=2, columnDefinition="CHAR(2) NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"UF"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":2, "max":2}})
     * @Annotation\ErrorMessage("O valor para 'UF' é requerido.");
     */
    protected $uf;
    
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
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getCountry() 
    {
        return $this->country;
    }

    public function setCountry($country) 
    {
        $this->country = $country;
    }

    public function getUf() 
    {
        return $this->uf;
    }

    public function setUf($uf) 
    {
        $this->uf = $uf;
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
