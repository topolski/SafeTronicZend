<?php

class AdministracijaController extends Zend_Controller_Action {

    private $ulogovan = null;

    public function init() {
        $this->view->headTitle()->append('Administracija');
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        $korisnik = new Application_Model_KorisniciE();
        $korisnik = $autentifikacija->getIdentity();
        if (!$this->ulogovan || !in_array('Administrator', $korisnik->naziviUloga())) {
            $this->_redirect('/naslovna');
        }
    }

    public function indexAction() {
        $request = $this->getRequest();
        if ($request->isPost() && $adminIzbor->isValid($request->getPost())) {
            if ($adminIzbor->getValue("ddlZa") != 0) {
                print_r($adminIzbor->getValue("ddlZa"));
            }
        }
        $kategorijeM = new Application_Model_KategorijeM();
        $kategorije = $kategorijeM->fetchAll(null, null, null);
        $this->view->kategorije = $kategorije;
        $korisniciM = new Application_Model_KorisniciM();
        $korisnici = $korisniciM->fetchAll(NULL);
        $this->view->korisnici = $korisnici;
        $narudzbineM = new Application_Model_NarudzbineM();
        $narudzbine = $narudzbineM->fetchAll('poslato=0');
        $this->view->narudzbine = $narudzbine;
        $narudzbinep = $narudzbineM->fetchAll('poslato=1');
        $this->view->narudzbineposlate = $narudzbinep;
    }

    public function kategorijeAction() {
        $request = $this->getRequest();
        $akcija = $this->getRequest()->getParam('a');
        $idKategorije = $this->getRequest()->getParam('b');
        $kategorijeM = new Application_Model_KategorijeM();
        $poruka = "";
        $kategorijaForma = new Application_Form_Kategorija();
        $kategorija = new Application_Model_KategorijeE();
        switch ($akcija) {
            case 1:
                $this->view->forma = $kategorijaForma;
                if (!empty($idKategorije) && $request->isPost() && $kategorijaForma->isValid($request->getPost())) {
                    $kategorija->setId($idKategorije);
                    $kategorija->setPunNaziv($kategorijaForma->getValue('tbPNaziv'));
                    $kategorija->setKratakNaziv($kategorijaForma->getValue('tbKNaziv'));
                    $kategorijeM->save($kategorija);
                    $poruka = "Podaci o kategoriji su izmenjeni!";
                }
                if (!empty($idKategorije)) {
                    $kategorijeM->find($idKategorije, $kategorija);
                    $kategorijaForma->getElement('tbPNaziv')->setValue($kategorija->getPunNaziv());
                    $kategorijaForma->getElement('tbKNaziv')->setValue($kategorija->getKratakNaziv());
                    $kategorijaForma->setAction('/kategorija/1/' . $idKategorije);
                    $kategorijaForma->getElement('btnSubmit')->setLabel('Izmeni');
                }
                break;

            case 2:
                $kategorijeM->delete($idKategorije);
                $poruka = "Kategorija je obrisana!";
                break;
            case 3:
                $this->view->forma = $kategorijaForma;
                if ($request->isPost() && $kategorijaForma->isValid($request->getPost())) {
                    $kategorija->setPunNaziv($kategorijaForma->getValue('tbPNaziv'));
                    $kategorija->setKratakNaziv($kategorijaForma->getValue('tbKNaziv'));
                    $kategorijeM->save($kategorija);
                    $poruka = "Kategorija je dodata!";
                }
                break;
        }
        $this->view->poruka = $poruka;
    }

