<?php

class Tutkimus extends BaseModel{
    public $tutkimusid, $kohdeid, $tutkijaid, $paivamaara, $aistivarainen_tieto, $mittaustieto;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tutkimus');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tutkimukset = array();
        
        foreach ($rows as $row) {
            $tutkimukset[] = new Tutkimus(array(
                'tutkimusid' => $row['tutkimusid'],
                'kohdeid' => $row['kohdeid'],
                'tutkijaid' => $row['tutkijaid'],
                'paivamaara' => $row['paivamaara'],
                'aistivarainen_tieto' => $row['aistivarainen_tieto'],
                'mitattaustieto' => $row['mittaustieto'],
            ));
        }
        return $tutkimukset;
        
    }
}
