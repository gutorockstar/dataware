<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File
 *
 * @author augusto
 */
namespace System\Entity;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="system.file")
 */
class File 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="file_id_seq", initialValue=1)
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255, columnDefinition="VARCHAR(255) NOT NULL")
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=45, columnDefinition="VARCHAR(45) NOT NULL")
     */
    private $contenttype;
    
    /**
     * @ORM\Column(type="string", length=255, columnDefinition="VARCHAR(255) NOT NULL")
     */
    private $filepath;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function getContenttype() 
    {
        return $this->contenttype;
    }

    public function setContenttype($contenttype) 
    {
        $this->contenttype = $contenttype;
    }

    public function getFilepath() 
    {
        return $this->filepath;
    }

    public function setFilepath($filepath) 
    {
        $this->filepath = $filepath;
    }
}

?>
