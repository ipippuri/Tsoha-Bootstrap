<?php

class Kohde extends BaseModel{
    public $kohdeid, $nimi, $paikkakunta, $viimeisinTutkimus;
        
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kohde LEFT JOIN 
            (SELECT kohdeid, MAX(paivamaara) as viimeisin_tutkimus 
            FROM Tutkimus GROUP BY kohdeid) Viimeisin ON Kohde.kohdeid=Viimeisin.kohdeid 
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
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kohde (nimi, paikkakunta)'
                . 'VALUES (:nimi, :paikkakunta) RETURNING kohdeid');
        $query->execute(array('nimi' => $this->nimi, 'paikkakunta' => $this->paikkakunta));
        
        $row = $query->fetch();
        $this->kohdeid = $row['kohdeid'];
    }
      
}
