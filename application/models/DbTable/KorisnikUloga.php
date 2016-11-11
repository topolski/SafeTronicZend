<?php

class Application_Model_DbTable_KorisnikUloga extends Zend_Db_Table_Abstract
{

    protected $_name = 'korisnik_uloga';
    protected $_primary='idKorisnika';

    protected $_referenceMap=array(
        'korisnici'=>array(
            'columns'=>array('idKorisnika'),
            'refTableClass'=>'Application_Model_DbTable_Korisnici',
            'refColumns'=>array('idKorisnika')
        ),
        'uloge'=>array(
            'columns'=>array('idUloge'),
            'refTableClass'=>'Application_Model_DbTable_Uloge',
            'refColumns'=>array('idUloge')
        ),
    );

}

