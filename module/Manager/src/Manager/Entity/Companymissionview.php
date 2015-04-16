<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMissionView
 *
 * @author augusto
 */
namespace Manager\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="manager.companymissionview")
 */
class Companymissionview 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="companymissionview_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text", columnDefinition="TEXT")
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Sobre a empresa"})
     * @Annotation\Attributes({"class":"input-textarea form-control"})
     * @Annotation\AllowEmpty(true)
     */
    private $company;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT FALSE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Ativo", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"0"})
     */
    private $activecompany;
    
    /**
     * @ORM\Column(type="text", columnDefinition="TEXT")
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Missão da empresa"})
     * @Annotation\Attributes({"class":"input-textarea form-control"})
     * @Annotation\AllowEmpty(true)
     */
    private $mission;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT FALSE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Ativo", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"0"})
     */
    private $activemission;
    
    /**
     * @ORM\Column(type="text", columnDefinition="TEXT")
     * 
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Visão da empresa"})
     * @Annotation\Attributes({"class":"input-textarea form-control"})
     * @Annotation\AllowEmpty(true)
     */
    private $view;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT FALSE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Ativo", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"0"})
     */
    private $activeview;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getCompany() 
    {
        return $this->company;
    }

    public function setCompany($company) 
    {
        $this->company = $company;
    }

    public function getActivecompany() 
    {
        return $this->activecompany;
    }

    public function setActivecompany($activecompany) 
    {
        $this->activecompany = $activecompany;
    }

    public function getMission() 
    {
        return $this->mission;
    }

    public function setMission($mission) 
    {
        $this->mission = $mission;
    }

    public function getActivemission() 
    {
        return $this->activemission;
    }

    public function setActivemission($activemission) 
    {
        $this->activemission = $activemission;
    }

    public function getView() 
    {
        return $this->view;
    }

    public function setView($view) 
    {
        $this->view = $view;
    }

    public function getActiveview() 
    {
        return $this->activeview;
    }

    public function setActiveview($activeview) 
    {
        $this->activeview = $activeview;
    }
}

?>
