<?php

class AuthController extends \BaseController {

	/**
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('admin/');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('admin/login');
    }


    /**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password')
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('rememberme', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/admin');

        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('admin/login')
                    ->with('mensaje_error', 'Tus datos son incorrectos')
                    ->withInput();
    }


    public function logOut()
    {
        Auth::logout();
        return Redirect::to('admin/login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }


}
