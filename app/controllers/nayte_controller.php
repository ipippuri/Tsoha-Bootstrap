<?php

class NayteController extends BaseController{
    public static function show($tutkimusid, $nayteid) {
        self::check_logged_in();
        $nayte = Nayte::find($nayteid);
        View::make('nayte/show.html', array('nayte' => $nayte));
    }
    
    
    public function create($tutkimusid) {
        self::check_logged_in();
        View::make('nayte/new.html', array('tutkimusid' => $tutkimusid));
    }
    
    
    public function store($tutkimusid) {
        self::check_logged_in();
        $params = $_POST;
        $tutkijaid = $_SESSION['user'];
        $attributes = array(
            'tutkimusid' => $tutkimusid,
            'tutkijaid' => $tutkijaid,
            'nimi' => $params['nimi'],
            'leveysaste' => $params['leveysaste'],
            'pituusaste' => $params['pituusaste'],
            'maamerkkitieto' => $params['maamerkkitieto'],
            'kuvaus' => $params['kuvaus'],
            'analyysi' => $params['analyysi'],
        );
        
        $nayte = new Nayte($attributes);
        $errors = $nayte->errors();
        
        if (count($errors) == 0) {
            $nayte->save();
            Redirect::to('/tutkimus/' . $tutkimusid . '/' . $nayte->nayteid , array('message' => 'Näyte lisätty!'));     
        } else {
            View::make('/nayte/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    
    public function edit($tutkimusid, $nayteid) {
        self::check_logged_in();
        $nayte = Nayte::find($nayteid);
        View::make('/nayte/edit.html', array('tutkimusid' => $tutkimusid, 'attributes' => $nayte));
    }
    
    
    public function update($tutkimusid, $nayteid) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nayteid' => $nayteid,
            'tutkimusid' => $tutkimusid,
            'nimi' => $params['nimi'],
            'leveysaste' => $params['leveysaste'],
            'pituusaste' => $params['pituusaste'],
            'maamerkkitieto' => $params['maamerkkitieto'],
            'kuvaus' => $params['kuvaus'],
            'analyysi' => $params['analyysi']
        );
        
//        $nayte = new Nayte($attributes);
//        Kint::dump($attributes);
//        $nayte->update();
        
        Redirect::to('/tutkimus/' . $tutkimusid . '/' . $nayteid , array('message' => 'Näytettä on muokattu!'));
    }


    public function destroy($tutkimusid, $nayteid) {
        self::check_logged_in();
        $nayte = new Nayte(array('nayteid' => $nayteid));
        $nayte->destroy();
        
        Redirect::to('/tutkimus/' . $tutkimusid, array('message' => 'Näyte poistettu!'));
    }
}
