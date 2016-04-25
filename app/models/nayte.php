<?php

class Nayte extends BaseModel{
    public $nayteid, $kohdeid, $tutkimusid, $tutkijaid, 
            $nimi, $leveysaste, $pituusaste, $maamerkkitieto, $kuvaus, $analyysi,
            $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_maamerkkitieto', 'validate_leveysaste', 'validate_pituusaste',
            'validate_kuvaus');
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
    
  
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Nayte (tutkimusid, tutkijaid, nimi, leveysaste, '
                . 'pituusaste, maamerkkitieto, kuvaus, analyysi) VALUES (:tutkimusid, :tutkijaid, :nimi, '
                . ':leveysaste, :pituusaste, :maamerkkitieto, :kuvaus, :analyysi) RETURNING nayteid');
        $query->execute(array('tutkimusid' => $this->tutkimusid, 'tutkijaid' => $this->tutkijaid, 'nimi' => $this->nimi,
            'leveysaste' => $this->leveysaste, 'pituusaste' => $this->pituusaste,
            'maamerkkitieto' => $this->maamerkkitieto, 'kuvaus' => $this->kuvaus,
            'analyysi' => $this->analyysi));
        
        $row = $query->fetch();
        $this->nayteid = $row['nayteid'];
    }
    
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Nayte SET nimi = :nimi, leveysaste = :leveysaste, '
                . 'pituusaste = :pituusaste, maamerkkitieto = :maamerkkitieto, kuvaus = :kuvaus, '
                . 'analyysi = :analyysi WHERE nayteid= :nayteid');
        $query->execute(array('nayteid' => $this->nayteid, 'nimi' => $this->nimi, 'leveysaste' => $this->leveysaste,
            'pituusaste' => $this->pituusaste, 'maamerkkitieto' => $this->maamerkkitieto,
            'kuvaus' => $this->kuvaus, 'analyysi' => $this->analyysi));
    }
    
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Nayte WHERE nayteid = :nayteid');
        $query->execute(array('nayteid' => $this->nayteid));
    }
    
    
    public function validate_nimi() {
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length($this->nimi, 2, 'Nimi'));
        $errors = array_merge($errors, parent::validate_max_length($this->nimi, 50, 'Nimi'));
        
        return $errors;
    }
    
    
    public function validate_maamerkkitieto() {
        return parent::validate_max_length($this->maamerkkitieto, 150, 'Maamerkkitieto');
    }
    
    public function validate_kuvaus() {
        return parent::validate_string_length($this->kuvaus, 4, 'Kuvaus');
    }
    
    
    public function validate_leveysaste() {
        $errors = array();
        
        $errors = array_merge($errors, parent::validate_numeric($this->leveysaste, 'Leveysaste'));
        $errors = array_merge($errors, parent::validate_not_null($this->leveysaste, 'Leveysaste'));
        
        if($this->leveysaste < -90 || $this->leveysaste > 90) {
            $errors[] = 'Leveysaste: Arvon on oltava välillä (-90, 90).';
        }
        if (strlen($this->leveysaste) > 7) {
            $errors[] = 'Leveysaste: Korkeintaan 7 merkkiä';
        }
        
        return $errors;
    }
    
    
    public function validate_pituusaste() {
        $errors = array();
        
        $errors = array_merge($errors, parent::validate_numeric($this->pituusaste, 'Pituusaste')); 
        $errors = array_merge($errors, parent::validate_not_null($this->pituusaste, 'Pituusaste'));
        
        if($this->pituusaste < -180 || $this->pituusaste > 180) {
            $errors[] = 'Pituusaste: Arvon on oltava välillä (-180, 180).';
        }
        if (strlen($this->pituusaste) > 7) {
            $errors[] = 'Pituusaste: Korkeintaan 7 merkkiä';
        }
        
        return $errors;
    }
    
    
}
