    <main class="contenedor">
        <h1>Sobre Nosotros</h1>
        <?php include 'iconos.php'; ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y chalets en Venta</h2>

        <?php 
            include 'listado.php';
        ?>
        
        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todo</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, iusto veritatis delectus dolor minus minima perferendis error omnis dicta impedit nihil blanditiis tempora unde sapiente aliquam rerum esse corporis velit!</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>    
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img src="build/img/blog1.jpg" alt="Imaghen del blo1" loading="lazy">
                    </picture>
                </div>
                
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techjo de tu casa</h4>
                        <p class="info-meta">Escrito el <span>20/10/2022</span> por: <span>Admin</span></p>
                        <p>Consejos para contruir una terraza en el techo de tu casa sin escatimar en gastos! Todo lujo.</p>
                    </a>
                </div>
            </article> <!--.entrada-blog-->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" alt="Imaghen del blo1" loading="lazy">
                    </picture>
                </div>
                
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guia decoración de tu hogar</h4>
                        <p class="info-meta">Escrito el <span>20/10/2022</span> por: <span>Admin</span></p>
                        <p>Minimiza el espacio en tu hogar con nuestra guia, y tips de como decorar y ganar.</p>
                    </a>
                </div>
            </article><!--.entrada-blog-->
        </section>

        <section class="testimonios">
            <h3>Testimonios</h3>

            <div class="testimonio">
                <blockquote>
                    Increibles profecionales, se han portado de maravilla y nos han ayudado en todo momento.
                </blockquote>
                <p>- Eduard Badoyan</p>
            </div>
        </section>
    </div>
