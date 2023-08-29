<?php
include('database.php');

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];


    $query = "SELECT imagen_acta FROM tabla_actas WHERE ID = $ID";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $imagen_nombre = $row['imagen_acta'];


    $delete_query = "DELETE FROM tabla_actas WHERE ID = $ID";
    if (mysqli_query($conn, $delete_query)) {
        $ruta_imagen = 'images/' . $imagen_nombre;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen); // Elimina el archivo si existe en la carpeta
        }
        
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar registro: " . mysqli_error($conn);
    }

    $_SESSION['message'] = 'Registro eliminado con éxito';
    $_SESSION['message_type'] = 'success';

    header("Location: index.php");
} else {
    echo "ID no proporcionado.";
}
?>
