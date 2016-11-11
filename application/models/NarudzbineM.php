<?php

class Application_Model_NarudzbineM
{
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
            $this->setDbTable('Application_Model_DbTable_Narudzbine');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_NarudzbineE $narudzbina) {
        $data = array(
            'idKorisnika' => $narudzbina->getKorisnika(),
            'datum' => $narudzbina->getDatum(),
            'cena' => $narudzbina->getCena(),
            'proizvodi' => $narudzbina->getProizvode(),
            'poslato' => $narudzbina->getPoslato(),
            'datumP' => $narudzbina->getDatumP()
        );
        if(empty ($data['idKorisnika'])){
            unset($data['idKorisnika']);
        }
        if(empty ($data['datum'])){
            unset($data['datum']);
        }
        if(empty ($data['cena'])){
            unset($data['cena']);
        }
        if(empty ($data['proizvodi'])){
            unset($data['proizvodi']);
        }
        if(empty ($data['poslato'])){
            unset($data['poslato']);
        }
        if(empty ($data['datumP'])){
            unset($data['datumP']);
        }
        if (null === ($id = $narudzbina->getIdNarudzbine())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idNarudzbine=?' => $id));
        }
    }

    public function find($id, Application_Model_NarudzbineE $narudzbina) {
        $result = $this->getDbTable()->find($id);
        if (count($result) == 0) {
            return;
        }
        $row = $result->current();
        $narudzbina->setIdNarudzbine($row->idNarudzbine)->setPoslato($row->poslato)->setDatumP($row->datumP)->setKorisnika($row->findParentRow('Application_Model_DbTable_Korisnici'))->setDatum($row->datum)->setCena($row->cena)->setProizvode($row->findManyToManyRowset('Application_Model_DbTable_Proizvodi','Application_Model_DbTable_NarudzbinaProizvod','Narudzbine'))->setPodatke($row->findDependentRowset('Application_Model_DbTable_NarudzbinaProizvod'));
    }

    public function fetchAll($where) {
        $resultSet = $this->getDbTable()->fetchAll($where);
        $narudzbine = array();
        foreach ($resultSet as $row) {
            $narudzbina = new Application_Model_NarudzbineE();
            $narudzbina->setIdNarudzbine($row->idNarudzbine)->setPoslato($row->poslato)->setDatumP($row->datumP)->setKorisnika($row->findParentRow('Application_Model_DbTable_Korisnici'))->setDatum($row->datum)->setCena($row->cena)->setProizvode($row->findManyToManyRowset('Application_Model_DbTable_Proizvodi','Application_Model_DbTable_NarudzbinaProizvod','Narudzbine'))->setPodatke($row->findDependentRowset('Application_Model_DbTable_NarudzbinaProizvod'));
            $narudzbine[] = $narudzbina;
        }
        return $narudzbine;
    }

    public function delete($id) {
        $where = $this->getDbTable()->getAdapter()->quoteInto('idNarudzbine=?', $id);
        $this->getDbTable()->delete($where);
    }

}

