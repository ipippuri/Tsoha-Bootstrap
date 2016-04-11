<?php

class Nayte extends BaseModel{
    public $nayteid, $kohdeid, $tutkimusid, $tutkijaid, 
            $nimi, $kuvaus, $analyysi;
    
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
                'kuvaus' => $row['kuvaus'],
                'analyysi' => $row['analyysi'],
            ));
            return $nayte;
        }
        
        return null;
    }
}
