<?php
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;    
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

 class Cie extends CI_Controller
 {
 	public function __construct()
	{
		parent::__construct();


		$this->load->model('Cie_model');
		
	}
 	

 	public function index()
 	{
       
        $this->load->view('templates/header_administrador');
       $this->load->view('cie/basic_index');
        $this->load->view('templates/footer');   
 	}

 	public function crear(){

		$this->load->view('cie/modal_crear');
	}

	public function getMainList(){

		$rscies = $this->Cie_model->getMainList();
		//var_dump($rscies);exit;
	    echo json_encode($rscies);
	}

	public function editar($idCie){

		//echo $idCie;exit;
	   $data['cie'] = $this->Cie_model->select($idCie);
	   //var_dump($data['cie']);exit;
	   $this->load->view('cie/modal_crear',$data);
	}



	public function guardarCie(){

		$error = array();        
        if($_POST['descripcion'] == '')
        {
            $error['descripcion'] = 'falta ingresar descripcion';
        }
         if($_POST['codigo'] == '')
        {
            $error['codigo'] = 'falta ingresar codigo';
        }
        if(count($error) > 0)
        {
            $data = ['status'=>STATUS_FAIL,'tipo'=>1, 'errores'=>$error];
            echo json_encode($data);
            exit();
        }   

        //guardamos la especialidad
        $result = $this->Cie_model->guardarcie();
        if($result)
        {
            echo json_encode(['status'=>STATUS_OK]);
            exit();
        }else
        {
            echo json_encode(['status'=>STATUS_FAIL, 'tipo'=>2]);
            exit();
        }   
	}

	public function eliminar($idCie){

		$result = $this->Cie_model->eliminar($idCie);		
		if($result){
			echo json_encode(['status' => STATUS_OK]);
			exit();
		} else{
			echo json_encode(['status' => STATUS_FAIL]);
			exit();
		}
	}

	public function subirCie()
    {
        $this->load->view('cie/subir_cies');
    }

    public function generarCodPro() {        
        do {
        $existe=0;
            $codigo = rand(10000,99999);
            $result = $this->validarCodProd($codigo);

            if ($result) {
                $existe=1;
            }
        } while ($existe > 0);
        return $codigo;
    }
     public function validarCodProd($codigo='') {
        $result = $this->db->from("tipo_enfermedades")
                               ->where('codigo',$codigo)
                               ->get()
                               ->row();

        if ($result) {
            return true;
        }
        return false;        
    }

    public function guardarsubidacie()
    {
    	//echo sdfsdf ;exit;
    	$archivo = $_FILES['files'];
        
        //establecemos la ruta desde donde leeremos
        $rutaArchivo = $archivo['tmp_name'];
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($rutaArchivo);
        $sheet = $spreadsheet->getActiveSheet();
        $arrayProductos = array();

        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
        foreach($sheet->getRowIterator(2) as $row)
        {
            $cie = array();
            $codigo = $sheet->getCellByColumnAndRow('1', $row->getRowIndex())->getValue();
            $descripcion = $sheet->getCellByColumnAndRow('2', $row->getRowIndex())->getValue();
            // concatenamos el codigo con la descripcion
            $cie['descripcion'] = $codigo." - ".$descripcion;

            if ($cie['descripcion']=='') {
            	continue;
            } 
            //verificamos si existe el tipo de enfermedad
            $rscie=$this->db->from('tipo_enfermedades')
            				->where('codigo',$codigo)
            				->where('estado', ST_ACTIVO)
            				->get()
            				->row();
            
            if ($rscie) {
               continue;
            }

              if ($codigo=='') {
                $codigo = $this->generarCodPro();
            }

            $cie['codigo'] = $codigo;
            $cie['estado'] = ST_ACTIVO;
           
           $this->db->insert('tipo_enfermedades',$cie);
        }
    }

     public function exportarExcel() {

         //var_dump($this->uri->segment(3));exit;
        if($this->uri->segment(3)!='0') {
            $this->db->like('descripcion', $this->uri->segment(3));
        }
        
        $this->db->where('estado',ST_ACTIVO);

        $result = $this->db->from("tipo_enfermedades")                 
                           ->get()
                           ->result();
          //var_dump($result);exit;       

        /*EXPORTAR A EXCEL*/
        $spreadsheet = new Spreadsheet();         
        // Set workbook properties
        $spreadsheet->getProperties()->setCreator('Rob Gravelle')
                                     ->setLastModifiedBy('Rob Gravelle')
                                     ->setTitle('A Simple Excel Spreadsheet')
                                     ->setSubject('PhpSpreadsheet')
                                     ->setDescription('A Simple Excel Spreadsheet generated using PhpSpreadsheet.')
                                     ->setKeywords('Microsoft office 2013 php PhpSpreadsheet')
                                     ->setCategory('Test file');
        $i=2;

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(45);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
       
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', 'CODIGO')
                ->setCellValue('C1', 'DESCRIPCION');
               

        $spreadsheet->getActiveSheet()->setTitle('tipo_enfermedades');

        foreach ($result as $value) {
            //$fecha = (new DateTime($value->prof_doc_fecha))->format('d/m/Y');
            $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$i, $value->id)
                        ->setCellValue('B'.$i, $value->codigo)
                        ->setCellValue('C'.$i, $value->descripcion);
                    
            $i++;
        }
        
        $spreadsheet->setActiveSheetIndex(0);         
        // Redirect output to a client's web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_proformas.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');       
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }


 } 
 ?>