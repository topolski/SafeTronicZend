<?php

class Application_Model_DbTable_Korisnici extends Zend_Db_Table_Abstract {

    protected $_name = 'korisnici';
    protected $_id = 'idKorisnika';
    
    protected $_dependentTables = array('Application_Model_DbTable_KorisnikUloga', 'Application_Model_DbTable_Narudzbine');

    public function insert(array $data) {
        $new_id = parent::insert($data);
        $korisnikUloga = new Application_Model_DbTable_KorisnikUloga();
        $korisnikUloga->insert(array('idKorisnika' => $new_id, 'idUloge' => 2));
    }

    public function update(array $data, $where) {
        $uloge = !empty($data['uloge']) ? $data['uloge'] : array();
        unset($data['uloge']);
        parent::update($data, array('idKorisnika=?' => $data['idKorisnika']));
        $korisnikUloga = new Application_Model_DbTable_KorisnikUloga();
        $where = $korisnikUloga->getAdapter()->quoteInto('idKorisnika=?', $data['idKorisnika']);
        if (!empty($uloge)) {
            $korisnikUloga->delete($where);
        }
        foreach ($uloge as $uloga) {
            $korisnikUloga->insert(array('idKorisnika' => $data['idKorisnika'], 'idUloge' => $uloga));
        }
    }

    public function delete($where) {
        parent::delete($where);
        $korisnikUloga = new Application_Model_DbTable_KorisnikUloga();
        $korisnikUloga->delete($where);
    }

}
