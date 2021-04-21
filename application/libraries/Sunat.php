<?PHP


class Sunat {

 	public function __construct(){}        

	public function estadoComprobante($estadoComprobante){

		 switch ($estadoComprobante) {
            case '0':
                $estadoCp = '<p style="text-align:center;font-size:30px;background:#343333;color: white"><b>NO EXISTE - (Comprobante no informado)</b></p>';
                break;
            case '1':
                $estadoCp = '<p style="text-align:center;font-size:30px;background:#5cb85c;color:white"><b>ACEPTADO (Comprobante aceptado)</b></p>';
                break;
            case '2':
                $estadoCp = '<p style="text-align:center;font-size:30px;background:#d9534f;color: white"><b>ANULADO” (Comunicado en una baja)</b></p>';
                break;
            case '3':
                $estadoCp = '<p style="text-align:center;font-size:30px;background:#343333;color: white"><b>AUTORIZADO (con autorización de imprenta)</b></p>';
                break;
            case '4':
                $estadoCp = '<p style="text-align:center;font-size:30px;background:#FF3F33;color: white"><b>NO AUTORIZADO (no autorizado por imprenta)</b></p>';
                break;            
            default:
                # code...
                break;                
            }

            return $estadoCp;
	}


	public function estadoContribuyente($estadoContribuyente){
			//OBTENIENDO ESTADO DEL CONTRIBUYENTE
            switch ($estadoContribuyente) {
            case '00':
                $estadoRuc = 'ACTIVO';
                break;
            case '01':
                $estadoRuc = 'BAJA PROVISIONAL';
                break;
            case '02':
                $estadoRuc = 'BAJA PROV. POR OFICIO';
                break;
            case '03':
                $estadoRuc = 'SUSPENSION TEMPORAL';
                break;
            case '10':
                $estadoRuc = 'BAJA DEFINITIVA';
                break;            
            case '11':
                $estadoRuc = 'BAJA DE OFICIO';
                break;            
            case '22':
                $estadoRuc = 'INHABILITADO-VENT.UNICA';
                break;            
            default:
                # code...
                break;                
            }

            return $estadoRuc;
	}

	public function condDomiRuc($condDomiRuc){

			switch ($condDomiRuc) {
            case '00':
                $condDomiRuc = 'HABIDO';
                break;
            case '09':
                $condDomiRuc = 'PENDIENTE';
                break;
            case '11':
                $condDomiRuc = 'POR VERIFICAR';
                break;
            case '12':
                $condDomiRuc = 'NO HABIDO';
                break;
            case '20':
                $condDomiRuc = 'NO HALLADO';
                break;
            default:
                # code...
                break;                
            }     

            return $condDomiRuc;
	}
}
