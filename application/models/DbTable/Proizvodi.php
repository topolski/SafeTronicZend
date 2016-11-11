<?php

class Application_Model_DbTable_Proizvodi extends Zend_Db_Table_Abstract
{

    protected $_name = 'proizvodi';
    protected $_id = 'idProizvoda';
    
    protected $_dependentTables=array('Application_Model_DbTable_NarudzbinaProizvod');
    
    protected $_referenceMap=array(
        'Kategorija'=>array(
            'columns'=>array('idKategorije'),
            'refTableClass'=>'Application_Model_DbTable_Kategorije',
            'refColumns'=>array('idKategorije')
        ),
   );
}

