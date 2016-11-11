<?php

class Application_Model_UlogeE {

    protected $_id;
    protected $_naziv;
    protected $_korisnici;

    public function _set($name, $value) {

        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Uloge nije definisano!');
        }
        $this->$method($value);
    }

    public function _get($name, $value) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Svojstvo za Uloge nije definisano!');
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

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setNaziv($text) {
        $this->_naziv = $text;
        return $this;
    }

    public function getNaziv() {
        return $this->_naziv;
    }

    public function setKorisnici($array) {
        $this->_korisnici = $array;
        return $this;
    }

    public function getKorisnici() {
        return $this->_korisnici;
    }

}
