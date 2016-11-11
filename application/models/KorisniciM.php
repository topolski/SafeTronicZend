<?php

class Application_Model_KorisniciM {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception("Nepostojeći table geteway!");
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null == $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Korisnici');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_KorisniciE $korisnik) {
        $data = array(
            'idKorisnika' => $korisnik->getIdKorisnika(),
            'korisnickoIme' => $korisnik->getKorisnickoIme(),
            'lozinka' => sha1($korisnik->getLozinka()),
            'mail' => $korisnik->getEmail(),
            'mobilni' => $korisnik->getMobilni(),
            'status' => $korisnik->getStatus(),
            'vremeRegistracije' => time(),
            'vremePristupa' => time()
        );
        if ($korisnik->getLozinka() == '') {
            unset($data['lozinka']);
        }
        if (null === ($id = $korisnik->getIdKorisnika())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idKorisnika=?' => $id));
        }
    }

    public function find($id, Application_Model_KorisniciE $korisnik) {
        $result = $this->getDbTable()->find($id);
        if (count($result) == 0) {
            return;
        }
        $row = $result->current();
        $korisnik->setIdKorisnika($row->idKorisnika)->setMobilni($row->mobilni)->setKorisnickoIme($row->korisnickoIme)->setLozinka($row->lozinka)->setEmail($row->mail)->setStatus($row->status)->setVremeRegistracije($row->vremeRegistracije)->setVremePristupa($row->vremePristupa)->setUloge($row->findManyToManyRowset('Application_Model_DbTable_Uloge', 'Application_Model_DbTable_KorisnikUloga', 'korisnici'));
    }

    public function fetchAll($where) {
        $resultSet = $this->getDbTable()->fetchAll($where);
        $korisnici = array();
        foreach ($resultSet as $row) {
            $korisnik = new Application_Model_KorisniciE();
            $korisnik->setIdKorisnika($row->idKorisnika)->setMobilni($row->mobilni)->setKorisnickoIme($row->korisnickoIme)->setLozinka($row->lozinka)->setEmail($row->mail)->setStatus($row->status)->setVremeRegistracije($row->vremeRegistracije)->setVremePristupa($row->vremePristupa)->setUloge($row->findManyToManyRowset('Application_Model_DbTable_Uloge', 'Application_Model_DbTable_KorisnikUloga', 'korisnici'));
            $korisnici[] = $korisnik;
        }
        return $korisnici;
    }

    public function delete($id) {
        $where = $this->getDbTable()->getAdapter()->quoteInto('idKorisnika=?', $id);
        $this->getDbTable()->delete($where);
    }

    public function accessTime($id) {
        $data = array('vremePristupa' => time());
        $data['idKorisnika'] = $id;
        $this->getDbTable()->update($data);
    }

}
