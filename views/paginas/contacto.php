    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Rellena el formulario</h2>

        <?php if ($mensaje) { ?>
                <p class='alerta exito'><?php echo $mensaje; ?></p>
        <?php } ?>
        
        <form action="/contacto" method="POST" class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" >





                <label for="mensaje">Mensaje:</label>
                <textarea name="contacto[mensaje]" id="mensaje" cols="30" rows="10" ></textarea>

            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o Compra</label>
                <select name="contacto[tipo]" id="opciones" >
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="Presupuesto">Presupuesto o Preció</label>
                <input type="number" placeholder="Tu Presupuesto" id="Presupuesto" name="contacto[precio]" >

            </fieldset>
            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" >

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" id="contactar-email" value="email" name="contacto[contacto]" >
                </div>

                <div id="contacto"></div>



            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>