<?php

class Application_Form_AdminIzbor extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        $proizvodiM=new Application_Model_ProizvodiM();
        $proizvodi=$proizvodiM->fetchAll(null,null,null);
        $za = new Zend_Form_Element_Select('ddlZa');
        $za->setLabel('Za proizvod:');
        $za->class = 'txt_field';
        $za->setRequired(true);
        foreach($proizvodi as $proizvod){
            $za->addMultiOption($proizvod->getIdProizvoda(),$proizvod->getNaziv());
        }
        
        $slikam=new Zend_Form_Element_File('slikam');
        $slikam->class = 'txt_field';
        $slikam->setLabel('Slika mala:')->setRequired('TRUE')->addValidator('NotEmpty')->addFilter('StringTrim');
             
        $slikav=new Zend_Form_Element_File('slikav');
        $slikav->class = 'txt_field';
        $slikav->setLabel('Slika velika:')->setRequired('TRUE')->addValidator('NotEmpty')->addFilter('StringTrim');
        
        $submit = new Zend_Form_Element_Submit('btnDodaj');
        $submit->setLabel('Dodaj');
        $submit->class = 'sub_btn';
       
        $this->addElements(array($za,$slikam,$slikav,$submit));
        
        $submit->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'),array('tag' => 'td','class'=>'element')),
            array(array('emptyrow' => 'HtmlTag'), array('tag' => 'td','class'=>'element', 'placement' => 'PREPEND')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $this->setDecorators(array('FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
            array('Fieldset', array('legend' => 'Dodavanje slika za proizvod'))
        ));
    }


}

