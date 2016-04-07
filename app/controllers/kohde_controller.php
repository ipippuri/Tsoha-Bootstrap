<?php

class KohdeController extends BaseController{
    public static function index() {
        $kohteet = Kohde::all();
        View::make('kohde/index.html', array('kohteet' => $kohteet));
    }
    
    
    public static  function create() {
        View::make('kohde/new.html');
    }
    
    
    public static function show($kohdeid) {
        $kohde = Kohde::find($kohdeid);
        View::make('/kohde/show.html', array('kohde' => $kohde));
    }


    public static function store() {
        $params = $_POST;
        
        $kohde = new Kohde(array(
            'nimi' => $params['nimi'],
            'paikkakunta' => $params['paikkakunta']
        ));
        
        $kohde->save();
        Redirect::to('/kohde/' . $kohde->kohdeid, array('message' => 'Kohde lisätty.'));
    }
    
}