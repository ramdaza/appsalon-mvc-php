<?php
  namespace Controllers;

use Model\Empresa;
use MVC\Router;

  class EmpresaController{
    public static function index(Router $router){
      isSession();
      isAdmin();
      $empresa = Empresa::all();
      $router->   render('empresa/index', [
        'nombre' => $_SESSION['nombre'],
        'empresa' => $empresa
      ]); 
    }

    public static function guardar(Router $router){
      isSession();
      isAdmin();
      $alertas = [];
      if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['id'])){
          if(!is_numeric($_GET['id'])) return;
          $empresa = Empresa::find($_GET['id']);
        }else{
          $empresa = new Empresa;
        }
        $empresa->sincronizar($_POST);
        $alertas = $empresa->validar();
        if(empty($alertas)){
          $empresa->guardar();
          header('Location: /empresa');
        }
      }
      $router->   render('empresa/index', [
        'nombre' => $_SESSION['nombre'],
        'empresa' => $empresa,
        'alertas' => $alertas
      ]);
    }
  }