<?php

class Application_Model_NarudzbineE {

    protected $_idNarudzbine;
    protected $_korisnik;
    protected $_datum;
    protected $_cena;
    protected $_proizvodi;
    protected $_podaci;
    protected $_kolicina;
    protected $_boja;
    protected $_poslato;
    protected $_datumP;

    public function _set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Narudzbinu nije definisano');
        }
        $this->$method($value);
    }

    public function _get($name, $value) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Narudzbinu nije definisano');
        }
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setIdNarudzbine($idN) {
        $this->_idNarudzbine = $idN;
        return $this;
    }

    public function getIdNarudzbine() {
        return $this->_idNarudzbine;
    }
    
    public function setKorisnika($k) {
        $this->_korisnik = $k;
        return $this;
    }

    public function getKorisnika() {
        return is_object($this->_korisnik)? $this->_korisnik->toArray() : $this->_korisnik ;
    }

    public function setDatum($val) {
        $this->_datum = $val;
        return $this;
    }

    public function getDatum() {
        return $this->_datum;
    }
    
    public function setDatumP($val) {
        $this->_datumP = $val;
        return $this;
    }

    public function getDatumP() {
        return $this->_datumP;
    }
    
    public function setPoslato($val) {
        $this->_poslato = $val;
        return $this;
    }

    public function getPoslato() {
        return $this->_poslato;
    }
    
    public function setCena($val) {
        $this->_cena = $val;
        return $this;
    }

    public function getCena() {
        return $this->_cena;
    }
    
    public function setProizvode($proizvodi){
        $this->_proizvodi=$proizvodi;
        return $this;
    }
    
    public function getProizvode(){
        $podaci=array();
        if(is_object($this->_proizvodi)){
             $podaci=$this->_proizvodi->toArray();
        }else{
            $podaci=$this->_proizvodi;
        }
        $proizvodi=array();
        foreach($podaci as $podatak){
            $proizvodi[]=$podatak;
        }
        return $proizvodi;
    }
    
    public function proizvodiId(){
        $ids=array();
        $proizvodi=$this->getProizvode();
        foreach($proizvodi as $proizvod){
            $ids[]=$proizvod['idProizvoda'];
        } 
        return $ids;
    }
    
    public function naziviProizvoda(){
        $proizvodi=$this->getProizvode();
        $nazivi=array();
        foreach($proizvodi as $proizvod){
            $nazivi[]=$proizvod['naziv'];
        }
        return $nazivi;
    }
    
    public function cenaProizvoda(){
        $proizvodi=$this->getProizvode();
        $cene=array();
        foreach($proizvodi as $proizvod){
            $cene[]=$proizvod['cena'];
        }
        return $cene;
    }
    
    public function setPodatke($val) {
        $this->_podaci = $val;
        return $this;
    }

    public function getPodatke() {
        $podaci=array();
        if(is_object($this->_podaci)){
             $podaci=$this->_podaci->toArray();
        }else{
            $podaci=$this->_podaci;
        }
        $podaciOnarudzbini=array();
        foreach($podaci as $podatak){
            $podaciOnarudzbini[]=$podatak;
        }
        return $podaciOnarudzbini;
    } 
   
    public function getKolicina() {
        $podaci=$this->getPodatke();
        $kolicina=array();
        foreach($podaci as $podatak){
            $kolicina[]=$podatak['kolicina'];
        }
        return $kolicina;
    }
    
    public function getBoja() {
        $podaci=$this->getPodatke();
        $boja=array();
        foreach($podaci as $podatak){
            $boja[]=$podatak['boja'];
        }
        return $boja;
    }
    
}
