<?php
namespace App\Classes;

class Curso
{
    //ATRIBUTOS
    private $id;
    private $siglas;
    private $nombre;
    private $siglasCiclo;

    //CONSTRUCTOR
    public function __construct($id, $siglas, $nombre, $siglasCiclo)
    {
        $this->id = $id;
        $this->siglas = $siglas;
        $this->nombre = $nombre;
        $this->siglasCiclo = $siglasCiclo;
    }

    //GETTERS & SETTERS

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of siglas
     */
    public function getSiglas()
    {
        return $this->siglas;
    }

    /**
     * Set the value of siglas
     *
     * @return  self
     */
    public function setSiglas($siglas)
    {
        $this->siglas = $siglas;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of siglasCiclo
     */
    public function getSiglasCiclo()
    {
        return $this->siglasCiclo;
    }

    /**
     * Set the value of siglasCiclo
     *
     * @return  self
     */
    public function setSiglasCiclo($siglasCiclo)
    {
        $this->siglasCiclo = $siglasCiclo;

        return $this;
    }
}
?>
