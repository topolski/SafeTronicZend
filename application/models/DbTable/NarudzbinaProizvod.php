<?php

class Application_Model_DbTable_NarudzbinaProizvod extends Zend_Db_Table_Abstract
{

    protected $_name = 'narudzbina_proizvod';
    protected $_primary='idNarudzbine';
    
    protected $_referenceMap=array(
        'Narudzbine'=>array(
            'columns'=>array('idNarudzbine'),
            'refTableClass'=>'Application_Model_DbTable_Narudzbine',
            'refColumns'=>array('idNarudzbine')
        ),
        'Proizvodi'=>array(
            'columns'=>array('idProizvoda'),
            'refTableClass'=>'Application_Model_DbTable_Proizvodi',
            'refColumns'=>array('idProizvoda')
        ),       
    );

}

