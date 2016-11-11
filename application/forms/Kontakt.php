<?php

class Application_Form_Kontakt extends Zend_Form {

    public function init() {
        $this->setAction('kontakt')->setMethod('post');
        
        $autor = new Zend_Form_Element_Text('tbAutor');
        $autor->setLabel('Ime:');
        $autor->class = 'txt_field';
        $autor->setRequired(true);
        $autor->addValidator('NotEmpty')->addErrorMessage('Polje autor ne sme biti prazno.');
        $autor->addFilter('HTMLEntities');
        $autor->addFilter('StringTrim');

        $email = new Zend_Form_Element_Text('tbEmail');
        $email->setLabel('Email:');
        $email->class = 'txt_field';
        $email->setRequired(true);
        $email->addValidator('EmailAddress')->addErrorMessage('Email nije u dobrom formatu.');
        $email->addFilter('HTMLEntities');
        $email->addFilter('StringToLower');
        $email->addFilter('StringTrim');
        
        $naslov = new Zend_Form_Element_Text('tbNaslov');
        $naslov->setLabel('Naslov:');
        $naslov->class = 'txt_field';
        $naslov->setRequired(true);
        $naslov->addValidator('NotEmpty')->addErrorMessage('Polje autor ne sme biti prazno.');
        $naslov->addFilter('HTMLEntities');
        $naslov->addFilter('StringTrim');

        $text = new Zend_Form_Element_Textarea('taSadrzaj');
        $text->setLabel('Sadržaj:');
        $text->setRequired(true);
        $text->addValidator('NotEmpty')->addErrorMessage('Polje za Poruku ne sme ostati prazno');
        $text->addFilter('HTMLEntities');
        $text->addFilter('StringToLower');
        $text->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('btnSubmit');
        $submit->setLabel('Pošalji');
        $submit->class = 'sub_btn';
        
        $this->addElements(array($autor,$email,$naslov,$text,$submit));
        
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
            array('Fieldset', array('legend' => 'Kontakt forma'))
        ));
    }

}
