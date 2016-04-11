<?php

class TutkimusController {
    public static function index() {
        $tutkimukset = Tutkimus::all();
        View::make('tutkimus/index.html', array('tutkimukset' => $tutkimukset));
    }
    
    
    public static function create() {
        View::make('/tutkimus/new.html');
    }
    
    
    public static function show($tutkimusid) {
        $tutkimus = Tutkimus::findWithNaytteet($tutkimusid);
        View::make('/tutkimus/show.html', array('tutkimus' => $tutkimus));
    }
}
