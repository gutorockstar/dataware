<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdmGroupUser
 *
 * @author augusto
 */

namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class AdmGroupLogin
{    
    /**
     * @ORM\Id
     * @ORM\Column(name="groupid", type="integer")
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $groupid;
    
    /**
     * @ORM\Id
     * @ORM\Column(name="loginid", type="integer")
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $loginid;
    
    /**
     * @ORM\ManyToOne(targetEntity="AdmGroup")
     * @ORM\JoinColumn(name="group", referencedColumnName="groupid")
     **/
    protected $group;
    
    /**
     * @ORM\ManyToOne(targetEntity="AdmLogin")
     * @ORM\JoinColumn(name="login", referencedColumnName="loginid")
     **/
    protected $login;

    public function getGroupid() 
    {
        return $this->groupid;
    }

    public function getLoginid() 
    {
        return $this->loginid;
    }

    public function getGroup() 
    {
        return $this->group;
    }

    public function getLogin() 
    {
        return $this->login;
    }

    public function setGroupid($groupid) 
    {
        $this->groupid = $groupid;
    }

    public function setLoginid($loginid) 
    {
        $this->loginid = $loginid;
    }

    public function setGroup($group) 
    {
        $this->group = $group;
    }

    public function setLogin($login) 
    {
        $this->login = $login;
    }
}
