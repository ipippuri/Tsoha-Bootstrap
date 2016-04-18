<?php
    
class KohdeController extends BaseController{
    public static function index() {
        $kohteet = Kohde::all();
        $user = parent::get_user_logged_in();
        View::make('kohde/index.html', array('kohteet' => $kohteet, 'user_logged_in' => $user));
    }
    
    
    public static  function create() {
        View::make('kohde/new.html');
    }
    
    
    public static function show($kohdeid) {
        $kohde = Kohde::findWithTutkimukset($kohdeid);
        View::make('/kohde/show.html', array('kohde' => $kohde));
    }


    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'paikkakunta' => $params['paikkakunta']
        );
        
        $kohde = new Kohde($attributes);
        $errors = $kohde->errors();
        
        if(count($errors) == 0) {
            $kohde->save();
            Redirect::to('/kohde/' . $kohde->kohdeid, array('message' => 'Kohde lisätty!'));
        }
        else {
            View::make('kohde/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    
    public static function edit($kohdeid) {
        $kohde = Kohde::find($kohdeid);
        View::make('kohde/edit.html', array('attributes' => $kohde));
    }
    
    
    public function update($kohdeid) {
        $params = $_POST;
        
        $attributes = array(
            'kohdeid' => $kohdeid,
            'nimi' => $params['nimi'],
            'paikkakunta' => $params['paikkakunta']
        );
        
        $kohde = new Kohde($attributes);
        $errors = $kohde->errors();
        
        if(count($errors) > 0) {
            View::make('kohde/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kohde->update();
            Redirect::to('/kohde/' . $kohde->kohdeid , array('message' => 'Kohdetta on muokattu!'));
        }
    }
    
    
    public static function destroy($kohdeid) {
        $kohde = new Kohde(array('kohdeid' => $kohdeid));
        $kohde->destroy();
        
        Redirect::to('/kohde', array('message' => 'Kohde poistettu!'));
    }
    
}