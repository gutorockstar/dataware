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
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $id;
    
    /** 
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Informe seu login!"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Login', é requerido!");
     */
    protected $username;
    
    /** 
     * @ORM\Column(type="string", length=255) 
     * 
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Filter({"name":"StripTags"})
     
     * @Annotation\Attributes({"class":"form-control", "placeholder":"Informe sua senha!"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Senha', é requerido!");
     */
    protected $password;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Options({"label":"Mantenha-me conectado"})
     * @Annotation\Attributes({"class":"form-control checkbox"})
     */
   // protected $remember;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Logar", "class":"btn btn-primary loading"})
     */
    protected $send;
    
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
}

?>
