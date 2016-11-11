<?php

class Application_Model_ProizvodiE
{

    protected $_idProizvoda;
    protected $_idKategorije;
    protected $_naziv;
    protected $_slikam;
    protected $_slikav;
    protected $_cena;
    protected $_opis;
    protected $_boja;
    protected $_brava;
    protected $_tip;
    protected $_vs;
    protected $_ss;
    protected $_ds;
    protected $_vu;
    protected $_su;
    protected $_du;
    protected $_police;
    protected $_tezina;
    protected $_zapremina;
    protected $_datum;
    protected $_unutrasnjaBrava;
    protected $_zabravljivanje;
    
    public function setIdProizvoda($idProizvoda)
    {
        $this->_idProizvoda=$idProizvoda;
        return $this;
    }
    public function getIdProizvoda()
    {
        return $this->_idProizvoda;
    }
    public function setIdKategorije($idKategorije)
    {
        $this->_idKategorije=$idKategorije;
        return $this;
    }
    public function getIdKategorije()
    {
        return $this->_idKategorije;
    }
    public function setNaziv($text)
    {
        $this->_naziv=$text;
        return $this;
    }
    public function getNaziv()
    {
        return $this->_naziv;
    }   
    public function setSlikam($slikam)
    {
        $this->_slikam=$slikam;
        return $this;
    }
    public function getSlikam()
    {
        return $this->_slikam;
    }   
    public function setSlikav($slikav)
    {
        $this->_slikav=$slikav;
        return $this;
    }
    public function getSlikav()
    {
        return $this->_slikav;
    }   
    public function setCena($cena)
    {
        $this->_cena=$cena;
        return $this;
    }
    public function getCena()
    {
        return $this->_cena;
    }
    public function setOpis($opis)
    {
        $this->_opis=$opis;
        return $this;
    }
    public function getOpis()
    {
        return $this->_opis;
    }
    public function setBoja($boja)
    {
        $this->_boja=$boja;
        return $this;
    }
    public function getBoja()
    {
        return $this->_boja;
    }   
    public function setBrava($brava)
    {
        $this->_brava=$brava;
        return $this;
    }
    public function getBrava()
    {
        return $this->_brava;
    }
    public function setTip($tip)
    {
        $this->_tip=$tip;
        return $this;
    }
    public function getTip()
    {
        return $this->_tip;
    }
    public function setVS($vs)
    {
        $this->_vs=$vs;
        return $this;
    }
    public function getVS()
    {
        return $this->_vs;
    }
    public function setSS($ss)
    {
        $this->_ss=$ss;
        return $this;
    }
    public function getSS()
    {
        return $this->_ss;
    }   
    public function setDS($ds)
    {
        $this->_ds=$ds;
        return $this;
    }
    public function getDS()
    {
        return $this->_ds;
    }
    public function setVU($vu)
    {
        $this->_vu=$vu;
        return $this;
    }
    public function getVU()
    {
        return $this->_vu;
    }
    public function setSU($su)
    {
        $this->_su=$su;
        return $this;
    }
    public function getSU()
    {
        return $this->_su;
    }   
    public function setDU($du)
    {
        $this->_du=$du;
        return $this;
    }
    public function getDU()
    {
        return $this->_du;
    }
    public function setPolice($police)
    {
        $this->_police=$police;
        return $this;
    }
    public function getPolice()
    {
        return $this->_police;
    }
    public function setTezina($tezina)
    {
        $this->_tezina=$tezina;
        return $this;
    }
    public function getTezina()
    {
        return $this->_tezina;
    }   
    public function setZapremina($zapremina)
    {
        $this->_zapremina=$zapremina;
        return $this;
    }
    public function getZapremina()
    {
        return $this->_zapremina;
    }
    public function setDatum($datum)
    {
        $this->_datum=$datum;
        return $this;
    }
    public function getDatum()
    {
        return $this->_datum;
    }
    public function setUnutrasnjaBrava($ubrava)
    {
        $this->_unutrasnjaBrava=$ubrava;
        return $this;
    }
    public function getUnutrasnjaBrava()
    {
        return $this->_unutrasnjaBrava;
    }
    public function setZabravljivanje($zab)
    {
        $this->_zabravljivanje=$zab;
        return $this;
    }
    public function getZabravljivanje()
    {
        return $this->_zabravljivanje;
    }
}

