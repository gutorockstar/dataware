<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserGroup
 *
 * @author augusto
 */
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="admin.usergroup")
 */
class UserGroup 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="module_id_seq", initialValue=1)
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserAccount", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="useraccount_id", referencedColumnName="id", nullable=false)
     */
    protected $useraccount;
    
    /**
     * @ORM\ManyToOne(targetEntity="GroupUser", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="groupuser_id", referencedColumnName="id", nullable=false)
     */
    protected $groupuser;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getUseraccount() 
    {
        return $this->useraccount;
    }

    public function setUseraccount($useraccount) 
    {
        $this->useraccount = $useraccount;
    }

    public function getGroupUser() 
    {
        return $this->groupuser;
    }

    public function setGroupUser($groupuser) 
    {
        $this->groupuser = $groupuser;
    }
}

?>
