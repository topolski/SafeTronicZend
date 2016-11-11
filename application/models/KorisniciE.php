<?php

class Application_Model_KorisniciE {

    protected $_idKorisnika;
    protected $_korisnickoIme;
    protected $_lozinka;
    protected $_mail;
    protected $_vremeRegistracije;
    protected $_vremePristupa;
    protected $_status;
    protected $_uloge;
    protected $_mob;

    public function _set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Korisnika nije definisano');
        }
        $this->$method($value);
    }

    public function _get($name, $value) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Korisnika nije definisano');
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

    public function setIdKorisnika($id) {
        $this->_idKorisnika = $id;
        return $this;
    }

    public function getIdKorisnika() {
        return $this->_idKorisnika;
    }

    public function setKorisnickoIme($text) {
        $this->_korisnickoIme = $text;
        return $this;
    }

    public function getKorisnickoIme() {
        return $this->_korisnickoIme;
    }

    public function setLozinka($text) {
        $this->_lozinka = $text;
        return $this;
    }

    public function getLozinka() {
        return $this->_lozinka;
    }

    public function setEmail($text) {
        $this->_mail = $text;
        return $this;
    }

    public function getEmail() {
        return $this->_mail;
    }

    public function setVremeRegistracije($val) {
        $this->_vremeRegistracije = $val;
        return $this;
    }

    public function getVremeRegistracije() {
        return $this->_vremeRegistracije;
    }

    public function setVremePristupa($val) {
        $this->_vremePristupa = $val;
        return $this;
    }

    public function getVremePristupa() {
        return $this->_vremePristupa;
    }

    public function setStatus($val) {
        $this->_status = $val;
        return $this;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function setUloge($uloge) {
        $this->_uloge = $uloge;
        return $this;
    }

    public function getUloge() {
        $podaci = array();
        if (is_object($this->_uloge)) {
            $podaci = $this->_uloge->toArray();
        } else {
            $podaci = $this->_uloge;
        }
        $uloge = array();
        foreach ($podaci as $podatak) {
            $uloge[] = $podatak;
        }
        return $uloge;
    }

    public function naziviUloga() {
        $uloge = $this->getUloge();
        $nazivi = array();
        foreach ($uloge as $uloga) {
            $nazivi[] = $uloga['naziv'];
        }
        return $nazivi;
    }

    public function ulogeId() {
        $ids = array();
        $uloge = $this->getUloge();
        foreach ($uloge as $uloga) {
            $ids[] = $uloga['idUloge'];
        }
        return $ids;
    }
    
    public function setMobilni($m) {
        $this->_mob = $m;
        return $this;
    }

    public function getMobilni() {
        return $this->_mob;
    }

}
