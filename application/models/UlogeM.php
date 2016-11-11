<?php

class Application_Model_UlogeM {

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
            $this->setDbTable('Application_Model_DbTable_Uloge');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_UlogeE $uloga) {
        $data = array(
            'naziv' => $uloga->getNaziv(),
            'nazivMalaSlova' => strtolower($uloga->getNaziv())
        );
        if (null === ($id = $uloga->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idUloge=?' => $id));
        }
    }

    public function find($id, Application_Model_UlogeE $uloga) {
        $result = $this->getDbTable()->find($id);
        if (count($result) == 0) {
            return;
        }
        $row = $result->current();
        $uloga->setId($row->idUloge)->setNaziv($row->naziv)->setKorisnici($row->findDependentRowset('Application_Model_DbTable_KorisnikUloga'));
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $uloge = array();
        foreach ($resultSet as $row) {
            $uloga = new Application_Model_UlogeE();
            $uloga->setId($row->idUloge)->setNaziv($row->naziv)->setKorisnici($row->findDependentRowset('Application_Model_DbTable_KorisnikUloga'));
            $uloge[] = $uloga;
        }
        return $uloge;
    }

    public function delete($id) {
        $this->getDbTable()->delete('idUloge=' . $id);
    }

}
