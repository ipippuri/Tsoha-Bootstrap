<?php

class Tutkimus extends BaseModel{
    public $tutkimusid, $kohdeid, $kohteenNimi, $kohteenPaikkakunta, $tutkijaid, 
            $paivamaara, $aistivarainen_tieto, $mittaustieto;
    
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
                'kohdeid' => $row['kohdeid'],
                'kohteenNimi' => $row['nimi'],
                'kohteenPaikkakunta' => $row['paikkakunta'],
                'tutkijaid' => $row['tutkijaid'],
                'paivamaara' => $row['paivamaara'],
                'aistivarainen_tieto' => $row['aistivarainen_tieto'],
                'mitattaustieto' => $row['mittaustieto'],
            ));
        }
        return $tutkimukset;
        
    }
}
