<?php

class KupovinaController extends Zend_Controller_Action
{
    
    public function init()
    {
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        if (!$this->ulogovan) {
            $this->_redirect('/naslovna');
        }
    }

    public function indexAction()
    {
        $this->view->headTitle()->append('Kupovina');
        $this->view->render('dodatno/_korpa.phtml');
        $this->view->render('dodatno/_stranicenje.phtml');
        $proizvodiMaper = new Application_Model_ProizvodiM();
        $proizvodi = $proizvodiMaper->fetchAll(NULL, "Datum ASC", NULL);
        $this->view->proizvodi = $proizvodi;
    }

    public function pregledAction()
    {
        $this->view->headTitle()->append('Nova porudžbina');
        $autentifikacija = Zend_Auth::getInstance();
        $korisnik = $autentifikacija->getIdentity();
        $cnt = array();
        $products = array();
        $total = 0;
        $proizovdi = array();
        $proizvod = "";
        foreach (filter_input_array(INPUT_POST) as $key => $value) {
            $id = (int) str_replace('_cnt', '', $key);
            $products[] = $id;
            $cnt[$key] = $value;
        }
        $proizvodMapper = new Application_Model_ProizvodiM();
        $podaci = $proizvodMapper->fetchAll("idProizvoda IN(" . join($products, ',') . ")", NULL, null);
        foreach ($podaci as $podatak) {
            $total+=$cnt[$podatak->getIdProizvoda() . '_cnt'] * $podatak->getCena();
            if($cnt[$podatak->getIdProizvoda() . '_cnt'] != 0){
                $proizovdi[] = $podatak->getIdProizvoda().",".$cnt[$podatak->getIdProizvoda() . '_cnt'].",".$cnt[$podatak->getIdProizvoda() . '_boja'];
            }            
        }
        $narudzbina = new Application_Model_NarudzbineE();
        $narudzbinaM = new Application_Model_NarudzbineM();
        $narudzbina->setCena($total);
        $narudzbina->setDatum(time());
        $narudzbina->setKorisnika($korisnik->getIdKorisnika());
        $narudzbina->setProizvode($proizovdi);
        $narudzbina->setPoslato(0);
        $narudzbina->setDatumP(0);
        $narudzbinaM->save($narudzbina);
        $this->view->podaci = $podaci;
        $this->view->cnt = $cnt;     
        $this->view->total = $total;
    }

    public function podaciAction()
    {
        $this->_helper->layout()->disableLayout();
        $request=$this->getRequest();
        if (!filter_input(INPUT_POST, "img") || !$request->isXmlHttpRequest()) {
            $this->view->greske = "Proizvod ne postoji!";
        }
        $img = filter_input(INPUT_POST, "img");
        $proizvodMaper = new Application_Model_ProizvodiM();
        $podaci = $proizvodMaper->fetchAll('slikam ="' . $img . '"', NULL, NULL);
        $this->view->podaci = $podaci;
        if (!$podaci) {
            $this->view->greske = "Proizvod ne postoji!";
        }
    }

    public function korpaAction()
    {
        $this->_helper->layout()->disableLayout();
        $request=$this->getRequest();
        if (!filter_input(INPUT_POST, "img") || !$request->isXmlHttpRequest()) {
            die("Proizvod ne postoji!");
        }
        $img = filter_input(INPUT_POST, "img");
        $proizvodMaper = new Application_Model_ProizvodiM();
        $podaci = $proizvodMaper->fetchAll('slikam ="' . $img . '"', NULL, NULL);
        $this->view->podaci = $podaci;
    }

    public function mojePorudzbineAction()
    {
        $this->view->headTitle()->append('Moje porudžbine');
        $autentifikacija = Zend_Auth::getInstance();
        $korisnik = $autentifikacija->getIdentity();
        $narudzbineM = new Application_Model_NarudzbineM();
        $sve = $narudzbineM->fetchAll('idKorisnika='.$korisnik->getIdKorisnika());
        $this->view->sve = $sve;
    }


}


