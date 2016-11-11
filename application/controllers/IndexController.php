<?php

class IndexController extends Zend_Controller_Action {

    public function preDispatch() {
        $this->view->render('dodatno/_slajder.phtml');
        $this->view->render('dodatno/_slajderjs.phtml');
    }

    public function init() {
        $this->view->headTitle()->append('Naslovna');
        $layout = $this->_helper->layout();
        $layout->link1 = 'class="selected"';
        $layout->link2 = '';
        $layout->link3 = '';
        $layout->link4 = '';
    }

    public function indexAction() {
        $proizvodiMaper = new Application_Model_ProizvodiM();
        $proizvodi = $proizvodiMaper->fetchAll(NULL, "Datum ASC", "9");
        $this->view->noviproizvodi = $proizvodi;
    }

    public function pretragaAction() {
        $ulogovan = null;
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        $korisnik = new Application_Model_KorisniciE();
        $korisnik = $autentifikacija->getIdentity();
        if ($this->ulogovan && in_array('Administrator', $korisnik->naziviUloga())) {
            $this->view->admin = 1;
        }
        $request = $this->getRequest();
        $pojam = $request->getParam('tbRec');
        if ($request->isPost() && !empty($pojam)) {
            $proizvodiMapper = new Application_Model_ProizvodiM();
            $tabela = $proizvodiMapper->getDataTable();
            $select = $tabela->select();
            $select->where('opis LIKE ?', '%' . $pojam . '%');
            $proizvodi = $proizvodiMapper->fetchAll($select, NULL, NULL);                    
            $this->view->pretraga = $proizvodi;
            $this->view->pojam = $pojam;
        }
    }

}
