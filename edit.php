<?php
include('database.php');

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = "SELECT * FROM tabla_actas WHERE ID = $ID";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $fecha_acta = $row['fecha_acta'];
        $origen = $row['origen'];
        $destino = $row['destino'];
        $emisor = $row['emisor'];
        $receptor = $row['receptor'];
        $detalles_envio = $row['detalles_envio'];
        $comentario = $row['comentario'];
        $imagen_acta = $row['imagen_acta'];
    }
}

if (isset($_POST['update'])) {
    $ID = $_GET['ID'];
    $fecha_acta = $_POST['fecha_acta'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $emisor = $_POST['emisor'];
    $receptor = $_POST['receptor'];
    $detalles_envio = $_POST['detalles_envio'];
    $comentario = $_POST['comentario'];

    if (isset($_FILES['imagen_acta']) && $_FILES['imagen_acta']['name'] !== "") {
        $imagen = $_FILES['imagen_acta'];
        $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $nombre_imagen = $numero_acta . '.' . $extension;
        $ruta_imagen = 'images/' . $nombre_imagen;
        move_uploaded_file($imagen['tmp_name'], $ruta_imagen);

        $query_update = "UPDATE tabla_actas SET imagen_acta='$nombre_imagen' WHERE ID=$ID";
        mysqli_query($conn, $query_update);

        if (!empty($imagen_acta)) {
            unlink('images/' . $imagen_acta);
        }
    }

    $query = "UPDATE tabla_actas SET fecha_acta ='$fecha_acta', origen='$origen', destino='$destino', emisor='$emisor', receptor='$receptor', detalles_envio='$detalles_envio', comentario='$comentario' WHERE ID=$ID";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>

<?php include('include/header.php') ?>
<div class="container">
    <form action="edit.php?ID=<?php echo $_GET['ID']; ?>" method="post" enctype="multipart/form-data" class="box">
        <div class="field">
            <label class="label">Fecha:</label>
            <div class="control">
                <input type="date" name="fecha_acta" id="fecha_acta" class="input" value="<?php echo $fecha_acta; ?>" readonly>
            </div>
        </div>
        <div class="field">
            <label class="label">Origen:</label>
            <div class="control">
                <input type="text" id="origen" name="origen" class="input" value="<?php echo $origen; ?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Destino:</label>
            <div class="control">
                <input type="text" id="destino" name="destino" class="input" value="<?php echo $destino; ?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Emisor:</label>
            <div class="control">
                <input type="text" id="emisor" name="emisor" class="input" value="<?php echo $emisor; ?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Receptor:</label>
            <div class="control">
                <input type="text" id="receptor" name="receptor" class="input" value="<?php echo $receptor; ?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Detalles:</label>
            <div class="control">
                <input type="text" id="detalles_envio" name="detalles_envio" class="input" value="<?php echo $detalles_envio; ?>">
            </div>
        </div>
        <div class="field">
            <label class="label">Comentario:</label>
            <div class="control">
                <input type="text" name="comentario" class="input" value="<?php echo $comentario; ?>">
            </div>
        </div>
        
        <div class="field">
            <label class="label">Imagen actual:</label>
            <?php if (!empty($imagen_acta)) : ?>
                <p><?php echo $imagen_acta; ?></p>
            <?php else : ?>
                <p>No hay imagen cargada.</p>
            <?php endif; ?>
        </div>
        <div class="field">
            <label class="label">Subir nueva imagen:</label>
            <div class="control">
                <input type="file" name="imagen_acta">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" name="update" class="button is-primary">Actualizar</button>
            </div>
            <div class="control">
                <a href="index.php" class="button">Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php include('include/footer.php') ?>