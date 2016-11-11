<?php

class Application_Form_Kategorija extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        $PNaziv = new Zend_Form_Element_Text('tbPNaziv');
        $PNaziv->setLabel('Pun naziv kategorije:');
        $PNaziv->class = 'txt_field';
        $PNaziv->setRequired(true);
        $PNaziv->addValidator('NotEmpty')->addErrorMessage('Pun naziv kategorije nije u dobrom formatu!');
        $PNaziv->addFilter('HTMLEntities');
        $PNaziv->addFilter('StringTrim');

        $KNaziv = new Zend_Form_Element_Text('tbKNaziv');
        $KNaziv->setLabel('Kratak naziv kategorije:');
        $KNaziv->class = 'txt_field';
        $KNaziv->setRequired(true);
        $KNaziv->addValidator('NotEmpty')->addErrorMessage('Kratak naziv kategorije nije u dobrom formatu!');
        $KNaziv->addFilter('HTMLEntities');
        $KNaziv->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('btnSubmit');
        $submit->setLabel('Dodaj');
        $submit->class = 'sub_btn';

        $this->addElement($PNaziv);
        $this->addElement($KNaziv);
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
            array('Fieldset', array('legend' => 'Kategorija'))
        ));
    }


}

