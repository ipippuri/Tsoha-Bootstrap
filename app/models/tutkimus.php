<?php

class Tutkimus extends BaseModel{
    public $tutkimusid, $kohdeid, $kohteenNimi, $kohteenPaikkakunta, $tutkijaid, 
            $paivamaara, $aistivarainen_tieto, $mittaustieto, $nayteet=array(),
            $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tutkimus 
            LEFT JOIN Kohde on Kohde.kohdeid=Tutkimus.kohdeid ORDER BY paivamaara DESC');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tutkimukset = array();
        
        foreach ($rows as $row) {
            $tutkimukset[] = new Tutkimus(array(
                'tutkimusid' => $row['tutkimusid'],
                'kohteenNimi' => $row['nimi'],
                'kohteenPaikkakunta' => $row['paikkakunta'],
                'tutkijaid' => $row['tutkijaid'],
                'paivamaara' => $row['paivamaara'],
                'aistivarainen_tieto' => $row['aistivarainen_tieto'],
                'mittaustieto' => $row['mittaustieto'],
            ));
        }
        
        return $tutkimukset;
    }
    
    
    public static function find($tutkimusid) {
        $query = DB::connection()->prepare('SELECT * FROM Tutkimus LEFT JOIN Kohde '
                . 'ON Kohde.kohdeid=Tutkimus.kohdeid WHERE tutkimusid = :tutkimusid');
        $query->execute(array('tutkimusid' => $tutkimusid));
        $row = $query->fetch();
        
        if($row) {
            $tutkimus = new Tutkimus(array(
                'tutkimusid' => $row['tutkimusid'],
                'kohdeid' => $row['kohdeid'],
                'kohteenNimi' => $row['nimi'],
                'kohteenPaikkakunta' => $row['paikkakunta'],
                'tutkijaid' => $row['tutkijaid'],
                'paivamaara' => $row['paivamaara'],
                'aistivarainen_tieto' => $row['aistivarainen_tieto'],
                'mittaustieto' => $row['mittaustieto']
            ));
            return $tutkimus;
        }
        
        return null;
    }
    
    public static function findWithNaytteet($tutkimusid) {
        $tutkimus = Tutkimus::find($tutkimusid);
        
        $query = DB::connection()->prepare('SELECT nayteid, nimi FROM Nayte WHERE '
            .'tutkimusid= :tutkimusid');
        $query->execute(array('tutkimusid' => $tutkimusid ));
        
        $rows = $query->fetchAll();
        $naytteet = array();
        
        foreach ($rows as $row) {
            $naytteet[] = new Nayte(array(
                'nayteid' => $row['nayteid'],
                'nimi' => $row['nimi'],
            ));
        }
        
        $tutkimus->naytteet = $naytteet;
        return $tutkimus;
    }
    
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) '
                . 'VALUES (:kohdeid, :tutkijaid, :paivamaara, :aistivarainen_tieto, :mittaustieto) RETURNING tutkimusid');
        $query->execute(array('kohdeid' => $this->kohdeid, 'tutkijaid' => $this->tutkijaid, 'paivamaara' => $this->paivamaara,
            'aistivarainen_tieto' => $this->aistivarainen_tieto, 'mittaustieto' => $this->mittaustieto));
        $row = $query->fetch();
        $this->tutkimusid = $row['tutkimusid'];
    }
    
      
}
