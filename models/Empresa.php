<?php
  namespace Model;

  class Empresa extends ActiveRecord{
    //BD
    protected static $tabla = 'empresa';
    protected static $columnasDB = ['id', 'nombre', 'direccion', 'telefono', 'email', 'ubicacion'];

    public $id;
    public $nombre;
    public $direccion;
    public $telefono;
    public $email;
    public $ubicacion;

    public function __construct($args = [])
    {
      $this->id = $args['id'] ?? null;
      $this->nombre = $args['nombre'] ?? '';
      $this->direccion = $args['direccion'] ?? '';
      $this->telefono = $args['telefono'] ?? '';
      $this->email = $args['email'] ?? '';
      $this->ubicacion = $args['ubicacion'] ?? '';
    }

    public function validar(){
      if(!$this->nombre){self::$alertas['error'][] = 'El Nombre de la Empresa es Obligatorio';}
      if(!$this->direccion){self::$alertas['error'][] = 'La Dirección de la Empresa es Obligatoria';}
      if(!$this->telefono){self::$alertas['error'][] = 'El Teléfono de la Empresa es Obligatoria';}
      if(!$this->email){self::$alertas['error'][] = 'El Email de la Empresa es Obligatoria';}
      if(!$this->ubicacion){self::$alertas['error'][] = 'La Ubicación de la Empresa es Obligatoria';}
      return self::$alertas;
    }
  }