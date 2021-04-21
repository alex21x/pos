<?php

 class Cie_model extends CI_Model
 {
   
 public function __construct() {
        parent::__construct();
        $this->load->database();
    }

     public function select($idcie = ''){
      if ($idcie == '') {
          $rscies = $this->db->from("tipo_enfermedades")
                                       ->get()
                                       ->result();
           return $rscies;

      }else{
          $rscie = $this->db->from("tipo_enfermedades")
                                     ->where("id",$idcie)
                                     ->get()
                                     ->row();
               
                         return $rscie;
        }
    }
     
     public function eliminar($idcie){

      $especialidadUpdate = [
          "estado" => ST_ELIMINADO
        ];

      $this->db->where("id",$idcie);
      $this->db->update("tipo_enfermedades", $especialidadUpdate);
      return true;
    }

    public function guardarcie()
    {      
        if($_POST['id']!='')
      {
        $dataUpdate = [
                  'descripcion'  => strtoupper($_POST['descripcion']),
                  'codigo'  => $_POST['codigo']
                ];
          $this->db->where('id', $_POST['id']);
          $this->db->update('tipo_enfermedades', $dataUpdate);
      }else
      {
        $dataInsert = [
                  'descripcion'  => strtoupper($_POST['descripcion']),
                  'codigo'  => $_POST['codigo'],
                  'estado' => ST_ACTIVO
                ];
        $this->db->insert('tipo_enfermedades', $dataInsert);
      }
      return true;
    }

   public function getMainList()
   {
     $select = $this->db->from('tipo_enfermedades')
                         ->where("estado",ST_ACTIVO);

      if($_POST['search'] != ''){
        $select->like("descripcion",$_POST['search']);
      }

      $selectCount = clone $select;
      $rsCount = $selectCount->get()->result();

      $rows = count($rsCount);

      $rscies = $select->limit($_POST['pageSize'],$_POST['skip'])
                                 ->order_by("id","desc")
                                 ->get()
                                 ->result();
      $i=1;
      foreach ($rscies as $rscie) {
          $rscie->idd = "<a class='show_galeria' title ='ver' href= '#' data-id='{$rscie->id}'>{$rscie->id}</a>";
          $rscie->cie_editar  = "<a class='btn btn-default btn-xs  btn_modificar_cie' data-id='{$rscie->id}' data-toggle='modal' data-target='#myModal'>Modificar</a>";

          $rscie->cie_eliminar="<a class='btn btn-default btn-xs btn_eliminar_cie' data-id='{$rscie->id}' data-msg='Desea Eliminar tipo de enfermedad: {$rscie->descripcion} ?'>Eliminar</a>";
        $i++;
      }

      $datos = [
          'data' => $rscies,
          'rows' => $rows
      ];

      return $datos;
   }
 }

 ?>