<?php

class Application_Form_Proizvod extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        $naziv = new Zend_Form_Element_Text('tbNaziv');
        $naziv->setLabel('Naziv:');
        $naziv->class = 'txt_field';
        $naziv->setRequired(true);
        $naziv->addValidator('NotEmpty')->addErrorMessage('Polje naziv ne sme biti prazno.');
        $naziv->addFilter('HTMLEntities');
        $naziv->addFilter('StringTrim');
        
        $kategorijeM=new Application_Model_KategorijeM();
        $kategorije=$kategorijeM->fetchAll(null,null,null);
        $ddlKategorije = new Zend_Form_Element_Select('ddlKategorije');
        $ddlKategorije->setLabel('Kategorija:')->setRequired(TRUE);
        $ddlKategorije->class = 'txt_field';
        foreach($kategorije as $kategorija){
            $ddlKategorije->addMultiOption($kategorija->getId(),$kategorija->getPunNaziv());
        }
        
        $slikam=new Zend_Form_Element_Text('slikam');
        $slikam->class = 'txt_field';
        $slikam->setLabel('Slika mala:')->setRequired('TRUE')->addValidator('NotEmpty')->addFilter('StringTrim');
        $slikam->setValue('Slika mora posebno zbog dekoratora koji pravi problem!');
        
        $slikav=new Zend_Form_Element_Text('slikav');
        $slikav->class = 'txt_field';
        $slikav->setLabel('Slika velika:')->setRequired('TRUE')->addValidator('NotEmpty')->addFilter('StringTrim');
        $slikav->setValue('Slika mora posebno zbog dekoratora koji pravi problem!');

        $cena = new Zend_Form_Element_Text('tbCena');
        $cena->setLabel('Cena:');
        $cena->class = 'txt_field';
        $cena->setRequired(true);
        $cena->addValidator('NotEmpty')->addErrorMessage('Polje cena ne sme biti prazno.');
        $cena->addFilter('HTMLEntities');
        $cena->addFilter('StringTrim');
        
        $boja = new Zend_Form_Element_Text('tbBoja');
        $boja->setLabel('Boja:');
        $boja->class = 'txt_field';
        $boja->addFilter('HTMLEntities');
        $boja->addFilter('StringTrim');
        
        $brava = new Zend_Form_Element_Text('tbBrava');
        $brava->setLabel('Brava:');
        $brava->class = 'txt_field';
        $brava->addFilter('HTMLEntities');
        $brava->addFilter('StringTrim');
        
        $text = new Zend_Form_Element_Textarea('taOpis');
        $text->setLabel('Opis:');
        $text->class = 'txt_field';
        $text->addFilter('HTMLEntities');
        $text->addFilter('StringTrim');
        
        $tip = new Zend_Form_Element_Text('tbTip');
        $tip->setLabel('Tip:');
        $tip->class = 'txt_field';
        $tip->addFilter('HTMLEntities');
        $tip->addFilter('StringTrim');
        
        $vs = new Zend_Form_Element_Text('tbVS');
        $vs->setLabel('Spoljašnja visina:');
        $vs->class = 'txt_field';
        $vs->setRequired(true);
        $vs->addValidator('NotEmpty')->addErrorMessage('Polje vs ne sme biti prazno.');
        $vs->addFilter('HTMLEntities');
        $vs->addFilter('StringTrim');
        
        $ss = new Zend_Form_Element_Text('tbSS');
        $ss->setLabel('Spoljašnja širina:');
        $ss->class = 'txt_field';
        $ss->setRequired(true);
        $ss->addValidator('NotEmpty')->addErrorMessage('Polje ss ne sme biti prazno.');
        $ss->addFilter('HTMLEntities');
        $ss->addFilter('StringTrim');
        
        $ds = new Zend_Form_Element_Text('tbDS');
        $ds->setLabel('Spoljašnja dužina:');
        $ds->class = 'txt_field';
        $ds->setRequired(true);
        $ds->addValidator('NotEmpty')->addErrorMessage('Polje ds ne sme biti prazno.');
        $ds->addFilter('HTMLEntities');
        $ds->addFilter('StringTrim');
        
        $vu = new Zend_Form_Element_Text('tbVU');
        $vu->setLabel('Unutrašnja visina:');
        $vu->class = 'txt_field';
        $vu->addFilter('HTMLEntities');
        $vu->addFilter('StringTrim');
        
        $su = new Zend_Form_Element_Text('tbSU');
        $su->setLabel('Unutrašnja širina:');
        $su->class = 'txt_field';
        $su->addFilter('HTMLEntities');
        $su->addFilter('StringTrim');
        
        $du = new Zend_Form_Element_Text('tbDU');
        $du->setLabel('Unutrašnja dužina:');
        $du->class = 'txt_field';
        $du->addFilter('HTMLEntities');
        $du->addFilter('StringTrim');
        
        $police = new Zend_Form_Element_Text('tbPolice');
        $police->setLabel('Police:');
        $police->class = 'txt_field';
        $police->addFilter('HTMLEntities');
        $police->addFilter('StringTrim');
        
        $tezina = new Zend_Form_Element_Text('tbTezina');
        $tezina->setLabel('Težina:');
        $tezina->class = 'txt_field';
        $tezina->setRequired(true);
        $tezina->addValidator('NotEmpty')->addErrorMessage('Polje težina ne sme biti prazno.');
        $tezina->addFilter('HTMLEntities');
        $tezina->addFilter('StringTrim');
        
        $zapremina = new Zend_Form_Element_Text('tbZapremina');
        $zapremina->setLabel('Zapremina:');
        $zapremina->class = 'txt_field';
        $zapremina->addFilter('HTMLEntities');
        $zapremina->addFilter('StringTrim');
        
        $uBrava = new Zend_Form_Element_Text('tbUBrava');
        $uBrava->setLabel('Unutrašnja brava:');
        $uBrava->class = 'txt_field';
        $uBrava->addFilter('HTMLEntities');
        $uBrava->addFilter('StringTrim');
        
        $zab = new Zend_Form_Element_Text('tbZabravljivanje');
        $zab->setLabel('Zabravljivanje:');
        $zab->class = 'txt_field';
        $zab->addFilter('HTMLEntities');
        $zab->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('btnSubmit');
        $submit->setLabel('Pošalji');
        $submit->class = 'sub_btn';
        
        $this->addElements(array($naziv,$ddlKategorije,$slikam,$slikav,$cena,$boja,$brava,$text,$tip,$vs,$ss,$ds,$vu,$su,$du,$police,$tezina,$zapremina,$uBrava,$zab,$submit));
        
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
            array('Fieldset', array('legend' => 'Proizvod'))
        ));
    }

}

