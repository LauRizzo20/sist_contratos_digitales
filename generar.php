<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        
        //$this->Image('imagen.jpg', 0, 0, 210, 297);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Contrato de servicio:', 0, 1);
    }

    function Footer()
    {

        $this->SetY(-1);
       
    }
}

//Crear un nuevo objeto PDF
$pdf = new PDF();

//$pdf->SetAutoPageBreak(false);

$pdf->AddPage();

//Obtener valores de los campos del formulario

$nombre_comp = $_POST['nombre_comp'];
$nombre_rasonsocial = $_POST['nombre_rasonsocial'];
$tipo_documento = $_POST['tipo_documento'];
$documento = $_POST['documento'];
$fotocopia = $_POST['fotocopia'];
$nro_partida = $_POST['nro_partida'];
$email = $_POST['email'];
$tel_fijo = $_POST['tel_fijo'];
$cel = $_POST['cel'];


//Domicilio
$calle = $_POST['calle'];
$calle1 = $_POST['calle1'];
$calle2 = $_POST['calle2'];
$nro = $_POST['numero'];
$calle_inmb = $_POST['calle_inmb'];
$calle1_inmb = $_POST['calle1_inmb'];
$calle2_inmb = $_POST['calle2_inmb'];
$nro_inmb = $_POST['numero_inmb'];
$piso = $_POST['piso'];
$dpto = $_POST['dpto'];
$postal = $_POST['postal'];
$localidad = $_POST['localidad'];
$provincia = $_POST['provincia'];
$circunscripcion = $_POST['circunscripcion'];
$seccion = $_POST['seccion'];
$manzana = $_POST['manzana'];
$parcela = $_POST['parcela'];
$unidad_funcional = $_POST['unidad_funcional'];
$poligono = $_POST['poligono'];

$fotocopia_comp = $_POST['fotocopia_comp'];

//Matriculado
$nom_matricula = $_POST['nom_matricula'];
$nro_matricula = $_POST['nro_matricula'];
$dom_matricula = $_POST['dom_matricula'];
$tel_matricula = $_POST['tel_matricula'];


//Servicios
$servicio = $_POST['servicio'];
$tipo_ser = $_POST['tipo_ser'];

//Campos de Declaración Jurada del Solicitante
$dec_nombre = $_POST['dec_nombre'];
$dec_documento = $_POST['dec_documento'];
$caracter = $_POST['caracter'];

//Resolucion
$resolucion_dia = $_POST['resolucion_dia'];
$resolucion_mes = $_POST['resolucion_mes'];
$resolucion_ano = $_POST['resolucion_ano'];
$nro_asociado = $_POST['nro_asociado'];
$solicitud_aceptada = $_POST['solicitud_aceptada'];
$cuotas = $_POST['cuotas'];


//Firma
$aclaracion = $_POST['aclaracion'];
$signatureData = $_POST['signature'];

// Campos de Prestador del Servicio
$prestador = $_POST['prestador'];

//logos
$arba = 'logos/logo_arba.png';
$afip = 'logos/logo_afip.png';
$cos = 'logos/logo_cos.png';

  //Decodificar los datos de la firma base64 a una imagen
  $decodedSignature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));

  if ($decodedSignature === false) {
    die('Error al decodificar la firma base64.');
  }

  // Guarda la imagen en el servidor / local
  $imageFilename = 'signature.png';

  if (file_put_contents($imageFilename, $decodedSignature) === false) {
    die('Error al guardar la imagen en el servidor.');
  }





