<?php

class Application_Model_DbTable_Uloge extends Zend_Db_Table_Abstract
{

    protected $_name = 'uloge';
    protected $_id='idUloge';
    protected $_dependentTables=array('Application_Model_DbTable_KorisnikUloga');

}