    public function proizvodiAction() {
        $request = $this->getRequest();
        $akcija = $this->getRequest()->getParam('a');
        $idProizvoda = $this->getRequest()->getParam('b');
        $proizvodM = new Application_Model_ProizvodiM();
        $poruka = "";
        $proizvodForma = new Application_Form_Proizvod();
        $proizvod = new Application_Model_ProizvodiE();
        switch ($akcija) {
            case 1:
                $this->view->forma = $proizvodForma;
                if (!empty($idProizvoda) && $request->isPost() && $proizvodForma->isValid($request->getPost())) {
                    $proizvod->setIdProizvoda($idProizvoda);
                    $proizvod->setNaziv($proizvodForma->getValue('tbNaziv'));
                    $proizvod->setIdKategorije($proizvodForma->getValue('ddlKategorije'));
                    $proizvod->setSlikam($proizvodForma->getValue('slikam'));
                    $proizvod->setSlikav($proizvodForma->getValue('slikav'));
                    $proizvod->setCena($proizvodForma->getValue('tbCena'));
                    $proizvod->setBoja($proizvodForma->getValue('tbBoja'));
                    $proizvod->setBrava($proizvodForma->getValue('tbBrava'));
                    $proizvod->setOpis($proizvodForma->getValue('taOpis'));
                    $proizvod->setTip($proizvodForma->getValue('tbTip'));
                    $proizvod->setVS($proizvodForma->getValue('tbVS'));
                    $proizvod->setSS($proizvodForma->getValue('tbSS'));
                    $proizvod->setDS($proizvodForma->getValue('tbDS'));
                    $proizvod->setVU($proizvodForma->getValue('tbVU'));
                    $proizvod->setSU($proizvodForma->getValue('tbSU'));
                    $proizvod->setDU($proizvodForma->getValue('tbDU'));
                    $proizvod->setPolice($proizvodForma->getValue('tbPolice'));
                    $proizvod->setTezina($proizvodForma->getValue('tbTezina'));
                    $proizvod->setZapremina($proizvodForma->getValue('tbZapremina'));
                    $proizvod->setUnutrasnjaBrava($proizvodForma->getValue('tbUBrava'));
                    $proizvod->setZabravljivanje($proizvodForma->getValue('tbZabravljivanje'));
                    $proizvodM->save($proizvod);
                    $poruka = "Podaci o proizvodu su izmenjeni!";
                }
                if (!empty($idProizvoda)) {
                    $proizvodM->find($idProizvoda, $proizvod);

                    $proizvodForma->getElement('tbNaziv')->setValue($proizvod->getNaziv());
                    $proizvodForma->getElement('ddlKategorije')->setValue($proizvod->getIdKategorije());
                    $proizvodForma->getElement('slikam')->setValue($proizvod->getSlikam());
                    $proizvodForma->getElement('slikav')->setValue($proizvod->getSlikav());
                    $proizvodForma->getElement('tbCena')->setValue($proizvod->getCena());
                    $proizvodForma->getElement('tbBoja')->setValue($proizvod->getBoja());
                    $proizvodForma->getElement('tbBrava')->setValue($proizvod->getBrava());
                    $proizvodForma->getElement('taOpis')->setValue($proizvod->getOpis());
                    $proizvodForma->getElement('tbTip')->setValue($proizvod->getTip());
                    $proizvodForma->getElement('tbVS')->setValue($proizvod->getVS());
                    $proizvodForma->getElement('tbSS')->setValue($proizvod->getSS());
                    $proizvodForma->getElement('tbDS')->setValue($proizvod->getDS());
                    $proizvodForma->getElement('tbVU')->setValue($proizvod->getVU());
                    $proizvodForma->getElement('tbSU')->setValue($proizvod->getSU());
                    $proizvodForma->getElement('tbDU')->setValue($proizvod->getDU());
                    $proizvodForma->getElement('tbPolice')->setValue($proizvod->getPolice());
                    $proizvodForma->getElement('tbTezina')->setValue($proizvod->getTezina());
                    $proizvodForma->getElement('tbZapremina')->setValue($proizvod->getZapremina());
                    $proizvodForma->getElement('tbUBrava')->setValue($proizvod->getUnutrasnjaBrava());
                    $proizvodForma->getElement('tbZabravljivanje')->setValue($proizvod->getZabravljivanje());
                    $proizvodForma->setAction('/proizvod/1/' . $idProizvoda);
                    $proizvodForma->getElement('btnSubmit')->setLabel('Izmeni');
                }
                break;

            case 2:
                $proizvodM->delete($idProizvoda);
                $poruka = "Proizvod je obrisan!";
                break;
            case 3:
                $this->view->forma = $proizvodForma;
                if ($request->isPost() && $proizvodForma->isValid($request->getPost())) {
                    $proizvod->setNaziv($proizvodForma->getValue('tbNaziv'));
                    $proizvod->setIdKategorije($proizvodForma->getValue('ddlKategorije'));
                    $proizvod->setSlikam($proizvodForma->getValue('slikam'));
                    $proizvod->setSlikav($proizvodForma->getValue('slikav'));
                    $proizvod->setCena($proizvodForma->getValue('tbCena'));
                    $proizvod->setBoja($proizvodForma->getValue('tbBoja'));
                    $proizvod->setBrava($proizvodForma->getValue('tbBrava'));
                    $proizvod->setOpis($proizvodForma->getValue('taOpis'));
                    $proizvod->setTip($proizvodForma->getValue('tbTip'));
                    $proizvod->setVS($proizvodForma->getValue('tbVS'));
                    $proizvod->setSS($proizvodForma->getValue('tbSS'));
                    $proizvod->setDS($proizvodForma->getValue('tbDS'));
                    $proizvod->setVU($proizvodForma->getValue('tbVU'));
                    $proizvod->setSU($proizvodForma->getValue('tbSU'));
                    $proizvod->setDU($proizvodForma->getValue('tbDU'));
                    $proizvod->setDatum(date('Y-m-d H:i:s'));
                    $proizvod->setPolice($proizvodForma->getValue('tbPolice'));
                    $proizvod->setTezina($proizvodForma->getValue('tbTezina'));
                    $proizvod->setZapremina($proizvodForma->getValue('tbZapremina'));
                    $proizvod->setUnutrasnjaBrava($proizvodForma->getValue('tbUBrava'));
                    $proizvod->setZabravljivanje($proizvodForma->getValue('tbZabravljivanje'));
                    $proizvodM->save($proizvod);
                    $poruka = "Proizvod je dodat!";
                }
                break;
            case 4:
                $slike = new Application_Form_AdminIzbor();
                $this->view->formaSlika = $slike;
                $fileDirectory = APPLICATION_PATH . '/../public/images/product/';
                if ($request->isPost() && $slike->isValid($request->getPost())) {
                    $upload = new Zend_File_Transfer_Adapter_Http();
                    if (!file_exists($fileDirectory)) {
                        mkdir($fileDirectory);
                    }
                    $imeFajla = $upload->getFileName();
                    $podacim = explode('.', $imeFajla['slikam']);
                    $ekstenzijam = $podacim[1];
                    $podaciNazivm = explode("\\",$podacim[0]);
                    $nazivm = $podaciNazivm[count($podaciNazivm)-1];
                    $podaciv = explode('.', $imeFajla['slikav']);
                    $ekstenzijav = $podaciv[1];
                    $podaciNazivv = explode("\\",$podaciv[0]);
                    $nazivv = $podaciNazivv[count($podaciNazivv)-1];
                    $upload->setDestination($fileDirectory . '/');
                    $upload->addValidator('Extension', false, array('jpg', 'png', 'gif', 'jpeg'));
                    $upload->setOptions(array('useByteString' => FALSE));
                    if ($upload->receive()) {
                        print_r($slike->getValue('slikam'));
                        $proizvod->setIdProizvoda($slike->getValue('ddlZa'));
                        $proizvod->setSlikam('/images/product/'.$nazivm.'.'.$ekstenzijam);
                        $proizvod->setSlikav('/images/product/'.$nazivv.'.'.$ekstenzijav);
                        $proizvodM->save($proizvod);
                        $poruka = "Slike za proizvod su dodate!";
                    }
                }
                break;
        }
        $this->view->poruka = $poruka;
    }

    public function korisniciAction() {
        $akcija = $this->getRequest()->getParam('a');
        $idKorisnika = $this->getRequest()->getParam('b');
        $korisniciM = new Application_Model_KorisniciM();
        $poruka = "";
        switch ($akcija) {
            case 2:
                $korisniciM->delete($idKorisnika);
                $poruka = "Korisnik je obrisan!";
                break;
        }
        $this->view->poruka = $poruka;
    }

    public function narudzbineAction() {
        $akcija = $this->getRequest()->getParam('a');
        $idNarudzbine = $this->getRequest()->getParam('b');
        $narudzbineM = new Application_Model_NarudzbineM();
        $poruka = "";
        switch ($akcija) {
            case 2:
                $narudzbineM->delete($idNarudzbine);
                $poruka = "Narudzbina je obrisana!";
                break;
        }
        $this->view->poruka = $poruka;
    }

}
