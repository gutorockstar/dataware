<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserOrGroupActionOnRoute
 *
 * @author augusto
 */
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="admin.userorgroupactiononroute")
 */
class UserOrGroupActionOnRoute 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="userorgroupactiononroute_id_seq", initialValue=1)
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Action", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id", nullable=false)
     */
    protected $action;
    
    /**
     * @ORM\ManyToOne(targetEntity="Route", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id", nullable=false)
     */
    protected $route;
    
    /**
     * @ORM\ManyToOne(targetEntity="GroupUser", cascade={"all"}, fetch="EAGER")
     */
    protected $groupuser;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserAccount", cascade={"all"}, fetch="EAGER")
     */
    protected $useraccount;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getAction() 
    {
        return $this->action;
    }

    public function setAction($action) 
    {
        $this->action = $action;
    }

    public function getRoute() 
    {
        return $this->route;
    }

    public function setRoute($route) 
    {
        $this->route = $route;
    }

    public function getGroupUser() 
    {
        return $this->groupuser;
    }

    public function setGroupUser($groupuser) 
    {
        $this->groupuser = $groupuser;
    }

    public function getUseraccount() 
    {
        return $this->useraccount;
    }

    public function setUseraccount($useraccount) 
    {
        $this->useraccount = $useraccount;
    }
}

?>
