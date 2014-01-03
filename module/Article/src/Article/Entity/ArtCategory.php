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

namespace Article\Entity;
use Doctrine\ORM\Mapping as ORM,
    Zend\Form\Annotation;

/** 
 * @ORM\Entity
 */
class ArtCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="artcategory_categoryid_seq", initialValue=1)
     * 
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $categoryid;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * 
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Categoria pai"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $parentcategoryid;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Título"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Annotation\Type("Zend\Form\Element\File")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Imagem de capa"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $cover;
    
    /**
     * @ORM\Column(type="string")
     * 
     * @Annotation\Type("Tecnon\Component\Form\TextAreaEditor")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Descrição"})
     * @Annotation\Attributes({"class":"form-control"})
     */
    protected $description;
    
    /**
     * @ORM\OneToOne(targetEntity="ArtCategory")
     * @ORM\JoinColumn(name="parentcategory", referencedColumnName="categoryid")
     */
    public $parentcategory;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Salvar", "class":"btn btn-primary"})
     */
    protected $send;
    
    public function getCategoryid() 
    {
        return $this->categoryid;
    }

    public function getParentcategoryid() 
    {
        return $this->parentcategoryid;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function getCover() 
    {
        return $this->cover;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setCategoryid($categoryid) 
    {
        $this->categoryid = $categoryid;
    }

    public function setParentcategoryid($parentcategoryid) 
    {
        $this->parentcategoryid = $parentcategoryid;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function setCover($cover) 
    {
        $this->cover = $cover;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }    
}

?>
