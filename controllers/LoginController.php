<?php
  namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

  class LoginController{
    public static function login(Router $router){
      $alertas = [];
      $auth = new Usuario;
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $auth = new Usuario($_POST);
        $alertas = $auth->validarLogin();
        if(empty($alertas)){
          //Comprobar si Existe el Usuario mediant eel email
          $usuario = Usuario::where('email', $auth->email);
          if($usuario){
            //Verificar el Password
            if($usuario->comprobarPasswordAndVerificado($auth->password)){
              //Autenticar el Usuario
              isSession();
              $_SESSION['id'] = $usuario->id;
              $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
              $_SESSION['email'] = $usuario->email;
              $_SESSION['login'] = true;
              //Redireccionar
              if($usuario->admin === "1"){
                $_SESSION['admin'] = $usuario->admin ?? null;
                header('location: /admin');
              }else{
                header('location: /cita');
              }
            }
          }else{
            Usuario::setAlerta('error', 'Usuario No Existe');
          }
        }
      }
      $alertas = Usuario::getAlertas();
      $router->render('auth/login', [
        'alertas' => $alertas,
        'auth' => $auth
      ]);
    }

    public static function logout(){
      isSession();
      $_SESSION = [];
      header('location: /');
    }

    public static function olvide(Router $router){
      $alertas = [];
      if($_SERVER['REQUEST_METHOD']==='POST'){
        $auth = new Usuario($_POST);
        $alertas = $auth->validarEmail();
        if(empty($alertas)){
          $usuario = Usuario::where('email', $auth->email);
          if($usuario && $usuario->confirmado==="1"){
            //Generar Token Unico
            $usuario->crearToken();
            //Guardar el Token
            $resultado = $usuario->guardar();
            //Enviar Email
            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
            $email->enviarInstrucciones();
            Usuario::setAlerta('exito', 'Revisa tu Email, Hemos enviado las instrucciones para Reestablecer tu Password');
          }else{
            Usuario::setAlerta('error', 'El Usuario No Existe o aun no ha sido Confirmado');
          }
        }
      }
      $alertas = Usuario::getAlertas();
      $router->render('auth/olvide-password', [
        'alertas' => $alertas  
      ]);
    }

    public static function recuperar(Router $router){
      $alertas = [];
      $error = false;
      $token = sanitizar($_GET['token']);
      //Buscar Usuario por su Token
      $usuario = Usuario::where('token', $token);
      if(empty($usuario)){
        Usuario::setAlerta('error', 'Token no Válido');
        $error = true;
      }
      if($_SERVER['REQUEST_METHOD']==='POST'){
        //Leer el Nuevo Password y Guardarlo
        $password = New Usuario($_POST);
        $alertas = $password->validarPassword();
        if(empty($alertas)){
          $usuario->password = $password->password;
          //Hashear el Password
          $usuario->hashPassword();
          $usuario->token = '';
          $resultado = $usuario->guardar();
          if($resultado){
            header('location: /');
          }
        }
      }
      $alertas = Usuario::getAlertas();
      $router->render('auth/recuperar-password', [
        'alertas' => $alertas,
        'error' => $error
      ]);
    }

    public static function crear(Router $router){
      $usuario = new Usuario;
      //Alertas Vacias
      $alertas = [];
      if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $usuario->sincronizar($_POST);
        $alertas = $usuario->validarNuevaCuenta();
        //Revisar que alertas esté vacío
        if(empty($alertas)){
          //Verificar que el Usuario no esté registrado
          $resultado = $usuario->existeUsuario();
          if($resultado->num_rows){
            $alertas = Usuario::getAlertas();      
          }else{
            //No está Registrado, Almacenarlo en la BD
            //Hashear el Password
            $usuario->hashPassword();
            //Generar Token Unico
            $usuario->crearToken();
            //Enviar Email
            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
            $email->enviarConfirmacion();
            //Crear el Usuario
            $resultado = $usuario->guardar();
            if($resultado){
              header('location: /mensaje');
            }
          }
        }
      }
      $router->render('auth/crear-cuenta', [
        'usuario' => $usuario,
        'alertas' => $alertas
      ]);
    }

    public static function mensaje(Router $router){
      $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
      $alertas = [];
      $token = sanitizar($_GET['token']);
      $usuario = Usuario::where('token', $token);
      if(empty($usuario) || $usuario->token === '' || is_null($usuario->token)) {
        //Mostrar Mensaje de Error
        Usuario::setAlerta('error', 'Token no Válido');
      }else{
        //Modificar a Confirmado
        $usuario->confirmado = '1';
        $usuario->token = '';
        $usuario->guardar();
        Usuario::setAlerta('exito', 'Cuenta Confirmada Correctamente...');
      }
      //Obtener las alertas
      $alertas = Usuario::getAlertas();
      //renderizar la Vista
      $router->render('auth/confirmar-cuenta', [
        'alertas' => $alertas
      ]);
    }
  }