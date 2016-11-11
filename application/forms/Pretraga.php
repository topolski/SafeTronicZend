<?php

class Application_Form_Pretraga extends Zend_Form {

    public function init() {
        $this->setAction('/pretraga')->setMethod('post');

        $naziv = new Zend_Form_Element_Text('tbRec');
        $naziv->class = "txt_field";
        $naziv->setValue("Pretraga");
        $naziv->setRequired(true);
        $naziv->addValidator('NotEmpty')->addErrorMessage('Polje za pretragu ne sme ostati prazno');
        $naziv->addValidator('regex', false, array('/^[A-Z]*[a-z]*[0-9]*$/'));
        $naziv->addFilter('HTMLEntities');
        $naziv->addFilter('StringToLower');
        $naziv->addFilter('StringTrim');
        $naziv->setAttribs(array('title' => 'Pretraga', 'onblur' => 'clearText(this)', 'onfocus' => 'clearText(this)'));

        $pretraga = new Zend_Form_Element_Submit('btnPretraga');
        $pretraga->class = "sub_btn";
        $pretraga->setLabel(' Pretraga ');
        $pretraga->setAttribs(array('alt' => 'Pretraga', 'title' => 'Pretraga'));

        $this->addElement($naziv);
        $this->addElement($pretraga);

        $this->setElementDecorators(array('ViewHelper','Errors'));
        $this->setDecorators(array('FormElements','Form'));
    }

}
