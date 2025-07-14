<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "casetas_inspeccion";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Recoger datos del formulario y convertir a mayúsculas
    function to_upper($str) {
        return mb_strtoupper($str, 'UTF-8');
    }

    $tipositioInspeccion = to_upper($_POST['tipositioInspeccion'] ?? '');
    $entidad = to_upper($_POST['entidad'] ?? '');
    $sitio = to_upper($_POST['sitio'] ?? '');
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';

    $Tipo_de_mercancia = to_upper($_POST['Tipo_de_mercancia'] ?? '');
    $doc_mov_presenta = to_upper($_POST['doc_mov_presenta'] ?? '');
    $Tipo_de_doc = to_upper($_POST['Tipo_de_doc'] ?? '');
    $folio_doc_mov = to_upper($_POST['folio_doc_mov'] ?? '');
    $tipo_revision = to_upper($_POST['tipo_revision'] ?? '');

    $mercancia = to_upper($_POST['mercancia'] ?? '');
    $variedad_mercancia = to_upper($_POST['variedad_mercancia'] ?? '');
    $P_mercancia = to_upper($_POST['P_mercancia'] ?? '');
    $tipo_embalaje = to_upper($_POST['tipo_embalaje'] ?? '');
    $cantidad = to_upper($_POST['cantidad'] ?? '');
    $peso = to_upper($_POST['peso'] ?? '');
    $cantidad_total = to_upper($_POST['cantidad_total'] ?? '');
    $unidad_medida = to_upper($_POST['unidad_medida'] ?? '');
    $motivo_mov = to_upper($_POST['motivo_mov'] ?? '');

    $estadoOrigen = to_upper($_POST['estadoOrigen'] ?? '');
    $municipioOrigen = to_upper($_POST['municipioOrigen'] ?? '');
    $estadoDestino = to_upper($_POST['estadoDestino'] ?? '');
    $municipioDestino = to_upper($_POST['municipioDestino'] ?? '');
    $empresaOrigen = to_upper($_POST['empresaOrigen'] ?? '');
    $empresaDestino = to_upper($_POST['empresaDestino'] ?? '');
    $tipoVehiculo = to_upper($_POST['tipoVehiculo'] ?? '');
    $descripcionVehiculo = to_upper($_POST['descripcionVehiculo'] ?? '');
    $placas = to_upper($_POST['placas'] ?? '');
    $fleje = to_upper($_POST['fleje'] ?? '');

    $FcumpleNoCumple = to_upper($_POST['FcumpleNoCumple'] ?? '');
    $FresultadoVerificacion = to_upper($_POST['FresultadoVerificacion'] ?? '');
    $FaccionResultante = to_upper($_POST['FaccionResultante'] ?? '');
    $FfolioActa = to_upper($_POST['FfolioActa'] ?? '');

    $EcumpleNoCumple = to_upper($_POST['EcumpleNoCumple'] ?? '');
    $EresultadoVerificacion = to_upper($_POST['EresultadoVerificacion'] ?? '');
    $EaccionResultante = to_upper($_POST['EaccionResultante'] ?? '');
    $EfolioActa = to_upper($_POST['EfolioActa'] ?? '');

    $numeroFolio = to_upper($_POST['numeroFolio'] ?? '');
    $fecha_deca = $_POST['fecha_deca'] ?? '';
    $productor = to_upper($_POST['productor'] ?? '');
    $numeroInscripcion = to_upper($_POST['numeroInscripcion'] ?? '');
    $numeroTarjeta = to_upper($_POST['numeroTarjeta'] ?? '');
    $localidad = to_upper($_POST['localidad'] ?? '');
    $predio = to_upper($_POST['predio'] ?? '');
    $noSello = to_upper($_POST['noSello'] ?? '');
    $campanasFitosanitarias = to_upper($_POST['campanasFitosanitarias'] ?? '');
    $expedidoEn = to_upper($_POST['expedidoEn'] ?? '');
    $fechaExpedicion = $_POST['fechaExpedicion'] ?? '';
    $diasVigencia = to_upper($_POST['diasVigencia'] ?? '');
    $jlsvAutoriza = to_upper($_POST['jlsvAutoriza'] ?? '');
    $personalInspeccion = to_upper($_POST['personalInspeccion'] ?? '');
    $observaciones = to_upper($_POST['observaciones'] ?? '');

    // Insertar en sitio_inspeccion
    $conn->query("INSERT INTO sitio_inspeccion (tipositioInspeccion, entidad, sitio, fecha, hora) VALUES ('$tipositioInspeccion', '$entidad', '$sitio', '$fecha', '$hora')");
    // Insertar en info_general
    $conn->query("INSERT INTO info_general (Tipo_de_mercancia, doc_mov_presenta, Tipo_de_doc, folio_doc_mov, tipo_revision) VALUES ('$Tipo_de_mercancia', '$doc_mov_presenta', '$Tipo_de_doc', '$folio_doc_mov', '$tipo_revision')");
    // Insertar en info_mercancia
    $conn->query("INSERT INTO info_mercancia (mercancia, variedad_mercancia, P_mercancia, tipo_embalaje, cantidad, peso, cantidad_total, unidad_medida, motivo_mov) VALUES ('$mercancia', '$variedad_mercancia', '$P_mercancia', '$tipo_embalaje', '$cantidad', '$peso', '$cantidad_total', '$unidad_medida', '$motivo_mov')");
    // Insertar en info_carga
    $conn->query("INSERT INTO info_carga (estadoOrigen, municipioOrigen, estadoDestino, municipioDestino, empresaOrigen, empresaDestino, tipoVehiculo, descripcionVehiculo, placas, fleje) VALUES ('$estadoOrigen', '$municipioOrigen', '$estadoDestino', '$municipioDestino', '$empresaOrigen', '$empresaDestino', '$tipoVehiculo', '$descripcionVehiculo', '$placas', '$fleje')");
    // Insertar en incumplimiento_federal
    $conn->query("INSERT INTO incumplimiento_federal (FcumpleNoCumple, FresultadoVerificacion, FaccionResultante, FfolioActa) VALUES ('$FcumpleNoCumple', '$FresultadoVerificacion', '$FaccionResultante', '$FfolioActa')");
    // Insertar en incumplimiento_estatal
    $conn->query("INSERT INTO incumplimiento_estatal (EcumpleNoCumple, EresultadoVerificacion, EaccionResultante, EfolioActa) VALUES ('$EcumpleNoCumple', '$EresultadoVerificacion', '$EaccionResultante', '$EfolioActa')");
    // Insertar en deca
    $conn->query("INSERT INTO deca (numeroFolio, fecha_deca, productor, numeroInscripcion, numeroTarjeta, localidad, predio, noSello, campanasFitosanitarias, expedidoEn, fechaExpedicion, diasVigencia, jlsvAutoriza, personalInspeccion, observaciones) VALUES ('$numeroFolio', '$fecha_deca', '$productor', '$numeroInscripcion', '$numeroTarjeta', '$localidad', '$predio', '$noSello', '$campanasFitosanitarias', '$expedidoEn', '$fechaExpedicion', '$diasVigencia', '$jlsvAutoriza', '$personalInspeccion', '$observaciones')");

    $conn->close();

    // Start HTML output
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Submission Result</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Formulario enviado con exito</h1>
            <p>Gracias por enviar su información. Esto es lo que recibimos:</p>';

    echo '<h2>Sitio de Inspeccion</h2><table>';
    echo '<tr><td>Tipo de Sitio de Inspeccion:</td><td>' . htmlspecialchars($tipositioInspeccion) . '</td></tr>';
    echo '<tr><td>Entidad:</td><td>' . htmlspecialchars($entidad) . '</td></tr>';
    echo '<tr><td>Sitio:</td><td>' . htmlspecialchars($sitio) . '</td></tr>';
    echo '<tr><td>Fecha:</td><td>' . htmlspecialchars($fecha) . '</td></tr>';
    echo '<tr><td>Hora:</td><td>' . htmlspecialchars($hora) . '</td></tr>';
    echo '</table>';

    echo '<h2>Informacion General</h2><table>';
    echo '<tr><td>Tipo de Mercancia:</td><td>' . htmlspecialchars($Tipo_de_mercancia) . '</td></tr>';
    echo '<tr><td>Documento de movilización:</td><td>' . htmlspecialchars($doc_mov_presenta) . '</td></tr>';
    echo '<tr><td>Tipo de documento de movilización:</td><td>' . htmlspecialchars($Tipo_de_doc) . '</td></tr>';
    echo '<tr><td>Folio del documento de movilizacion:</td><td>' . htmlspecialchars($folio_doc_mov) . '</td></tr>';
    echo '<tr><td>Tipo de Revision:</td><td>' . htmlspecialchars($tipo_revision) . '</td></tr>';
    echo '</table>';

    echo '<h2>Informacion de la Mercancia</h2><table>';
    echo '<tr><td>Mercancia:</td><td>' . htmlspecialchars($mercancia) . '</td></tr>';
    echo '<tr><td>Variedad de la mercancia:</td><td>' . htmlspecialchars($variedad_mercancia) . '</td></tr>';
    echo '<tr><td>Presentacion de la mercancia:</td><td>' . htmlspecialchars($P_mercancia) . '</td></tr>';
    echo '<tr><td>Tipo de embalaje:</td><td>' . htmlspecialchars($tipo_embalaje) . '</td></tr>';
    echo '<tr><td>Cantidad:</td><td>' . htmlspecialchars($cantidad) . '</td></tr>';
    echo '<tr><td>Peso:</td><td>' . htmlspecialchars($peso) . '</td></tr>';
    echo '<tr><td>Cantidad Total:</td><td>' . htmlspecialchars($cantidad_total) . '</td></tr>';
    echo '<tr><td>Unidad de medida:</td><td>' . htmlspecialchars($unidad_medida) . '</td></tr>';
    echo '<tr><td>Motivo de movilizacion:</td><td>' . htmlspecialchars($motivo_mov) . '</td></tr>';
    echo '</table>';

    echo '<h2>Informacion del Cargamento</h2><table>';
    echo '<tr><td>Estado origen:</td><td>' . htmlspecialchars($estadoOrigen) . '</td></tr>';
    echo '<tr><td>Municipio origen:</td><td>' . htmlspecialchars($municipioOrigen) . '</td></tr>';
    echo '<tr><td>Estado destino:</td><td>' . htmlspecialchars($estadoDestino) . '</td></tr>';
    echo '<tr><td>Municipio destino:</td><td>' . htmlspecialchars($municipioDestino) . '</td></tr>';
    echo '<tr><td>Empresa origen:</td><td>' . htmlspecialchars($empresaOrigen) . '</td></tr>';
    echo '<tr><td>Empresa destino:</td><td>' . htmlspecialchars($empresaDestino) . '</td></tr>';
    echo '<tr><td>Tipo de vehículo:</td><td>' . htmlspecialchars($tipoVehiculo) . '</td></tr>';
    echo '<tr><td>Descripción de vehículo:</td><td>' . htmlspecialchars($descripcionVehiculo) . '</td></tr>';
    echo '<tr><td>Placas:</td><td>' . htmlspecialchars($placas) . '</td></tr>';
    echo '<tr><td>Fleje:</td><td>' . htmlspecialchars($fleje) . '</td></tr>';
    echo '</table>';

    echo '<h2>Incumplimiento Federal</h2><table>';
    echo '<tr><td>Cumple / No cumple:</td><td>' . htmlspecialchars($FcumpleNoCumple) . '</td></tr>';
    echo '<tr><td>Resultado de la verificación e inspección:</td><td>' . htmlspecialchars($FresultadoVerificacion) . '</td></tr>';
    echo '<tr><td>Acción resultante:</td><td>' . htmlspecialchars($FaccionResultante) . '</td></tr>';
    echo '<tr><td>Folio del Acta Circunstanciada:</td><td>' . htmlspecialchars($FfolioActa) . '</td></tr>';
    echo '</table>';

    echo '<h2>Incumplimiento Estatal</h2><table>';
    echo '<tr><td>Cumple / No cumple:</td><td>' . htmlspecialchars($EcumpleNoCumple) . '</td></tr>';
    echo '<tr><td>Resultado de la verificación e inspección:</td><td>' . htmlspecialchars($EresultadoVerificacion) . '</td></tr>';
    echo '<tr><td>Acción resultante:</td><td>' . htmlspecialchars($EaccionResultante) . '</td></tr>';
    echo '<tr><td>Folio del Acta Circunstanciada:</td><td>' . htmlspecialchars($EfolioActa) . '</td></tr>';
    echo '</table>';

    echo '<h2>Datos de Expedición del Certificado de Aportación</h2><table>';
    echo '<tr><td>Número de Folio:</td><td>' . htmlspecialchars($numeroFolio) . '</td></tr>';
    echo '<tr><td>Fecha:</td><td>' . htmlspecialchars($fecha_deca) . '</td></tr>';
    echo '<tr><td>Productor:</td><td>' . htmlspecialchars($productor) . '</td></tr>';
    echo '<tr><td>Número de Inscripción:</td><td>' . htmlspecialchars($numeroInscripcion) . '</td></tr>';
    echo '<tr><td>Número de Tarjeta:</td><td>' . htmlspecialchars($numeroTarjeta) . '</td></tr>';
    echo '<tr><td>Localidad:</td><td>' . htmlspecialchars($localidad) . '</td></tr>';
    echo '<tr><td>Predio:</td><td>' . htmlspecialchars($predio) . '</td></tr>';
    echo '<tr><td>No. Sello:</td><td>' . htmlspecialchars($noSello) . '</td></tr>';
    echo '<tr><td>Campañas Fitosanitarias:</td><td>' . htmlspecialchars($campanasFitosanitarias) . '</td></tr>';
    echo '<tr><td>Expedido en:</td><td>' . htmlspecialchars($expedidoEn) . '</td></tr>';
    echo '<tr><td>Fecha de expedición:</td><td>' . htmlspecialchars($fechaExpedicion) . '</td></tr>';
    echo '<tr><td>Días de vigencia:</td><td>' . htmlspecialchars($diasVigencia) . '</td></tr>';
    echo '<tr><td>JLSV que autoriza:</td><td>' . htmlspecialchars($jlsvAutoriza) . '</td></tr>';
    echo '<tr><td>Personal que realiza la inspección:</td><td>' . htmlspecialchars($personalInspeccion) . '</td></tr>';
    echo '<tr><td>Observaciones:</td><td>' . htmlspecialchars($observaciones) . '</td></tr>';
    echo '</table>';

    // End HTML output
    echo '</div></body></html>';

    // Optionally, save to a file or database
    // file_put_contents('form_submissions.txt', print_r($formData, true), FILE_APPEND);
} else {
    // Not a POST request, redirect to form
    header("Location: index.html");
    exit();
}
?>
