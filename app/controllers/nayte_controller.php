<?php

class NayteController extends BaseController{
    public static function show($tutkimusid, $nayteid) {
        self::check_logged_in();
        $nayte = Nayte::find($nayteid);
        View::make('nayte/show.html', array('nayte' => $nayte));
    }
    
    
    public function create($tutkimusid) {
        self::check_logged_in();
        $attributes = array('tutkimusid' => $tutkimusid);
        View::make('nayte/new.html', array('attributes' => $attributes));
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
            View::make('nayte/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    
    public function edit($nayteid) {
        self::check_logged_in();
        $nayte = Nayte::find($nayteid);
        View::make('nayte/edit.html', array('attributes' => $nayte));
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
        
        $nayte = new Nayte($attributes);
        $errors = $nayte->errors();
        
        if(count($errors) == 0) {
            $nayte->update();
            Redirect::to('/tutkimus/' . $tutkimusid . '/' . $nayteid , array('message' => 'Näytettä on muokattu!'));
        } else {
            View::make('nayte/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }


    public function destroy($tutkimusid, $nayteid) {
        self::check_logged_in();
        $nayte = new Nayte(array('nayteid' => $nayteid));
        $nayte->destroy();
        
        Redirect::to('/tutkimus/' . $tutkimusid, array('message' => 'Näyte poistettu!'));
    }
}
