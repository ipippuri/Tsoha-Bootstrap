<?php

class TutkimusController {
    public static function index() {
        $tutkimukset = Tutkimus::all();
        View::make('tutkimus/index.html', array('tutkimukset' => $tutkimukset));
    }
    
    
    public static function create($kohdeid) {
        View::make('/tutkimus/new.html', array('kohdeid' => $kohdeid));
    }
    
    
    public static function show($tutkimusid) {
        $tutkimus = Tutkimus::findWithNaytteet($tutkimusid);
        View::make('/tutkimus/show.html', array('tutkimus' => $tutkimus));
    }
    
    
    public function store($kohdeid) {
        $params = $_POST;
        $attributes = array(
            'kohdeid' => $kohdeid,
            'paivamaara' => $params['paivamaara'],
            'aistivarainen_tieto' => $params['aistivarainen_tieto'],
            'mittaustieto' => $params['mittaustieto']
            );
        
        $tutkimus = new Tutkimus($attributes);
        $tutkimus->save();
        
        Redirect::to('/kohde/' . $kohdeid, array('message' => 'Tutkimus lisätty!'));
    }
}
