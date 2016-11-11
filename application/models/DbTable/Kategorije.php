<?php

class Application_Model_DbTable_Kategorije extends Zend_Db_Table_Abstract
{

    protected $_name = 'kategorijeproizvoda';
    protected $_id = 'idKategorije';
    protected $_dependentTables=array('Application_Model_DbTable_Proizvodi');
}