if (
  !empty($nombre_comp) &&
  !empty($nombre_rasonsocial) &&
  !empty($documento) &&
  !empty($nro_partida) &&
  !empty($email) &&
  !empty($tel_fijo) &&
  !empty($cel) &&
  !empty($calle) &&
  !empty($calle1) &&
  !empty($calle2) &&
  !empty($nro) &&
  !empty($calle_inmb) &&
  !empty($calle1_inmb) &&
  !empty($calle2_inmb) &&
  !empty($nro_inmb) &&
  !empty($piso) &&
  !empty($dpto) &&
  !empty($postal) &&
  !empty($localidad) &&
  !empty($provincia) &&
  !empty($circunscripcion) &&
  !empty($seccion) &&
  !empty($manzana) &&
  !empty($parcela) &&
  !empty($unidad_funcional) &&
  !empty($poligono) &&
  !empty($nom_matricula) &&
  !empty($nro_matricula) &&
  !empty($dom_matricula) &&
  !empty($tel_matricula) &&
  !empty($dec_nombre) &&
  !empty($dec_documento) &&
  !empty($caracter) &&
  !empty($resolucion_dia) &&
  !empty($resolucion_mes) &&
  !empty($resolucion_ano) &&
  !empty($nro_asociado) &&
  !empty($cuotas) &&
  !empty($aclaracion) &&
  !empty($signatureData) &&
  !empty($imageFilename)
) {

  
/* Contrato Arba */


// Incluir la información en el PDF
$pdf->SetFont('Arial', '', 9);


$pdf->Image($arba, 165, 10, 30, 20);

$pdf->Cell(0, 10, '- Nombre o Razon Social: ' . $nombre_rasonsocial, 0, 1);
switch ($tipo_documento) {
  case 0:
  $pdf->Cell(0, 10, '- Tipo documento: CUIT', 0, 1);
  break;
  case 1:
  $pdf->Cell(0, 10, '- Tipo documento: CUIL', 0, 1);
  break;
  case 2:
  $pdf->Cell(0, 10, '- Tipo documento: CDI', 0, 1);
  break; 
  case 3:
  $pdf->Cell(0, 10, '- Tipo documento: DNI/LE/LC', 0, 1);
  break;
  case 4:
  $pdf->Cell(0, 10, '- Tipo documento: Pasaporte', 0, 1);
  break;
};
$pdf->Cell(0, 10, '- Documento: '.$documento, 0, 1);
switch ($fotocopia) {
  case 0:
  $pdf->Cell(0, 10, '- Fotocopia: Si', 0, 1);
  break;
  case 1:
  $pdf->Cell(0, 10, '- Fotocopia: No', 0, 1);
  break;
};
$pdf->Cell(0, 10, '- Numero de Partida: ' . $nro_partida, 0, 1);



$pdf->Cell(0, 10, '- Domicilio: ', 0, 1);
$pdf->Cell(0, 10, 'Calle: ' . $calle.' numero ' . $nro .' entre ' . $calle1.' y ' . $calle2, 0, 1);
$pdf->Cell(0, 10, 'Piso: ' . $piso.' - Departamento: ' . $dpto.' - Codigo Postal: ' . $postal, 0, 1);
$pdf->Cell(0, 10, 'Localidad: ' . $localidad, 0, 1);

$pdf->Cell(0, 10, '- Declaracion Jurada del Solicitante:', 0, 1);
$pdf->Cell(0, 10, 'El que suscribe ' . $dec_nombre.', con documento ' . $dec_documento .' en su caracter de ' . $caracter, 0, 1);
$pdf->Cell(0, 10, 'Declara que todos los datos aportados en este formulario son fiel expresion de la verdad,', 0, 1);
$pdf->Cell(0, 10, 'no habiendose omitido ni falseado ninguno de ellos.', 0, 1);
$pdf->Cell(0, 10, '- Firma: ', 0, 1);
if (file_exists($imageFilename)) {
  $pdf->Image($imageFilename, 30, 140, 60, 40);
} else {
  die('Error al cargar la imagen de la firma.');
}
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 50, '- Espacio reservado para el prestador del servicio:', 0, 10, 'L', 0);

switch ($prestador) {
  case 0:
  $pdf->Cell(0, -28, 'Completo los datos pero presento las fotocopias solicitadas.', 0, 10, 'L', 0);
  break;
  case 1:
  $pdf->Cell(0, -28, 'Completo los datos pero no presento las fotocopias solicitadas.', 0, 10, 'L', 0);
  break;
  case 2:
  $pdf->Cell(0, -28, 'Completo parcialmente los datos y presento la fotocopia solicitada.', 0, 10, 'L', 0);
  break;
  case 3:
  $pdf->Cell(0, -28, 'Completo parcialmente los datos pero no presento la fotocopia solicitada.', 0, 10, 'L', 0);
  break;
  case 4:
  $pdf->Cell(0, -28, 'No completo los datos, no presento la fotocopia y se nego a firmar.', 0, 10, 'L', 0);
  break;
}



$pdf->addPage();


/* Consejo de administracion */
$pdf->Image($afip, 165, 10, 30, 20);

$pdf->Cell(0, 10, '- Fecha ' . $resolucion_dia.'/'.$resolucion_mes.'/'.$resolucion_ano, 0, 1);

$pdf->Cell(0, 10, '- Nombre completo: ' . $nombre_comp, 0, 1);

