<?php

class Application_Model_KategorijeE
{

    protected $_idKategorije;
    protected $_PunNaziv;
    protected $_KratakNaziv;
    
    public function setId($id)
    {
        $this->_idKategorije=$id;
        return $this;
    }
    public function getId()
    {
        return $this->_idKategorije;
    }
    public function setPunNaziv($text)
    {
        $this->_PunNaziv=$text;
        return $this;
    }
    public function getPunNaziv()
    {
        return $this->_PunNaziv;
    }   
    public function setKratakNaziv($text)
    {
        $this->_KratakNaziv=$text;
        return $this;
    }
    public function getKratakNaziv()
    {
        return $this->_KratakNaziv;
    }  
}

