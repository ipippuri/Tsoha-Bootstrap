<?php

class TutkimusController {
    public static function index() {
        $tutkimukset = Tutkimus::all();
        View::make('tutkimus/index.html', array('tutkimukset' => $tutkimukset));
    }
    
    public static function show($tutkimusid) {
        $tutkimus = Tutkimus::find($tutkimusid);
        View::make('/tutkimus/show.html', array('tutkimus' => $tutkimus));
    }
}
