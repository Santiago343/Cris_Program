<?php
    namespace App\Models;
    use CodeIgniter\Model;


    class Tabla_administrador extends Model {

        protected $table      = 'libros';
        protected $primaryKey = 'id_admin';
        protected $returnType = 'object';

        protected $allowedFields = [
                                    'id_admin', 'nombre', 'ap_materno', 'ap_paterno', 'sexo', 'foto', 'email', 'id_rol'
                                    ];
        
        //Funciones que nos ayudaran a realizar peticiones (consultas) para obtener la información que deseemos
        public function data_table_calzados($tipo_categoria = 0) {
            $resultado = $this
                    ->select('
                                 id_admin, nombre, ap_materno, ap_paterno, sexo, foto, email, id_rol
                            ')
                    ->where('sexo',$tipo_categoria)
                    ->orderBy('nombre', 'ASC')
                    ->findAll();
             return $resultado;
        }//end data_table_calzados

        public function obtener_calzado($id_admin = 0){
            $resultado = $this
                        ->select('
                                id_admin, nombre, editorial, sexo, paginas, 
                                precio, imagen_libro, descripcion, fecha
                                ')
                        ->where('id_admin', $id_admin)
                        ->first();
            return $resultado;
        }//end obtener_calzado

        public function calzados_limit($limit) {
            $resultado = $this
                ->select('
                        id_admin, nombre, editorial, sexo, paginas, 
                        precio, imagen_libro, descripcion, fecha
                        ')
                ->orderBy('id_admin', 'ASC')
                ->limit($limit)
                ->find();
            return $resultado;
        }// 

        public function calzados_actuales($fecha ='0000-00-00',$limit = 0) {
            $resultado = $this
                ->select('
                        id_admin, nombre, editorial, sexo, paginas, 
                        precio, imagen_libro, descripcion, fecha
                        ')
                ->orderBy('nombre', 'ASC')
                ->where('fecha',$fecha)
                ->limit($limit)
                ->find();
            return $resultado;
        }// 

        public function oferta_calzados($id_categoria = 0, $limit = 0){
            $resultado = $this
                        ->select('
                                    calzados.estatus_calzado, calzados.id_calzado, calzados.marca, calzados.modelo, calzados.color, calzados.talla,
                                    calzados.sexo, calzados.precio, calzados.imagen_calzado, calzados.destacado, calzados.fecha, ofertas.estatus_ofertas,
                                    ofertas.id_oferta, ofertas.descuento, ofertas.fin_oferta
                                ')
                        ->where('calzados.sexo', $id_categoria)
                        ->join('ofertas','calzados.id_calzado= ofertas.id_calzado', 'left')
                        ->limit($limit)
                        ->find();
            return $resultado;
        }//end obtener_oferta_calzado

        public function obtener_oferta_calzados($id_calzado = 0){
            $resultado = $this
                        ->select('
                                    calzados.estatus_calzado, calzados.id_calzado, calzados.marca, calzados.modelo, calzados.color, calzados.talla,
                                    calzados.sexo, calzados.precio, calzados.imagen_calzado, calzados.destacado, calzados.fecha, 
                                    calzados.descripcion, ofertas.estatus_ofertas,
                                    ofertas.id_oferta, ofertas.descuento, ofertas.fin_oferta, ofertas.id_calzado
                                ')
                        ->where('calzados.id_calzado', $id_calzado)
                        ->join('ofertas','calzados.id_calzado= ofertas.id_calzado', 'left')
                        ->first();
            return $resultado;
        }//end obtener_oferta_calzado
    }//End Model calzados
    


