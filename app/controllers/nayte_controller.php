<?php

class NayteController {
    public static function show($nayteid) {
        $nayte = Nayte::find($nayteid);
        View::make('/nayte/show.html', array('nayte' => $nayte));
    }
    
    
    public function create($tutkimusid) {
        View::make('nayte/new.html', array('tutkimusid' => $tutkimusid));
    }
    
    
    public function store($tutkimusid) {
        $params = $_POST;
        $attributes = array(
            'tutkimusid' => $tutkimusid,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'analyysi' => $params['analyysi'],
            'leveysaste' => $params['leveysaste'],
            'pituusaste' => $params['pituusaste'],
            'maamerkkitieto' => $params['maamerkkitieto']
        );
        
        $nayte = new Nayte($attributes);
        $nayte->save();
        
        Redirect::to('/tutkimus/' . $tutkimusid, array('message' => 'Näyte lisätty!'));     
    }
    
    
    public function destroy($tutkimusid, $nayteid) {
        $nayte = new Nayte(array('nayteid' => $nayteid));
        $nayte->destroy();
        
        Redirect::to('/tutkimus/' . $tutkimusid, array('message' => 'Näyte poistettu!'));
    }
}
