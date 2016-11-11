<?php

class ProizvodiController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Proizvodi');
        $layout = $this->_helper->layout();
        $layout->link1 = '';
        $layout->link2 = 'class="selected"';
        $layout->link3 = '';
        $layout->link4 = '';
    }

    public function indexAction() {
        $proizvodiMaper = new Application_Model_ProizvodiM();
        $proizvodi = $proizvodiMaper->fetchAll(NULL,NULL,NULL);
        $this->view->proizvodi = $proizvodi;
    }

    public function kategorijaAction() {
        $idKategorije = $this->getRequest()->getParam('b');
        $kategorijeMaper = new Application_Model_KategorijeM();
        $kategorija = $kategorijeMaper->fetchAll('idKategorije =' . $idKategorije, NULL, NULL);
        $proizvodiMaper = new Application_Model_ProizvodiM();
        $proizvodi = $proizvodiMaper->fetchAll('idKategorije = ' . $idKategorije, NULL, NULL);
        $this->view->proizvodi = $proizvodi;
        $this->view->nazivkategorije = $kategorija[0]->getPunNaziv();
    }

    public function detaljiAction() {
        $this->view->render('dodatno/_lightBox.phtml');
        $idKategorije = $this->getRequest()->getParam('b');
        $kategorijeMaper = new Application_Model_KategorijeM();
        $kategorija = $kategorijeMaper->fetchAll('idKategorije =' . $idKategorije, NULL, NULL);
        $idProizvoda = $this->getRequest()->getParam('p');
        $proizvodiMaper = new Application_Model_ProizvodiM();
        $proizvod = $proizvodiMaper->fetchAll('idProizvoda = ' . $idProizvoda, NULL, NULL);
        $proizvodi = $proizvodiMaper->fetchAll('idKategorije='.$idKategorije, 'Datum DESC', 3);       
        $this->view->proizvod = $proizvod;
        $this->view->kategorija = $kategorija[0]->getPunNaziv();
        $this->view->proizvodiizkategorije = $proizvodi;
    }

}
