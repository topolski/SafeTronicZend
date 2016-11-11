<?php

class FormulariController extends Zend_Controller_Action {

    private $ulogovan = null;

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function logovanjeAction() {
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        if ($this->ulogovan) {
            $this->_redirect('/naslovna');
        }
        $request = $this->getRequest();
        $this->view->headTitle()->append('Logovanje');
        $login = new Application_Form_Logovanje();
        $this->view->forma = $login;
        if ($request->isPost() && $login->isValid($request->getPost())) {
            $podaci = $login->getValues();
            $korisnickoIme = $podaci['tbKorisnickoIme'];
            $lozinka = sha1($podaci['tbLozinka']);
            $auth = Zend_Auth::getInstance();
            $korisnik = new Application_Model_DbTable_Korisnici();
            $authAdapter = new Zend_Auth_Adapter_DbTable($korisnik->getAdapter(), 'korisnici');
            $authAdapter->setIdentityColumn('korisnickoIme')->setCredentialColumn('lozinka');
            $authAdapter->setIdentity($korisnickoIme)->setCredential($lozinka);
            $result = $auth->authenticate($authAdapter);
            if ($result->isValid()) {
                $sesija = new Zend_Auth_Storage_Session();
                $data = $authAdapter->getResultRowObject(null, 'lozinka');
                $korisniciMapper = new Application_Model_KorisniciM();
                $registrovaniKorisnik = new Application_Model_KorisniciE();
                $korisniciMapper->accessTime($data->idKorisnika);
                $korisniciMapper->find($data->idKorisnika, $registrovaniKorisnik);
                $sesija->write($registrovaniKorisnik);
                if (in_array('Administrator', $registrovaniKorisnik->naziviUloga())) {
                    $this->_redirect('/administracija');
                } else {
                    $this->_redirect('/kupovina');
                }
            } else {
                $this->view->greska = 'Korisnik sa tim podacima nije registrovan!';
            }
        }
    }

    public function kontaktAction() {
        $request = $this->getRequest();
        $this->view->headTitle()->append('Kontakt');
        $layout = $this->_helper->layout();
        $layout->link1 = '';
        $layout->link2 = '';
        $layout->link3 = '';
        $layout->link4 = 'class="selected"';
        $kontakt = new Application_Form_Kontakt();
        if ($request->isPost() && $kontakt->isValid($request->getPost())) {
            $config = array(
                'ssl' => 'tls',
                'port' => 587,
                'auth' => 'login',
                'username' => 'tope1991@gmail.com',
                'password' => 'lozinka'
            );
            $tr = new Zend_Mail_Transport_Sendmail('smtp.gmail.com', $config);
            Zend_Mail::setDefaultTransport($tr);
            $mail = new Zend_Mail();
            $mail->setBodyText($kontakt->getValue('tbNaslov'), $kontakt->getValue('taSadrzaj'));
            $mail->setFrom($kontakt->getValue('tbEmail'), $kontakt->getValue('tbAutor'));
            $mail->addTo('tope1991@gmail.com', 'test');
            $mail->setSubject('Kontakt forma sajta');
            $mail->send();
            $kontakt->reset();
        }
        $this->view->forma = $kontakt;
    }

    public function autorAction() {
        $this->view->headTitle()->append('Autor');
        $layout = $this->_helper->layout();
        $layout->link1 = '';
        $layout->link2 = '';
        $layout->link3 = 'class="selected"';
        $layout->link4 = '';
    }

    public function logoutAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        if ($this->ulogovan) {
            $sesija = new Zend_Auth_Storage_Session();
            $sesija->clear();
        }
        $this->_redirect('/naslovna');
    }

    public function registracijaAction() {
        $autentifikacija = Zend_Auth::getInstance();
        $this->ulogovan = $autentifikacija->hasIdentity();
        if ($this->ulogovan) {
            $this->_redirect('/naslovna');
        }
        $request = $this->getRequest();
        $this->view->headTitle()->append('Registracija');
        $registracija = new Application_Form_Registracija();
        $greske = array();
        if ($request->isPost() && $registracija->isValid($request->getPost())) {
            $podaci = $registracija->getValues();
            $korisnickoIme = $podaci['tbKorisnickoIme'];
            $lozinka = $podaci['tbLozinka'];
            $lozinka2 = $podaci['tbLozinka2'];
            $email = $podaci['tbEmail'];
            $korisniciM = new Application_Model_KorisniciM();
            $korisniciubazi = $korisniciM->fetchAll("korisnickoIme = '".$korisnickoIme."' || mail = '".$email."'");
            if ($lozinka == $lozinka2) {
                if (count($korisniciubazi) == 0) {
                    $korisniciE = new Application_Model_KorisniciE();
                    $korisniciE->setKorisnickoIme($korisnickoIme);
                    $korisniciE->setLozinka($lozinka);
                    $korisniciE->setEmail($email);
                    $korisniciE->setMobilni($podaci['tbMobilni']);
                    $korisniciE->setVremeRegistracije(time());
                    $korisniciE->setVremePristupa(0);
                    $korisniciE->setStatus(1);
                    $korisniciM->save($korisniciE);
                    $this->_redirect("logovanje");
                } else {
                    $greske[] = "Postoji korisnik sa tim imenom ili email adresom!";
                }
            } else {
                $greske[] = "Lozinke se nisu poklopile!";
            }
        }
        $this->view->forma = $registracija;
        $this->view->greske = $greske;
    }

}