$pdf->Cell(0, 10, '- Documento y tipo: '.$dec_documento, 0, 1);
$pdf->Cell(0, 10, '- Domicilio real: ', 0, 1);
$pdf->Cell(0, 10, 'Calle: ' . $calle.' numero ' . $nro .' entre ' . $calle1.' y ' . $calle2, 0, 1);
$pdf->Cell(0, 10, 'Piso: ' . $piso.' - Departamento: ' . $dpto.' - Codigo Postal: ' . $postal, 0, 1);
$pdf->Cell(0, 10, 'Localidad: ' . $localidad .' - Provincia: ' . $provincia, 0, 1);


$pdf->Cell(0, 10, 'Por medio de la presente elevo al Consejode Administracion, mi solicitud para asociarme a la', 0, 1);
$pdf->Cell(0, 10, 'cooperativa , con el fin de una vez aprobada la misma solicitar el o los servicios de:', 0, 1);
switch ($servicio) {
  case 0:
  $pdf->Cell(0, 10, '- Agua corriente', 0, 1);
  break;
  case 1:
  $pdf->Cell(0, 10, '- Cloacas', 0, 1);
  break;
  case 2:
  $pdf->Cell(0, 10, '- X', 0, 1);
  break; 
  case 3:
  $pdf->Cell(0, 10, '- X', 0, 1);
  break;
  case 4:
  $pdf->Cell(0, 10, '- X', 0, 1);
  break;
};

$pdf->Cell(0, 10, 'En caso de servicio a un inmueble:', 0, 1);
$pdf->Cell(0, 10, 'Calle: ' . $calle_inmb.' numero ' . $nro_inmb .' entre ' . $calle1_inmb.' y ' . $calle2_inmb, 0, 1);
$pdf->Cell(0, 10, 'Circunscripcion: ' . $circunscripcion.' - Seccion: ' . $seccion .' - Parcela: ' . $parcela.' -Manzana: ' . $manzana.' - Unidad Funcional: ' . $unidad_funcional.' - Poligono: '. $poligono, 0, 1);
$pdf->Cell(0, 10, '- Firma: ', 0, 1);
if (file_exists($imageFilename)) {
  $pdf->Image($imageFilename, 20, 135, 60, 40);
} else {
  die('Error al cargar la imagen de la firma.');
}

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '- Resolucion del Consejo de administracion: ', 0, 1);
$pdf->Cell(0, 10, 'Fecha ' . $resolucion_dia.'/'.$resolucion_mes.'/'.$resolucion_ano, 0, 1);
$pdf->Cell(0, 10, 'Numero Asociado: ' . $nro_asociado, 0, 1);
switch ($solicitud_aceptada) {
    case 1:
    $pdf->Cell(0, 10, '- Solicitud aceptada', 0, 1);
    break;
    case 0:
    $pdf->Cell(0, 10, '-Solicitud deneada', 0, 1);
    break;
  }
$pdf->Cell(0, 10, '- Cuotas sociales suscriptas: ' . $cuotas, 0, 1);

$pdf->addPage();

/* ADC */

$pdf->Image($cos, 165, 10, 30, 30);
$pdf->Cell(0, 10, '- Fecha ' . $resolucion_dia.'/'.$resolucion_mes.'/'.$resolucion_ano, 0, 1);
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, 'Adehsion al servisio de envio de factura por mail', 0, 1);
$pdf->Cell(0, 10, '', 0, 1);

$pdf->Cell(0, 10, '- Datos del inmueble donde se prestara servicio: ' , 0, 1);
$pdf->Cell(0, 10, 'Calle: ' . $calle_inmb.' numero ' . $nro_inmb .' entre ' . $calle1_inmb.' y ' . $calle2_inmb, 0, 1);
$pdf->Cell(0, 10, 'Circunscripcion: ' . $circunscripcion.' - Seccion: ' . $seccion .' - Parcela: ' . $parcela.' -Manzana: ' . $manzana.' - Unidad Funcional: ' . $unidad_funcional.' - Poligono: '. $poligono, 0, 1);
$pdf->Cell(0, 10, '- Apellido y nombre del titular de la cuenta de asociado: ' . $nombre_comp, 0, 1);
$pdf->Cell(0, 10, '- DNI: ' . $dec_documento, 0, 1);
$pdf->Cell(0, 10, '- Domicilio real: ' , 0, 1);
$pdf->Cell(0, 10, 'Calle: ' . $calle.' numero ' . $nro .' entre ' . $calle1.' y ' . $calle2, 0, 1);
$pdf->Cell(0, 10, '- Localidad: ' . $localidad, 0, 1);
$pdf->Cell(0, 10, '- Codigo Postal: ' . $postal, 0, 1);
$pdf->Cell(0, 10, '- E-mail: ' . $email, 0, 1);
$pdf->Cell(0, 10, '- Telefono fijo: ' . $tel_fijo, 0, 1);
$pdf->Cell(0, 10, '- Celular: ' . $cel, 0, 1);
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '- Firma: ', 0, 1);
if (file_exists($imageFilename)) {
  $pdf->Image($imageFilename, 20, 190, 60, 40);
} else {
  die('Error al cargar la imagen de la firma.');
}


