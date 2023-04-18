<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <br>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <?php include 'formulario.php'; ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>

</main>