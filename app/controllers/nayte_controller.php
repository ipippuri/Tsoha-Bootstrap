<?php

class NayteController {
    public static function show($nayteid) {
        $nayte = Nayte::find($nayteid);
        View::make('/nayte/show.html', array('nayte' => $nayte));
    }
}
