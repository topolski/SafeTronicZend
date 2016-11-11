<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initPlaceholders() {
        $this->bootstrap("view");
        $view = $this->getResource("view");
        $view->headTitle("Sefovi Safetronics")->setSeparator(" :: ");
        $view->headLink()->prependStylesheet("/css/templatemo_style.css")
                ->headLink()->appendStylesheet("/css/ddsmoothmenu.css")
                ->headLink()->appendStylesheet("/css/jquery.dualSlider.0.2.css");
        $view->headScript()->prependFile("/js/jquery.min.js")
                ->headScript()->appendFile("/js/ddsmoothmenu.js")
                ->headScript()->appendFile("/js/jquery-1.3.2.min.js")
                ->headScript()->appendFile("/js/jquery.easing.1.3.js")
                ->headScript()->appendFile("/js/jquery.timers-1.2.js")
                ->headScript()->appendFile("/js/jquery.dualSlider.0.3.min.js");
    }

    protected function _initSlajder() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->placeholder('slajder');
        $view->placeholder('slajderjs');
    }

    protected function _initKorpa() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->placeholder('korpa');
    }

    protected function _initAnketa() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->placeholder('anketajs');
        $view->placeholder('anketa');
    }

    protected function _initStranicenje() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->placeholder('stranicenje');
    }

    protected function _initLightBox() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->placeholder('lbox');
    }

    protected function _initRoutes() {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();

        $routeNaslovna = new Zend_Controller_Router_Route_Static('naslovna', array('controller' => 'Index', 'action' => 'index'));
        $router->addRoute('naslovna', $routeNaslovna);

        $routeProizvodi = new Zend_Controller_Router_Route('proizvodi/:b', array('controller' => 'Proizvodi', 'action' => 'kategorija', 'b' => ''), array('b' => '[0-9]{1,2}'));
        $router->addRoute('proizvodi', $routeProizvodi);

        $routeProizvodiSvi = new Zend_Controller_Router_Route('proizvodiSvi', array('controller' => 'Proizvodi', 'action' => 'index'));
        $router->addRoute('proizvodiSvi', $routeProizvodiSvi);

        $routeSveVesti = new Zend_Controller_Router_Route('vesti', array('controller' => 'Vesti', 'action' => 'index'));
        $router->addRoute('SveVesti', $routeSveVesti);

        $routeAutor = new Zend_Controller_Router_Route('autor', array('controller' => 'Formulari', 'action' => 'autor'));
        $router->addRoute('autor', $routeAutor);

        $routeKontakt = new Zend_Controller_Router_Route('kontakt', array('controller' => 'Formulari', 'action' => 'kontakt'));
        $router->addRoute('kontakt', $routeKontakt);

        $routeLogovanje = new Zend_Controller_Router_Route('logovanje', array('controller' => 'Formulari', 'action' => 'logovanje'));
        $router->addRoute('logovanje', $routeLogovanje);

        $routeRegistracija = new Zend_Controller_Router_Route('registracija', array('controller' => 'Formulari', 'action' => 'registracija'));
        $router->addRoute('registracija', $routeRegistracija);

        $routeLogout = new Zend_Controller_Router_Route('logout', array('controller' => 'Formulari', 'action' => 'logout'));
        $router->addRoute('logout', $routeLogout);

        $routeDetalji = new Zend_Controller_Router_Route('detalji/:b/:p', array('controller' => 'Proizvodi', 'action' => 'detalji', 'b' => '', 'p' => ''), array('b' => '[0-9]{1,2}', 'p' => '[0-9]{1,2}'));
        $router->addRoute('detalji', $routeDetalji);

        $routePretraga = new Zend_Controller_Router_Route('pretraga', array('controller' => 'Index', 'action' => 'pretraga'));
        $router->addRoute('pretraga', $routePretraga);

        $routeAdmin = new Zend_Controller_Router_Route('administracija', array('controller' => 'Administracija', 'action' => 'index'));
        $router->addRoute('administracija', $routeAdmin);

        $routeKupovina = new Zend_Controller_Router_Route('kupovina', array('controller' => 'Kupovina', 'action' => 'index'));
        $router->addRoute('kupovina', $routeKupovina);

        $routePorudzbine = new Zend_Controller_Router_Route('poruceno', array('controller' => 'Kupovina', 'action' => 'moje-porudzbine'));
        $router->addRoute('poruceno', $routePorudzbine);

        $routeProizvod = new Zend_Controller_Router_Route('proizvod/:a/:b', array('controller' => 'Administracija', 'action' => 'proizvodi', 'a' => '', 'b' => ''), array('a' => '[1-4]{1}', 'b' => '[0-9]{1,2}'));
        $router->addRoute('proizvod', $routeProizvod);

        $routeKategorija = new Zend_Controller_Router_Route('kategorija/:a/:b', array('controller' => 'Administracija', 'action' => 'kategorije', 'a' => '', 'b' => ''), array('a' => '[1-3]{1}', 'b' => '[0-9]{1,2}'));
        $router->addRoute('kategorija', $routeKategorija);

        $routeKorisnik = new Zend_Controller_Router_Route('korisnik/:a/:b', array('controller' => 'Administracija', 'action' => 'korisnici', 'a' => '', 'b' => ''), array('a' => '[1-2]{1}', 'b' => '[0-9]{1,2}'));
        $router->addRoute('korisnik', $routeKorisnik);

        $routeNarudzbina = new Zend_Controller_Router_Route('narudzbina/:a/:b', array('controller' => 'Administracija', 'action' => 'narudzbine', 'a' => '', 'b' => ''), array('a' => '[1-2]{1}', 'b' => '[0-9]{1,2}'));
        $router->addRoute('narudzbina', $routeNarudzbina);
    }

}
