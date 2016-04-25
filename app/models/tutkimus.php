<?php

class Tutkimus extends BaseModel{
    public $tutkimusid, $kohdeid, $kohteenNimi, $kohteenPaikkakunta, $tutkijaid, 
            $paivamaara, $aistivarainen_tieto, $mittaustieto, $nayteet=array(),
            $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_aistivarainen_tieto', 'validate_mittaustieto');
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
    
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Tutkimus SET aistivarainen_tieto = :aistivarainen_tieto, '
                . 'mittaustieto = :mittaustieto WHERE tutkimusid = :tutkimusid');
        $query->execute(array('tutkimusid' => $this->tutkimusid, 'aistivarainen_tieto' => $this->aistivarainen_tieto, 'mittaustieto' => $this->mittaustieto));
    }
    
    
    public function destroyNaytteet() {
        $query = DB::connection()->prepare('DELETE FROM Nayte WHERE tutkimusid = :tutkimusid');
        $query->execute(array('tutkimusid' => $this->tutkimusid));
    }
    
    
    public function destroy() {
        self::destroyNaytteet();
        $query = DB::connection()->prepare('DELETE FROM Tutkimus WHERE tutkimusid = :tutkimusid');
        $query->execute(array('tutkimusid' => $this->tutkimusid));
    }
    


    public function validate_aistivarainen_tieto() {
        $errors = parent::validate_string_length($this->aistivarainen_tieto, 4, 'Aistivarainen tieto');
        return $errors;
    }

    public function validate_mittaustieto() {
        $errors = parent::validate_string_length($this->mittaustieto, 4, 'Mittaustieto');
        return $errors;
    }
}
