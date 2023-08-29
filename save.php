<?php
include('database.php');

if (isset($_POST['save'])) {
    $tipo_acta = $_POST['tipo_acta'];
    $numero_acta = generateActaNumber($tipo_acta);
    $fecha_acta = $_POST['fecha_acta'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $emisor = $_POST['emisor'];
    $receptor = $_POST['receptor'];
    $detalles_envio = $_POST['detalles_envio'];
    $comentario = $_POST['comentario'];

    if (isset($_FILES['imagen_acta'])) {
        $imagen_acta = $_FILES['imagen_acta'];

        $nombre_uniq = uniqid() . '_' . $numero_acta . '_' . $imagen_acta['name'];
        $ruta = 'images/' . $nombre_uniq;

        move_uploaded_file($imagen_acta['tmp_name'], $ruta);
    }

    $query = "INSERT INTO tabla_actas (tipo_acta, numero_acta, fecha_acta, origen, destino, emisor, receptor, detalles_envio, comentario, imagen_acta) 
                  VALUES ('$tipo_acta','$numero_acta', '$fecha_acta', '$origen', '$destino', '$emisor', '$receptor', '$detalles_envio', '$comentario', '$nombre_uniq')";

    if (mysqli_query($conn, $query)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . mysqli_error($conn);
    }

    $_SESSION['message'] = 'Datos guardados con éxito';
    $_SESSION['message_type'] = 'success';

    header("Location: index.php");
}

function generateActaNumber($tipo_acta)
{
    global $conn;

    $prefix = ($tipo_acta == 'Entrada') ? 'AE' : 'AS';

    $query = "SELECT MAX(numero_acta) AS max_numero FROM tabla_actas WHERE tipo_acta = '$tipo_acta'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $max_numero = $row['max_numero'];

    if ($max_numero) {
        $last_number = (int)substr($max_numero, -6);
        $new_number = $last_number + 1;
        $new_number_padded = str_pad($new_number, 6, '0', STR_PAD_LEFT);

        return $prefix . '-' . $new_number_padded;
    } else {
        return $prefix . '-000001';
    }
}
