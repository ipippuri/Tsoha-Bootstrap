<?php

class Kohde extends BaseModel{
    public $kohdeid, $nimi, $paikkakunta, $viimeisinTutkimus,
            $tutkimukset=array(), $validators;
        
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_paikkakunta');
    }
    
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kohde LEFT JOIN 
            (SELECT kohdeid as id, MAX(paivamaara) as viimeisin_tutkimus 
            FROM Tutkimus GROUP BY id) Viimeisin ON Kohde.kohdeid=Viimeisin.id 
            ORDER BY viimeisin_tutkimus DESC');
        $query->execute();
        $rows= $query->fetchAll();
        $kohteet = array();
        
        foreach($rows as $row){
            $kohteet[] = new Kohde(array(
                'kohdeid' => $row['kohdeid'],
                'nimi' => $row['nimi'],
                'paikkakunta' => $row['paikkakunta'],
                'viimeisinTutkimus' => $row['viimeisin_tutkimus']
            ));
        }
        
        return $kohteet;  
    }

    
    public static function find($kohdeid) {
        $query = DB::connection()->prepare('SELECT * FROM Kohde WHERE kohdeid= :id LIMIT 1');
        $query->execute(array('id' => $kohdeid));
        $row = $query->fetch();
        
        if($row){
            $kohde = new Kohde(array(
                'kohdeid' => $row['kohdeid'],
                'nimi' => $row['nimi'],
                'paikkakunta' => $row['paikkakunta']
            ));
            
            return $kohde;
        }
        
        return null;
    }
    
    
    public static function findWithTutkimukset($kohdeid) {
        $kohde = Kohde::find($kohdeid);
        
        $query = DB::connection()->prepare('SELECT tutkimusid, tutkijaid, paivamaara '
                . 'FROM Tutkimus WHERE kohdeid= :kohdeid ORDER BY paivamaara DESC');
        $query->execute(array('kohdeid' => $kohdeid ));
        
        $rows = $query->fetchAll();
        $tutkimukset = array();
        
        foreach ($rows as $row) {
            $tutkimukset[] = new Tutkimus(array(
                'tutkimusid' => $row['tutkimusid'],
                'tutkijaid' => $row['tutkijaid'],
                'paivamaara' => $row['paivamaara'],
            ));
        }
        
        $kohde->tutkimukset = $tutkimukset;
        return $kohde;
    }

    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kohde (nimi, paikkakunta)'
                . 'VALUES (:nimi, :paikkakunta) RETURNING kohdeid');
        $query->execute(array('nimi' => $this->nimi, 'paikkakunta' => $this->paikkakunta));
        
        $row = $query->fetch();
        $this->kohdeid = $row['kohdeid'];
    }
   
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Kohde SET nimi = :nimi, paikkakunta = :paikkakunta WHERE kohdeid = :kohdeid');
        $query->execute(array('kohdeid' => $this->kohdeid, 'nimi' => $this->nimi, 'paikkakunta' => $this->paikkakunta));
    }

    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kohde WHERE kohdeid = :kohdeid');
        $query->execute(array('kohdeid' => $this->kohdeid));
    }


    
    public function validate_nimi() {
        $errors = array();
        if($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä.';
        }
        
        if(strlen($this->nimi) < 2) {
            $errors[] = 'Nimi: Pituus vähintään 2 merkkiä';
        }
        
        return $errors;
    }
    
        public function validate_paikkakunta() {
        $errors = array();
        if($this->paikkakunta == '' || $this->paikkakunta == null) {
            $errors[] = 'Paikkakunta ei saa olla tyhjä.';
        }
        
        if(strlen($this->paikkakunta) < 2) {
            $errors[] = 'Paikkakunta: Vähintään 2 merkkiä';
        }
        
        return $errors;
    }

      
}
