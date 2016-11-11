<?php

class Application_Form_Registracija extends Zend_Form {

    public function init() {
        $this->setAction('registracija')->setMethod('post');
        
        $username = new Zend_Form_Element_Text('tbKorisnickoIme');
        $username->setLabel('Korisničko ime:');
        $username->class = 'txt_field';
        $username->setRequired(true);
        $username->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'))->addErrorMessage('Korisničko ime nije u dobrom formatu!');
        $username->addFilter('StringToLower');
        $username->addFilter('StringTrim');
        $username->addFilter('HTMLEntities');

        $password = new Zend_Form_Element_Password('tbLozinka');
        $password->setLabel('Lozinka:');
        $password->class = 'txt_field';
        $password->setRequired(true);
        $password->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'))->addErrorMessage('Lozinka nije u dobrom formatu!');        
        
        $password2 = new Zend_Form_Element_Password('tbLozinka2');
        $password2->setLabel('Ponovite lozinku:');
        $password2->class = 'txt_field';
        $password2->setRequired(true);
        $password2->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'))->addErrorMessage('Lozinka nije u dobrom formatu!');
        
        $email = new Zend_Form_Element_Text('tbEmail');
        $email->setLabel('Email:');
        $email->class = 'txt_field';
        $email->setRequired(true);
        $email->addValidator('EmailAddress')->addErrorMessage('Email nije u dobrom formatu.');
        $email->addFilter('HTMLEntities');
        $email->addFilter('StringToLower');
        $email->addFilter('StringTrim');
        
        $mob = new Zend_Form_Element_Text('tbMobilni');
        $mob->setLabel('Broj mobilnog:');
        $mob->class = 'txt_field';
        $mob->setRequired(true);
        $mob->addValidator('regex', false, array('/^[0-9]{9,10}$/'))->addErrorMessage('Broj mobilnog nije u dobrom formatu!');
        $mob->addFilter('HTMLEntities');
        $mob->addFilter('StringTrim');

        $submit = new Zend_Form_Element_Submit('btnRegistracija');
        $submit->setLabel('Registracija');
        $submit->class = 'sub_btn';

        $this->addElement($username);
        $this->addElement($password);
        $this->addElement($password2);
        $this->addElement($email);
        $this->addElement($mob);
        $this->addElement($submit);

        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'),array('tag' => 'td', 'class'=>'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $submit->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),array('tag' => 'td','class'=>'element')),
            array(array('emptyrow' => 'HtmlTag'), array('tag' => 'td','class'=>'element', 'placement' => 'PREPEND')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $this->setDecorators(array('FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
            array('Fieldset', array('legend' => 'Registracija'))
        ));
    }

}
