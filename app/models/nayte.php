<?php

class Nayte extends BaseModel{
    public $nayteid, $kohdeid, $tutkimusid, $tutkijaid, 
            $nimi, $leveysaste, $pituusaste, $maamerkkitieto, $kuvaus, $analyysi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function find($nayteid) {
        $query = DB::connection()->prepare('SELECT * FROM Nayte WHERE nayteid = :nayteid LIMIT 1');
        $query->execute(array('nayteid' => $nayteid));
        $row = $query->fetch();
        
        if($row) {
            $nayte = new Nayte(array(
                'nayteid' => $row['nayteid'],
                'nimi' => $row['nimi'],
                'tutkimusid' => $row['tutkimusid'],
                'tutkijaid' => $row['tutkijaid'],
                'leveysaste' => $row['leveysaste'],
                'pituusaste' => $row['pituusaste'],
                'maamerkkitieto' => $row['maamerkkitieto'],
                'kuvaus' => $row['kuvaus'],
                'analyysi' => $row['analyysi'],
            ));
            return $nayte;
        }
        
        return null;
    }
    
//    public function getTutkimusid() {
//        $query = DB::connection()->prepare('SELECT tutkimusid FROM Nayte WHERE nayteid = :nayteid LIMIT 1');
//        $query->execute(array('nayteid' => $nayteid));
//        $row = $query->fetch();
//        $tutkimusid = $row['tutkimusid'];
//    }
    
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Nayte (tutkimusid, tutkijaid, nimi, leveysaste, '
                . 'pituusaste, maamerkkitieto, kuvaus, analyysi) VALUES (:tutkimusid, 1, :nimi, '
                . ':leveysaste, :pituusaste, :maamerkkitieto, :kuvaus, :analyysi) RETURNING nayteid');
        $query->execute(array('tutkimusid' => $this->tutkimusid, 'nimi' => $this->nimi,
            'leveysaste' => $this->leveysaste, 'pituusaste' => $this->pituusaste,
            'maamerkkitieto' => $this->maamerkkitieto, 'kuvaus' => $this->kuvaus,
            'analyysi' => $this->analyysi));
        
        $row = $query->fetch();
        $this->nayteid = $row['nayteid'];
    }
    
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Nayte WHERE nayteid = :nayteid');
        $query->execute(array('nayteid' => $this->nayteid));
    }
}
