<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teste
 *
 * @author augusto
 */
namespace Site\Entity;

use Zend\Form\Annotation;

class Contact 
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Nome *"})
     * @Annotation\Attributes({"class":"form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Nome', é requerido!")
     */
    private $name;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"E-mail *"})
     * @Annotation\Attributes({"class":"input-text form-control", "onBlur":"ValidaEmail(this)"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'E-mail', é requerido!")
     */
    private $email;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Telefone"})
     * @Annotation\Attributes({"class":"input-text form-control", "maxlength":"14", "onKeyPress":"MascaraTelefone(this)", "onBlur":"ValidaTelefone(this)"})
     * @Annotation\AllowEmpty(true)
     */
    private $phone;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Cidade *"})
     * @Annotation\Attributes({"class":"input-text form-control"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Cidade', é requerido!")
     */
    private $city;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Tipo de pessoa", "type":"boolean", "value_options":{"1":"Física", "0":"Jurídica"}})
     * @Annotation\Attributes({"class":"form-control input-checkbox", "value":"1", "onClick":"verificaTipoPessoa(this.value)"})
     */
    private $persontype;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"CPF *"})
     * @Annotation\Attributes({"class":"input-text form-control", "id":"cpf", "maxlength":"14", "onKeyPress":"MascaraCPF(this)", "onBlur":"ValidarCPF(this)"})
     * @Annotation\AllowEmpty(true)
     */
    private $cpf;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"CNPJ *"})
     * @Annotation\Attributes({"class":"input-text form-control", "id":"cnpj", "disabled":"true", "maxlength":"18", "onKeyPress":"MascaraCNPJ(this)", "onBlur":"ValidarCNPJ(this)"})
     * @Annotation\AllowEmpty(true)
     */
    private $cnpj;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Mensagem *"})
     * @Annotation\Attributes({"class":"input-textarea form-control"})
     * @Annotation\ErrorMessage("O preenchimento do campo 'Mensagem', é requerido!")
     */
    private $message;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Enviar contato", "class":"submit-button"})
     */
    private $sendcontact;
    
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

    public function getPhone() 
    {
        return $this->phone;
    }

    public function setPhone($phone) 
    {
        $this->phone = $phone;
    }

    public function getCity() 
    {
        return $this->city;
    }

    public function setCity($city) 
    {
        $this->city = $city;
    }

    public function getPersontype() 
    {
        return $this->persontype;
    }

    public function setPersontype($persontype) 
    {
        $this->persontype = $persontype;
    }

    public function getCpf() 
    {
        return $this->cpf;
    }

    public function setCpf($cpf) 
    {
        $this->cpf = $cpf;
    }

    public function getCnpj() 
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) 
    {
        $this->cnpj = $cnpj;
    }

    public function getMessage() 
    {
        return $this->message;
    }

    public function setMessage($message) 
    {
        $this->message = $message;
    }

    public function getSendcontact() 
    {
        return $this->sendcontact;
    }

    public function setSendcontact($sendcontact) 
    {
        $this->sendcontact = $sendcontact;
    }
}

?>
