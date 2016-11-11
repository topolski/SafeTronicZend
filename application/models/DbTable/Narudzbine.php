<?php

class Application_Model_DbTable_Narudzbine extends Zend_Db_Table_Abstract
{

    protected $_name = 'narudzbine';
    protected $_id = 'idNarudzbine';
    
    protected $_dependentTables=array('Application_Model_DbTable_NarudzbinaProizvod');
    
    protected $_referenceMap=array(
        'Korisnici'=>array(
            'columns'=>array('idKorisnika'),
            'refTableClass'=>'Application_Model_DbTable_Korisnici',
            'refColumns'=>array('idKorisnika')
        )
    );
    
    public function insert(array $data){
        $proizvodi=$data['proizvodi'];
        unset($data['proizvodi']);
        $new_id=parent::insert($data);
        $narudzbinaProizvod=new Application_Model_DbTable_NarudzbinaProizvod();
        foreach ($proizvodi as $proizvod) {
            $podaci = explode(',', $proizvod);
            $narudzbinaProizvod->insert(array('idNarudzbine'=>$new_id,'idProizvoda'=>$podaci[0],'boja'=>$podaci[2],'kolicina'=>$podaci[1]));
        }
    }
    
     public function delete($where) {
        parent::delete($where);
        $narudzbinaProizvod = new Application_Model_DbTable_NarudzbinaProizvod();
        $narudzbinaProizvod->delete($where);
    }
    
}

