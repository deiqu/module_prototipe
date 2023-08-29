<?php include('include/header.php') ?>
<?php include('database.php') ?>

<div class="container">
    <div class="columns">
        <div class="column">
            <button class="button is-primary" id="showModal">Crear Acta</button>
        </div>
    </div>
</div>

<div class="table-container">
    <table id="myTable" class="table is-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Numero</th>
                <th>Fecha</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Emisor</th>
                <th>Receptor</th>
                <th>Detalles</th>
                <th>Comentario</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM tabla_actas";
            $result_form = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result_form)) { ?>
                <tr>
                    <td><?php echo $row['tipo_acta'] ?></td>
                    <td><?php echo $row['numero_acta'] ?></td>
                    <td><?php echo $row['fecha_acta'] ?></td>
                    <td><?php echo $row['origen'] ?></td>
                    <td><?php echo $row['destino'] ?></td>
                    <td><?php echo $row['emisor'] ?></td>
                    <td><?php echo $row['receptor'] ?></td>
                    <td><?php echo $row['detalles_envio'] ?></td>
                    <td><?php echo $row['comentario'] ?></td>
                    <td><?php echo $row['imagen_acta'] ?></td>
                    <td>
                        <a href="edit.php?ID=<?php echo $row['ID']; ?>" class="button is-small is-warning">Editar</a>
                        <a href="delete.php?ID=<?php echo $row['ID']; ?>" class="button is-small is-danger">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal" id="createModal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <form action="save.php" method="POST" enctype="multipart/form-data">
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Tipo de acta:</label>
                            <div class="control">
                                <div class="select">
                                    <select id="tipo_acta" name="tipo_acta">
                                        <option>Entrada</option>
                                        <option>Salida</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Fecha de creación:</label>
                            <div class="control">
                                <input type="date" name="fecha_acta" id="fecha_acta" class="input" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Origen:</label>
                            <div class="control">
                                <input type="text" id="origen" name="origen" placeholder="Ingrese origen" class="input" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Destino:</label>
                            <div class="control">
                                <input type="text" id="destino" name="destino" placeholder="Ingrese destino" class="input" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Emisor:</label>
                            <div class="control">
                                <input type="text" id="emisor" name="emisor" placeholder="Ingrese emisor" class="input" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Receptor:</label>
                            <div class="control">
                                <input type="text" id="receptor" name="receptor" placeholder="Ingrese receptor" class="input" required>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Detalle:</label>
                            <div class="control">
                                <textarea class="textarea" id="detalles_envio" name="detalles_envio" placeholder="Ingrese detalles" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Comentarios:</label>
                            <div class="control">
                                <textarea class="textarea" id="comentario" name="comentario" placeholder="Ingrese comentario" required></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Subir imagen:</label>
                            <div class="control">
                            <input type="file" name="imagen_acta">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="save" class="button is-primary">Crear</button>
                    </div>
                    <div class="control">
                        <button class="button" id="closeModal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="closeModal"></button>
</div>
<?php include('include/footer.php') ?>