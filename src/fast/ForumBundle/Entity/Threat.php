<?php

namespace fast\ForumBundle\Entity;

/**
 * Threat
 */
class Threat
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Threat
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var \fast\ForumBundle\Entity\Categoria
     */
    private $categoria;


    /**
     * Set categoria
     *
     * @param \fast\ForumBundle\Entity\Categoria $categoria
     *
     * @return Threat
     */
    public function setCategoria(\fast\ForumBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \fast\ForumBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
