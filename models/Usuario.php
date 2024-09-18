<?php

  namespace Model;

  class Usuario extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
      $this->id = $args['id'] ?? null;
      $this->nombre = $args['nombre'] ?? '';
      $this->apellido = $args['apellido'] ?? '';
      $this->email = $args['email'] ?? '';
      $this->password = $args['password'] ?? '';
      $this->telefono = $args['telefono'] ?? '';
      $this->admin = $args['admin'] ?? '0';
      $this->confirmado = $args['confirmado'] ?? '0';
      $this->token = $args['token'] ?? '';
    }
    //Mensajes de Validación para la Creación de una cuenta
    public function validarNuevaCuenta(){
      if(!$this->nombre){self::$alertas['error'][] = 'El Nombre es Obligaorio';}
      if(!$this->apellido){self::$alertas['error'][] = 'El Apellido es Obligaorio';}
      if(!$this->telefono){self::$alertas['error'][] = 'El Teléfono es Obligaorio';}
      if(!$this->email){self::$alertas['error'][] = 'El Email es Obligaorio';}
      if(!$this->password)
        {self::$alertas['error'][] = 'El Password es Obligaorio';
      }else if(strlen($this->password)<6){self::$alertas['error'][] = 'El Password debe contener mínimo 6 Caracteres';}
      return self::$alertas;
    }
    //Validar Login
    public function validarLogin(){
      if(!$this->email){self::$alertas['error'][] = 'El Email es Obligatorio';}
      if(!$this->password){self::$alertas['error'][]= 'El Password es Obligatorio';}
      return self::$alertas;
    }
    //Validar Email
    public function validarEmail(){
      if(!$this->email){self::$alertas['error'][] = 'El Email es Obligatorio';}
      return self::$alertas;
    }

    public function validarPassword(){
      if(!$this->password)
        {self::$alertas['error'][] = 'El Password es Obligaorio';
      }else if(strlen($this->password)<6){self::$alertas['error'][] = 'El Password debe contener mínimo 6 Caracteres';}
      return self::$alertas;
    }
    //Revisa si el Usuario ya Existe
    public function existeUsuario(){
      $query = "SELECT * FROM " . self::$tabla;
      $query .= " WHERE email = '" . $this->email . "' LIMIT 1";
      $resultado = self::$db->query($query);
      if($resultado->num_rows){
        self::$alertas['error'][] = 'El Usuario ya está registrado!!!';
      }
      return $resultado;
    }
    //Hashear Password
    public function hashPassword(){
      $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //Crear Token
    public function crearToken(){
      $this->token = uniqid();
    }
    public function comprobarPasswordAndVerificado($password){
      $resultado = password_verify($password, $this->password);
      if(!$resultado || !$this->confirmado){
        self::$alertas['error'][] = 'Password Incorrecto o tu cuenta aun no ha sido confirmada...';
      }else{
        return true;
      }
    }
  }