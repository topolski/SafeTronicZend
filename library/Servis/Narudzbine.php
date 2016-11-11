<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Narudzbine
 *
 * @author Milanko
 */
class Servis_Narudzbine {

    /**
     * Vraća listu narudžbina iz baze
     * 
     * @return array
     */
    public function listaNarudzbina() {
        $narudzbineMapper = new Application_Model_NarudzbineM();
        $narudzbine = $narudzbineMapper->fetchAll('poslato=0');
        $podaci = array();
        foreach ($narudzbine as $narudzbina) {
            $korisnik = $narudzbina->getKorisnika();
            $kime = $korisnik['korisnickoIme'];
            $brmob = $korisnik['mobilni'];
            $podaci[] = array(
                'datum' => $narudzbina->getDatum(),
                'kupac' => $kime,
                'brmob' => $brmob,
                'ukupno' => $narudzbina->getCena(),
                'id' => $narudzbina->getIdNarudzbine()
            );
        }
        return $podaci;
    }
    
    /**
     * Vraća detalje narudžbine
     * 
     * @param int $id
     * @return array
     */
    public function detaljiNarudzbine($id) {
        $narudzbineMapper = new Application_Model_NarudzbineM();
        $narudzbina = $narudzbineMapper->fetchAll("idNarudzbine =".$id);
        $podaci = array();
        foreach($narudzbina as $n){
            $korisnik = $n->getKorisnika();
            $kime = $korisnik['korisnickoIme'];
            $brmob = $korisnik['mobilni'];
            $podaci[] = array(
                'datum'=>$n->getDatum(),
                'kupac'=>$kime,
                'brmob' => $brmob,
                'ukupno' => $n->getCena(),
                'naziviProizvoda'=>$n->naziviProizvoda(),
                'ceneProizvoda'=>$n->cenaProizvoda(),
                'kolicina'=>$n->getKolicina(),
                'boja'=>$n->getBoja(),
                'id' => $n->getIdNarudzbine(),
                'poslato' => $n->getPoslato()
            );
        }
        return $podaci;
    }
    
    /**
     * Ažurira narudžbinu
     * 
     * @param int $id
     */
    public function posaljiNarudzbinu($id) {
        $narudzbineMapper = new Application_Model_NarudzbineM();
        $narudzbina = new Application_Model_NarudzbineE();
        $narudzbina->setIdNarudzbine($id);
        $narudzbina->setPoslato(1);
        $narudzbina->setDatumP(time());
        $narudzbineMapper->save($narudzbina);
    }
    
    /**
     * Vraća listu poslatih narudžbina
     * 
     * @return array
     */
    public function listaPoslatihNarudzbina() {
        $narudzbineMapper = new Application_Model_NarudzbineM();
        $narudzbine = $narudzbineMapper->fetchAll('poslato=1');
        $podaci = array();
        foreach ($narudzbine as $narudzbina) {
            $korisnik = $narudzbina->getKorisnika();
            $kime = $korisnik['korisnickoIme'];
            $brmob = $korisnik['mobilni'];
            $podaci[] = array(
                'datum' => $narudzbina->getDatum(),
                'kupac' => $kime,
                'brmob' => $brmob,
                'ukupno' => $narudzbina->getCena(),
                'id' => $narudzbina->getIdNarudzbine(),
                'datumP' => $narudzbina->getDatumP()
            );
        }
        return $podaci;
    }

}