$pdf->addPage();

/*  */

$pdf->Image($cos, 165, 10, 30, 30);
$pdf->Cell(0, 10, '- Fecha ' . $resolucion_dia.'/'.$resolucion_mes.'/'.$resolucion_ano, 0, 1);
$pdf->Cell(0, 10, '- Asociado nro: ' . $nro_asociado, 0, 1);


$pdf->Cell(0, 10, 'El que suscribe ' . $dec_nombre.' en su caracter de ' . $caracter, 0, 1);
$pdf->Cell(0, 10, 'Del bien/sitio en calle ' . $calle_inmb.' numero ' . $nro_inmb .' entre ' . $calle1_inmb.' y ' . $calle2_inmb, 0, 1);
$pdf->Cell(0, 10, 'Cuya nomenclatura catastral se indica a continuacion:', 0, 1);
$pdf->Cell(0, 10, 'Circunscripcion: ' . $circunscripcion.' - Seccion: ' . $seccion .' - Parcela: ' . $parcela.' -Manzana: ' . $manzana.' - Unidad Funcional: ' . $unidad_funcional.' - Poligono: '. $poligono, 0, 1);
$pdf->Cell(0, 10, 'Numero de partida: ' . $nro_partida, 0, 1);

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, 'Servicio: ', 0, 1);
switch ($servicio) {
    case 0:
    $pdf->Cell(0, 10, '- Agua corriente', 0, 1);
    break;
    case 1:
    $pdf->Cell(0, 10, '- Cloacas', 0, 1);
    break;
    case 2:
    $pdf->Cell(0, 10, '- X', 0, 1);
    break; 
    case 3:
    $pdf->Cell(0, 10, '- X', 0, 1);
    break;
    case 4:
    $pdf->Cell(0, 10, '- X', 0, 1);
    break;
  };
  $pdf->Cell(0, 10, 'Tipo de servicio: ', 0, 1);
  switch ($tipo_ser) {
    case 0:
    $pdf->Cell(0, 10, '- B.publico', 0, 1);
    break;
    case 1:
    $pdf->Cell(0, 10, '- B.Privado', 0, 1);
    break;
    case 2:
    $pdf->Cell(0, 10, '- P.cocina', 0, 1);
    break; 
    case 3:
    $pdf->Cell(0, 10, '- L.esp', 0, 1);
    break;
    case 4:
    $pdf->Cell(0, 10, '- Camara', 0, 1);
    break;
    case 5:
    $pdf->Cell(0, 10, '- Indice', 0, 1);
    break;
  };

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '- Matriculado autorizado:', 0, 1);
$pdf->Cell(0, 10, 'Sr ' . $nom_matricula.', Matricula nro ' . $nro_matricula .' con domicilio en ' . $dom_matricula, 0, 1);
$pdf->Cell(0, 10, 'Tel ' . $tel_matricula, 0, 1);

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '- Propietario:', 0, 1);
$pdf->Cell(0, 10, 'Firma: ', 0, 1);
if (file_exists($imageFilename)) {
  $pdf->Image($imageFilename, 20, 195, 60, 40);
} else {
  die('Error al cargar la imagen de la firma.');
}

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, 'Aclaracion: ' . $aclaracion, 0, 1);



$pdf->Output('formulario_contrato.pdf','D'); //Descarga del pdf generado
//$pdf->Output(); //Muestra del pdf generado


} else {
  // Al menos una variable no está definida o es nula
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Error</title>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function (){
    Swal.fire({
          icon: 'error',
          title: 'Formulario incompleto',
          text: 'Por favor, rellene todos los datos antes de continuar'
      }).then((result) => {
          if (result.isConfirmed) {
              history.back();
          } 
        });
  });
    </script>
  </body>
  </html>
  <?php
}

?>
