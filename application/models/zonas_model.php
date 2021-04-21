<?PHP

class Zonas_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

 public function select($zonaId = ''){

  if ($zonaId == '') {
       $rsZonas = $this->db->from("zonas")
                           ->where("zon_estado", ST_ACTIVO)
                           ->get()
                           ->result();
         return $rsZonas;
  } else{

      $rsZona = $this->db->from("zonas")
                         ->where("zon_id",$zonaId)
                         ->get()
                         ->row();
        return $rsZona;
    }
  }

  public function guardar() {
        if($_POST['id']!='') {
            $dataUpdate = [
                            'zon_nombre'    => strtoupper($_POST['nombre'])
                          ];
            $this->db->where('zon_id', $_POST['id']);
            $this->db->update('zonas', $dataUpdate);                          
        } else {
            $dataInsert = [
                            'zon_nombre'    => strtoupper($_POST['nombre']),
                            'zon_estado'    => ST_ACTIVO
                          ];
            $this->db->insert('zonas', $dataInsert);              
        }
        return true;
    } 

    public function eliminar($zonaId) {

        $zonaUpdate = [
                              "zon_estado" => ST_ELIMINADO
                           ];
        $this->db->where("zon_id", $zonaId);
        $this->db->update("zonas", $zonaUpdate);
        return true; 
    }   

    public function getMainList()
    {
        $select = $this->db->from("zonas")
                           ->where("zon_estado", ST_ACTIVO);
        if($_POST['search'] != '')
        {
            $select->like("zon_nombre", $_POST['search']);
        }                   

        $selectCount = clone $select;
        $rsCount = $selectCount->get()
                               ->result();
        $rows = count($rsCount);
        
        $rsZonas = $select->limit($_POST['pageSize'],$_POST['skip'])
                              ->order_by("zon_id", "desc")
                              ->get()
                              ->result();

        foreach($rsZonas as $rsZona)
        {            
                $rsZona->zon_editar = "<a class='btn btn-default btn-xs btn_modificar_zona' data-id='{$rsZona->zon_id}' data-toggle='modal' data-target='#myModal'>Modificar</a>";
                $rsZona->zon_eliminar = "<a class='btn btn-danger btn-xs btn_eliminar_zona' data-id='{$rsZona->zon_id}' data-msg='Desea eliminar la Zona: {$rsZona->zon_nombre}?'>Eliminar</a>";            
        }

        $datos = [
                    'data' => $rsZonas,
                    'rows' => $rows
                 ];
        return $datos;      
    }
}