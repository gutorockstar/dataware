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

namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class AdmLogin 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="admlogin_loginid_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $loginid;
    
    /** 
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Tecnon\Component\Form\Lookup")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Login"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $username;
    
    /** 
     * @ORM\Column(type="string", length=255) 
     * 
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Senha"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $password;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Logar", "class":"btn btn-primary"})
     */
    protected $send;
    
    public function getLoginid() 
    {
        return $this->loginid;
    }

    public function setLoginid($loginid) 
    {
        $this->loginid = $loginid;
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
    
    /**
     * Retorna as validações necessárias para o formulário
     * de login.
     * 
     * @return \Zend\InputFilter\InputFilter
     */
    public function getInputFilter()
    {
        $inputFilter = new \Zend\InputFilter\InputFilter();
        $factory     = new \Zend\InputFilter\Factory();
        
        $this->getInputFilterUsername($inputFilter, $factory);
        $this->getInputFilterPassword($inputFilter, $factory);
        
        return $inputFilter;
    }
    
    /**
     * * Retorna as validações necessárias para o campo de login.
     * 
     * @param \Zend\InputFilter\InputFilter $inputFilter
     * @param \Zend\InputFilter\Factory $factory
     */
    private function getInputFilterUsername($inputFilter, $factory)
    {
        $inputFilter->add($factory->createInput(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Login" é requerido.'
                            ),
                        ),
                    ),
                ),
            )
        ));
    }
    
    /**
     * Retorna as validações necessárias para o campo de senha.
     * 
     * @param \Zend\InputFilter\InputFilter $inputFilter
     * @param \Zend\InputFilter\Factory $factory
     */
    private function getInputFilterPassword($inputFilter, $factory)
    {
        $inputFilter->add($factory->createInput(array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O campo "Senha" é requerido.'
                            ),
                        ),
                    ),
                ),
            )
        ));
    }
}

?>
