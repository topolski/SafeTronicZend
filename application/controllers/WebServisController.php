<?php

class WebServisController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function soapAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $server = new Zend_Soap_Server(null, array('uri' => 'http://projekat.ict/WebServis/soap'));
        $server->setClass('Servis_Narudzbine');
        // register exceptions that generate SOAP faults
        //$server->registerFaultException(array('Servis_Exception'));
        $server->handle();
    }

    public function wsdlAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $wsdl = new Zend_Soap_AutoDiscover();
        $wsdl->setClass('Servis_Narudzbine');
        $wsdl->setUri('http://projekat.ict/WebServis/soap');
        $wsdl->handle();
    }

}
