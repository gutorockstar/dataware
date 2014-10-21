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
     * @ORM\SequenceGenerator(sequenceName="state_idstate_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $idstate;
    
    /**
     * @ORM\Column(type="integer", columnDefinition="INTEGER NOT NULL")
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"País"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O valor para 'País' é requerido.");
     */
    protected $idcountry;
    
    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="idcountry", referencedColumnName="idcountry")
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected  $country;
    
    /**
     * @ORM\Column(type="string", columnDefinition="CHAR(2) NOT NULL")
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
    
    public function getId()
    {
        return $this->idstate;
    }
    
    public function getIdstate() 
    {
        return $this->idstate;
    }

    public function setIdstate($idstate) 
    {
        $this->idstate = $idstate;
    }

    public function getIdcountry() 
    {
        return $this->idcountry;
    }

    public function setIdcountry($idcountry) 
    {
        $this->idcountry = $idcountry;
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
