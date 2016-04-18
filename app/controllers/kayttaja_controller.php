<?php

class KayttajaController extends BaseController{
    public static function login() {
        View::make('kayttaja/login.html');
    }
    
    
    public static function handle_login() {
        $params = $_POST;
        
        $user = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);
        
        if(!$user) {
            View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!',
                'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['user'] = $user->tutkijaid;
            Redirect::to('/kohde', array('message' => 'Tervetuloa ' . $user->kayttajatunnus . '!'));
        }
    }
    
    
    
}
