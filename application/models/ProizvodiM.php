<?php

class Application_Model_ProizvodiM {

    protected $_dbTable;

    public function setDataTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception("Nepostojeći table gateway!");
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDataTable() {
        if (null == $this->_dbTable) {
            $this->setDataTable('Application_Model_DbTable_Proizvodi');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_ProizvodiE $proizvod) {
        $data = array('idKategorije' => $proizvod->getIdKategorije(), 'naziv' => $proizvod->getNaziv(), 'slikam' => $proizvod->getSlikam(), 'slikav' => $proizvod->getSlikav(), 'cena' => $proizvod->getCena(), 'opis' => $proizvod->getOpis(),
            'boja' => $proizvod->getBoja(), 'brava' => $proizvod->getBrava(), 'tip' => $proizvod->getTip(), 'vs' => $proizvod->getVS(), 'ss' => $proizvod->getSS(),
            'ds' => $proizvod->getDS(), 'vu' => $proizvod->getVU(), 'su' => $proizvod->getSU(), 'du' => $proizvod->getDU(), 'police' => $proizvod->getPolice(),
            'tezina' => $proizvod->getTezina(), 'zapremina' => $proizvod->getZapremina(), 'datum' => $proizvod->getDatum(), 'unutrasnjaBrava' => $proizvod->getUnutrasnjaBrava(),
            'zabravljivanje' => $proizvod->getZabravljivanje());
        if(empty ($data['naziv'])){
            unset($data['naziv']);
        }
        if(empty ($data['idKategorije'])){
            unset($data['idKategorije']);
        }
        if(empty ($data['cena'])){
            unset($data['cena']);
        }
        if(empty ($data['opis'])){
            unset($data['opis']);
        }
        if(empty ($data['boja'])){
            unset($data['boja']);
        }
        if(empty ($data['brava'])){
            unset($data['brava']);
        }
        if(empty ($data['tip'])){
            unset($data['tip']);
        }
        if(empty ($data['vs'])){
            unset($data['vs']);
        }
        if(empty ($data['ss'])){
            unset($data['ss']);
        }
        if(empty ($data['ds'])){
            unset($data['ds']);
        }
        if(empty ($data['vu'])){
            unset($data['vu']);
        }
        if(empty ($data['su'])){
            unset($data['su']);
        }
        if(empty ($data['du'])){
            unset($data['du']);
        }
        if(empty ($data['police'])){
            unset($data['police']);
        }
        if(empty ($data['tezina'])){
            unset($data['tezina']);
        }
        if(empty ($data['zapremina'])){
            unset($data['zapremina']);
        }
        if(empty ($data['datum'])){
            unset($data['datum']);
        }
        if(empty ($data['unutrasnjaBrava'])){
            unset($data['unutrasnjaBrava']);
        }
        if(empty ($data['zabravljivanje'])){
            unset($data['zabravljivanje']);
        }
        if (null == ($id = $proizvod->getIdProizvoda())) {
            unset($data['idProizvoda']);
            $this->getDataTable()->insert($data);
        } else {
            $this->getDataTable()->update($data, array('idProizvoda=?' => $id));
        }
    }
    
    public function find($id, Application_Model_ProizvodiE $proizvod){
        $result=$this->getDataTable()->find($id);
        if(count($result)==0){
            return;
        }
        $row=$result->current();
        $proizvod->setIdProizvoda($row->idProizvoda)->setIdKategorije($row->idKategorije)->setNaziv($row->naziv)->setSlikam($row->slikam)->setSlikav($row->slikav)->setCena($row->cena)->setOpis($row->opis)
                    ->setBoja($row->boja)->setBrava($row->brava)->setTip($row->tip)->setVS($row->vs)->setSS($row->ss)->setDS($row->ds)
                    ->setVU($row->vu)->setSU($row->su)->setDU($row->du)->setPolice($row->police)
                    ->setTezina($row->tezina)->setZapremina($row->zapremina)->setDatum($row->datum)->setUnutrasnjaBrava($row->unutrasnjaBrava)->setZabravljivanje($row->zabravljivanje);
    }

    public function fetchAll($where, $order, $limit) {
        $resultSet = $this->getDataTable()->fetchAll($where, $order, $limit);
        $proizvodi = array();
        foreach ($resultSet as $row) {
            $proizvod = new Application_Model_ProizvodiE();
            $proizvod->setIdProizvoda($row->idProizvoda)->setIdKategorije($row->idKategorije)->setNaziv($row->naziv)->setSlikam($row->slikam)->setSlikav($row->slikav)->setCena($row->cena)->setOpis($row->opis)
                    ->setBoja($row->boja)->setBrava($row->brava)->setTip($row->tip)->setVS($row->vs)->setSS($row->ss)->setDS($row->ds)
                    ->setVU($row->vu)->setSU($row->su)->setDU($row->du)->setPolice($row->police)
                    ->setTezina($row->tezina)->setZapremina($row->zapremina)->setDatum($row->datum)->setUnutrasnjaBrava($row->unutrasnjaBrava)->setZabravljivanje($row->zabravljivanje);
            $proizvodi[] = $proizvod;
        }
        return $proizvodi;
    }
    
    public function delete($id){
        $this->getDataTable()->delete('idProizvoda='.$id);
    }

}
