<?PHP

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipo_cliente_rubros extends CI_Controller {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set('America/Lima');              
        $this->load->model('accesos_model');
        $this->load->model('tipo_cliente_rubros_model');
        $this->load->helper('ayuda');

        $empleado_id = $this->session->userdata('empleado_id');
        $almacen_id = $this->session->userdata("almacen_id");
        if (empty($empleado_id) or empty($almacen_id)) {
            $this->session->set_flashdata('mensaje', 'No existe sesion activa');
            redirect(base_url());
        }
    }
    
    public function index() {        
        $this->accesos_model->menuGeneral();
        $this->load->view('tipo_cliente_rubros/basic_index', $data);
        $this->load->view('templates/footer');      
    }           
    
    public function crear()
    {
        $data = array();
        echo $this->load->view('tipo_cliente_rubros/modal_crear', $data);
    }
    public function editar($tc_rubroId)
    {
        $data['tipo_cliente_rubro'] = $this->tipo_cliente_rubros_model->select($tc_rubroId);
        $this->load->view('tipo_cliente_rubros/modal_crear', $data);
    }
    public function guardarTipoClienteRubro() {
        $error = array();
        if($_POST['nombre'] == '')
        {
            $error['nombre'] = 'falta ingresar nombre';
        }
        if(count($error) > 0)
        {
            $data = ['status'=>STATUS_FAIL,'tipo'=>1, 'errores'=>$error];
            sendJsonData($data);
            exit();
        }   

        //guardamos la Tipo_cliente_rubros
        $result = $this->tipo_cliente_rubros_model->guardar();
        if($result)
        {
            sendJsonData(['status'=>STATUS_OK]);
            exit();
        }else
        {
            sendJsonData(['status'=>STATUS_FAIL, 'tipo'=>2]);
            exit();
        }
    }

    public function eliminar($tc_rubroId)
    {
        $result = $this->tipo_cliente_rubros_model->eliminar($tc_rubroId);
        if($result)
        {
            sendJsonData(['status'=>STATUS_OK]);
            exit();
        }else
        {
            sendJsonData(['status'=>STATUS_FAIL]);
            exit();
        }       
    }
    public function getMainList()
    {
        $rsDatos = $this->tipo_cliente_rubros_model->getMainList();
        sendJsonData($rsDatos);
    }

    //SELECT AUTOCOMPLETE 06-10-2020
    public function selectAutocomplete(){
        $rubro = $this->input->get('term');
        echo json_encode($this->tipo_cliente_rubros_model->selectAutocomplete($rubro));
    }      
}
?>

