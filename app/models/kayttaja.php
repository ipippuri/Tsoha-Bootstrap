<?php

class Kayttaja extends BaseModel{
    public $tutkijaid, $kayttajatunnus, $salasana;
    
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Tutkija WHERE kayttajatunnus = :kayttajatunnus '
                . 'AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        
        if($row) {
            $kayttaja = new Kayttaja(array(
                'tutkijaid' => $row['tutkijaid'],
                'kayttajatunnus' => $row['kayttajatunnus']
            ));
            return $kayttaja;
        } 
        
        return null;
    }
    
    
    public function find($user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tutkija WHERE tutkijaid= :tutkijaid LIMIT 1');
        $query->execute(array('tutkijaid' => $user_id));
        $row = $query->fetch();
        
        if($row) {
            $user = new Kayttaja(array(
                'kayttajaid' => $row['tutkijaid'],
                'kayttajatunnus' => $row['kayttajatunnus']
            ));
            return $user;
        }
        
        return null;
    }
    
}
