<?php

class TutkimusController extends BaseController{
    public static function index() {
        self::check_logged_in();
        $tutkimukset = Tutkimus::all();
        View::make('tutkimus/index.html', array('tutkimukset' => $tutkimukset));
    }
    
    
    public static function create($kohdeid) {
        self::check_logged_in();
        $attributes = array('kohdeid' => $kohdeid);
        View::make('tutkimus/new.html', array('attributes' => $attributes));
    }
    
    
    public static function show($tutkimusid) {
        self::check_logged_in();
        $tutkimus = Tutkimus::findWithNaytteet($tutkimusid);
        View::make('tutkimus/show.html', array('tutkimus' => $tutkimus));
    }
    
    
    public function store($kohdeid) {
        self::check_logged_in();
        $params = $_POST;
        $tutkijaid = $_SESSION['user'];
        $attributes = array(
            'kohdeid' => $kohdeid,
            'tutkijaid'  => $tutkijaid,
            'paivamaara' => $params['paivamaara'],
            'aistivarainen_tieto' => $params['aistivarainen_tieto'],
            'mittaustieto' => $params['mittaustieto']
            );
        
        $tutkimus = new Tutkimus($attributes);
        $errors = $tutkimus->errors();
        
        if(count($errors) == 0) {
           $tutkimus->save();        
            Redirect::to('/kohde/' . $kohdeid, array('message' => 'Tutkimus lisätty!'));
        } else {
            View::make('tutkimus/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
     
    
    public function edit($tutkimusid) {
        self::check_logged_in();
        $tutkimus = Tutkimus::find($tutkimusid);
        View::make('tutkimus/edit.html', array('attributes' => $tutkimus));
    }
    
    
    public function update($tutkimusid) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'tutkimusid' => $tutkimusid,
            'paivamaara' => $params['paivamaara'],
            'aistivarainen_tieto' => $params['aistivarainen_tieto'],
            'mittaustieto' => $params['mittaustieto']
        );
        
        $tutkimus = new Tutkimus($attributes);
        $errors = $tutkimus->errors();
        
        if(count($errors) == 0) {
            $tutkimus->update();
            Redirect::to('/tutkimus/' . $tutkimusid, array('message' => 'Tutkimus päivitetty!'));
        } else {
            View::make('tutkimus/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    
    public function destroy($tutkimusid) {
        self::check_logged_in();
        $tutkimus = new Tutkimus(array('tutkimusid' => $tutkimusid));
        $tutkimus->destroy();

        Redirect::to('/tutkimus', array('message' => 'Tutkimus poistettu!'));
    }
         
}

