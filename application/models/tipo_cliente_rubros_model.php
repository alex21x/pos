<?PHP

class tipo_cliente_rubros_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

 public function select($tc_rubroId = ''){

    if ($tc_rubroId == '') {
       $rs_tcRubros = $this->db->from("tipo_cliente_rubros")
                              ->where("tcr_estado", ST_ACTIVO)
                              ->get()
                              ->result();
         return $rs_tcRubros;
    } else{

      $rs_tcRubro = $this->db->from("tipo_cliente_rubros")
                            ->where("tcr_id",$tc_rubroId)
                            ->get()
                            ->row();
        return $rs_tcRubro;
    }
  }


  public function guardar() {              

        if($_POST['id']!='') {
            $dataUpdate = [
                            'tcr_nombre'    => strtoupper($_POST['nombre']),
                            'tcr_precio_text' => $_POST['precio'],
                          ];
            $this->db->where('tcr_id', $_POST['id']);
            $this->db->update('tipo_cliente_rubros', $dataUpdate);
        } else {
            $dataInsert = [
                            'tcr_nombre'      => strtoupper($_POST['nombre']),
                            'tcr_precio_text' => $_POST['precio'],
                            'tcr_estado'      => ST_ACTIVO
                          ];
            $this->db->insert('tipo_cliente_rubros', $dataInsert);              
        }
        return true;
  } 

  public function eliminar($tc_rubroId){

        $arrayUpdate = [
                          "tcr_estado" => ST_ELIMINADO
                       ];
        $this->db->where("tcr_id", $tc_rubroId);
        $this->db->update("tipo_cliente_rubros", $arrayUpdate);                   
        return true; 
  }   

  public function getMainList(){
  
        $select = $this->db->from("tipo_cliente_rubros")
                           ->where("tcr_estado", ST_ACTIVO);
        if($_POST['search'] != '')
        {
            $select->like("tcr_nombre", $_POST['search']);
        }                   

        $selectCount = clone $select;
        $rsCount = $selectCount->get()
                               ->result();
        $rows = count($rsCount);
        
        $rs_tcRubros = $select->limit($_POST['pageSize'],$_POST['skip'])
                              ->order_by("tcr_id", "desc")
                              ->get()
                              ->result();

        foreach($rs_tcRubros as $rs_tcRubro)
        {            
                $rs_tcRubro->tcr_precio_text = strtoupper(substr($rs_tcRubro->tcr_precio_text, 5));
                $rs_tcRubro->tcr_editar = "<a class='btn btn-default btn-xs btn_modificar_tcRubro' data-id='{$rs_tcRubro->tcr_id}' data-toggle='modal' data-target='#myModal'>Modificar</a>";
                $rs_tcRubro->tcr_eliminar = "<a class='btn btn-danger btn-xs btn_eliminar_tcRubro' data-id='{$rs_tcRubro->tcr_id}' data-msg='Desea eliminar Rubro: {$rs_tcRubro->tcr_nombre}?'>Eliminar</a>";
                    
        }

        $datos = [
                    'data' => $rs_tcRubros,
                    'rows' => $rows
                 ];
        return $datos;
  }
}