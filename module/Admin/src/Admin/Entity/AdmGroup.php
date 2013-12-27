<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdmGroup
 *
 * @author augusto
 */

namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class AdmGroup 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="admgroup_groupid_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $groupid;
    
    /** 
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Nome"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $groupname;
    
    public function getGroupid() 
    {
        return $this->groupid;
    }

    public function getGroupname() 
    {
        return $this->groupname;
    }

    public function setGroupid($groupid) 
    {
        $this->groupid = $groupid;
    }

    public function setGroupname($groupname) 
    {
        $this->groupname = $groupname;
    }
}
