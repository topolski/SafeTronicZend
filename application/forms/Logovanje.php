<?php

class Application_Form_Logovanje extends Zend_Form {

    public function init() {
        $this->setAction('logovanje')->setMethod('post');
        
        $username = new Zend_Form_Element_Text('tbKorisnickoIme');
        $username->setLabel('Korisničko ime:');
        $username->class = 'txt_field';
        $username->setRequired(true);
        $username->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'))->addErrorMessage('Korisničko ime nije u dobrom formatu!');

        $password = new Zend_Form_Element_Password('tbLozinka');
        $password->setLabel('Lozinka:');
        $password->class = 'txt_field';
        $password->setRequired(true);
        $password->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'))->addErrorMessage('Lozinka nije u dobrom formatu!');

        $submit = new Zend_Form_Element_Submit('btnLogin');
        $submit->setLabel('Ulogujte se');
        $submit->class = 'sub_btn';

        $this->addElement($username);
        $this->addElement($password);
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
            array('Fieldset', array('legend' => 'Logovanje'))
        ));
    }

}
