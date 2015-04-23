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

namespace System\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 * @ORM\Table(name="system.login")
 */
class Login
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="login_id_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"ID"})
     * @Annotation\Attributes({"class":"input-numeric form-control", "readOnly":"true"})
     * @Annotation\AllowEmpty(true)
     */
    protected $id;
    
    /** 
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Login"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Login', é requerido!");
     */
    protected $username;
    
    /** 
     * @ORM\Column(type="string", length=255) 
     * 
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Senha"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Senha', é requerido!");
     */
    protected $password;
    
    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45)")
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Nome"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=255, columnDefinition="VARCHAR(255)")
     * 
     * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"E-mail"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\AllowEmpty(true)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT TRUE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Ativo", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"1"})
     * @Annotation\AllowEmpty(true)
     */
    protected $active;
    
    /**
     * @ORM\Column(type="boolean", columnDefinition="BOOLEAN NOT NULL DEFAULT FALSE")
     * 
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Admin", "type":"boolean", "value_options":{"1":"Sim", "0":"Não"}})
     * @Annotation\Attributes({"class":"input-checkbox form-control", "value":"1"})
     * @Annotation\AllowEmpty(true)
     */
    protected $isadmin;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getUsername() 
    {
        return $this->username;
    }

    public function setUsername($username) 
    {
        $this->username = $username;
    }

    public function getPassword() 
    {
        return $this->password;
    }

    public function setPassword($password) 
    {
        $this->password = $password;
    }
    
    public function getName() 
    {
        return $this->name;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function setEmail($email) 
    {
        $this->email = $email;
    }

    public function getActive() 
    {
        return $this->active;
    }

    public function setActive($active) 
    {
        $this->active = $active;
    }

    public function getIsadmin() 
    {
        return $this->isadmin;
    }

    public function setIsadmin($isadmin) 
    {
        $this->isadmin = $isadmin;
    }
}

?>
