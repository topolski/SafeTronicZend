<?php

class Application_Model_KategorijeM
{

    protected $_dbTable;
    
    public function setDataTable($dbTable)
    {
        if (is_string($dbTable)) 
        {
            $dbTable=new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract)
        {
            throw new Exception("Nepostojeći table gateway");
        }
        $this->_dbTable=$dbTable;
        return $this;
    }
    
    public function getDataTable()
    {
        if (null== $this->_dbTable)
        {
            $this->setDataTable('Application_Model_DbTable_Kategorije');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_KategorijeE $kategorija)
    {
        $data=array('PunNaziv'=>$kategorija->getPunNaziv(),'KratakNaziv'=>$kategorija->getKratakNaziv());
        if (null == ($id=$kategorija->getId()))
        {
            unset($data['idKategorije']);
            $this->getDataTable()->insert($data);
        }
        else 
        {
            $this->getDataTable()->update($data,array('idKategorije=?'=>$id));
        }
    }
    
    public function find($id, Application_Model_KategorijeE $kategorija){
        $result=$this->getDataTable()->find($id);
        if(count($result)==0){
            return;
        }
        $row=$result->current();
        $kategorija->setId($row->idKategorije)->setPunNaziv($row->PunNaziv)->setKratakNaziv($row->KratakNaziv);
    }
    
    public function fetchAll($where, $order, $limit){
        $resultSet=$this->getDataTable()->fetchAll($where, $order, $limit);
        $kategorije=array();
        foreach ($resultSet as $row){
            $kategorija=new Application_Model_KategorijeE();
            $kategorija->setId($row->idKategorije)->setPunNaziv($row->PunNaziv)->setKratakNaziv($row->KratakNaziv);
            $kategorije[]=$kategorija;
        }
        return $kategorije;
    }
    
    public function delete($id){
        $this->getDataTable()->delete('idKategorije='.$id);
    }

}

