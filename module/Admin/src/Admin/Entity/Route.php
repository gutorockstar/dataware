<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route
 *
 * @author augusto
 */
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="admin.route")
 */
class Route 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="route_id_seq", initialValue=1)
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Module", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id", nullable=false)
     */
    protected $module;
    
    /**
     * @ORM\ManyToOne(targetEntity="Route", cascade={"all"}, fetch="EAGER")
     */
    protected $parentroute;

    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
     */
    protected $route;

    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
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

    public function getModule() 
    {
        return $this->module;
    }

    public function setModule($module) 
    {
        $this->module = $module;
    }

    public function getParentroute() 
    {
        return $this->parentroute;
    }

    public function setParentroute($parentroute) 
    {
        $this->parentroute = $parentroute;
    }

    public function getRoute() 
    {
        return $this->route;
    }

    public function setRoute($route) 
    {
        $this->route = $route;
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
