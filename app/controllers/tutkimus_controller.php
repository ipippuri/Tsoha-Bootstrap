<?php


class TutkimusController {
    public static function index() {
        $tutkimukset = Tutkimus::all();
        View::make('tutkimus/index.html', array('tutkimukset' => $tutkimukset));
    }
}
