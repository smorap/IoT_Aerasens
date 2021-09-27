<!DOCTYPE html>
<html lang="en">
    <head> <!--child o hijo--><!--informacion acerca del documento, atributos y demas recursos necesarios-->
        <meta charset="UTF-8"><!--para el encoding,información acerca de la información-->
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- para mostrar bien el sitio basado en el dispositivo-->
        <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="/app/scss/style.css">
        <title>Aérasens</title> <!--Nombre en la pestaña-->
        <link rel="shortcut icon" href="/Images/Aérasens.png"><!--imagen de la pestaña-->

	</head>
    <!--head and body are called siblings/hermanos-->
    <body> <!--todo el contenido de la pagina web, contenido a ser renderizado por el navegador web-->
		<header class="header">
            <div class="overlay faded"></div>
            <!-- creacion visual para celular-->
            <nav class="container container--all flex flex-jc-sb flex-ai-c"> <!--navigation--> 
                <!-- clase de ayuda, esta en global-->
                <a href="http://aerasens.125mb.com/index.html" class="header__logo">
                    <!--para que el logo redireccione a la misma pagina-->
                    <img src="Images/Pruebalogo.svg" alt="Aérasens" /> <!--imagen del logo-->
                </a> 
            	<!-- para crear el menu de celular-->
                <a id="btnmenu" href="#" class="header__toggle hide-for-desktop">
                    <span></span>
					<span></span>
                    <span></span>
                </a>
                <!--para agregar los link de cada submenu-->
                <div class="header__links hide-for-mobile container--all"> 
                    <a href="#aerasens">Aérasens</a><a href="#usuarios">Usuarios</a><a href="#servicios">Servicios</a><a href="#product">Producto</a><a href="#contact">Contacto</a>
                </div>
                <!--botones-->
                <a href="/ingreso.html" class="button hide-for-mobile">Ingresar</a>
                <!--<a href="#" class="button hide-for-mobile">Registrarse</a>-->
                <!--<button type="button">Ingresar</button>-->
            </nav>
            <div class="header__menu faded">
                <a href="#aerasens">Aérasens</a>
                <a href="#usuarios">Usuarios</a>
                <a href="#servicios">Servicios</a>
                <a href="#product">Productos</a>
                <a href="#contact">Contacto</a>
            </div>
        </header>

        <section id="aerasens" class="hero"><!--Primera seccion del contenido/body-->
            <div class="container">
                <div class="hero__image"></div>
            <div class="hero__text container--Horizontal container--bottom">
                <h1>
                    Aérasens 
                </h1>
                <p>
                    Aérasens es un producto de domótica que consiste en un ambientador 
                    inteligente conectado a la red WI-FI del hogar, que realiza funciones 
                    de sensado de gases como:
                    <br>Gas Natural - Gas Metano - Monoxido de Carbono. 
                </p>
                <div class="hero__links">
                    <a href="/ingreso.php" class="button hero__user">Ingresar</a>
                   <!-- <a href="#" class="button hero__user">Registrarse</a>-->
                </div>
                
                </div>
            </div>
        </section>

        <section id="usuarios" class="user"><!--siguiente seccion en la pagina-->
            <div class="user__content container container--all">
                <div class="user__intro">
                    <h2>Usuarios</h2>
                    <p>En Aérasens es de gran interés el cuidado y seguridad de las personas, es por esto que nuestra solución de ambientador inteligente esta diseñado para proporcionar un nivel de seguridad extra en cuanto a los gases que se pueden encontrar en el ambiente y gases a los cuales nuestros usuarios podrían estar expuestos.
                    </p>
                    <div class="user__image"><img src="/Images/Cocina_1.jpg" alt="usuarios"></div>
                </div>
            </div>
            
        </section>
        
        <section class="services"><!--Seccion de prueba siguiente seccion en la pagina-->
            <!--<div class="services__content container container--all">
                <h2>Servicios</h2>
                <div class="services__grid">
                    
                    <div class="services__item">
                        <div class="services__icon"><img src="/Images/cloud.svg">
    
                            <div class="services__subtitle">
                                Almacenamiento en la nube
                            </div>
                            <div class="services__description">
                                descripcion de la Raspberry
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                 Aliquid, at aut doloribus quibusdam facilis quam expedita aspernatur,
                                  id eaque repudiandae totam voluptatibus molestiae ducimus deleniti, 
                                  sequi harum? Expedita, rem ratione?
                            </div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__icon"><img src="/Images/DataAnalitics.svg">
    
                            <div class="services__subtitle">
                                Analisis de datos en la web
                            </div>
                            <div class="services__description">
                                descripcion de la Raspberry
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                 Aliquid, at aut doloribus quibusdam facilis quam expedita aspernatur,
                                  id eaque repudiandae totam voluptatibus molestiae ducimus deleniti, 
                                  sequi harum? Expedita, rem ratione?
                            </div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__icon"><img src="/Images/Paginaweb.svg">
    
                            <div class="services__subtitle">
                                Alertas
                            </div>
                            <div class="services__description">
                                descripcion de la Raspberry
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                 Aliquid, at aut doloribus quibusdam facilis quam expedita aspernatur,
                                  id eaque repudiandae totam voluptatibus molestiae ducimus deleniti, 
                                  sequi harum? Expedita, rem ratione?
                            </div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__icon"><img src="/Images/warning.svg">
    
                            <div class="services__subtitle">
                                Pagina web
                            </div>
                            <div class="services__description">
                                descripcion de la Raspberry
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                 Aliquid, at aut doloribus quibusdam facilis quam expedita aspernatur,
                                  id eaque repudiandae totam voluptatibus molestiae ducimus deleniti, 
                                  sequi harum? Expedita, rem ratione?
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            
        </section>

        <section id="servicios" class="features"><!--siguiente seccion en la pagina-->
            <div class="feature__content container container--all">

                <h2>Servicios</h2>

                <div class="feature__grid">

                    <a href="#servicios" class="feature__item">
                        <div class="feature__image" style="background-image: url('/Images/DataAnalitics.svg');"> </div>
                        <div class="feature__text">
                            <div class="feature__author">Aérasens</div>
                            <div class="feature__title">Análisis de datos</div>
                            <div class="feature__description">
                                En Aérasens realizamos un análisis de los datos adquiridos por nuestras soluciones para ofrecer una experiencia personalizada a cada uno de nuestros clientes y asi comunicar información pertinente sobre el ambiente en el que se encuentra nuestro dispositivo.  
                            </div>
                        </div>
                    </a>

                    <a href="#servicios" class="feature__item">
                        <div class="feature__image" style="background-image: url('/Images/cloud.svg');"> </div>
                        <div class="feature__text">
                            <div class="feature__author">Aérasens</div>
                            <div class="feature__title">Base de Datos</div>
                            <div class="feature__description">
                                En Aérasens manejamos nuestro servicios en la nube para ofrecer una experiencia sin conflictos, teniendo toda la información necesaria para ser consultada por nuestros usuarios. 
                            </div>
                        </div>
                    </a>

                    <a href="#servicios" class="feature__item">
                        <div class="feature__image" style="background-image: url('/Images/Paginaweb.svg');"> </div>
                        <div class="feature__text">
                            <div class="feature__author">Aérasens</div>
                            <div class="feature__title">Sitio Web</div>
                            <div class="feature__description">
                                La pagina web de Aérasens se encuentra diseñada y construida para proporcionar una capa extra de personalización tanto para nuestros clientes actuales como para nuestros futuros clientes.
                            </div>
                        </div>
                    </a>

                    <a href="#servicios" class="feature__item">
                        <div class="feature__image" style="background-image: url('/Images/warning.svg');"> </div>
                        <div class="feature__text">
                            <div class="feature__author">Aérasens</div>
                            <div class="feature__title">Notificaciones</div>
                            <div class="feature__description">
                                En Aérasens nos importa tu seguridad y la de las personas que habitan tus espacios, es por esto que nuestro sistema en caso de detectar una anomalía en los gases del ambiente procederá a avisarte por medio de un mensaje en la cuenta de Twitter que el usuario prefiera.
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
        </section>

        <section id="product" class="product"><!--siguiente seccion del contenido/body-->
            <div class="product__content container container--all">
                <div class="product__text">
                    <h2>
                        Nuestro Producto 
                    </h2>
                    <p>
                        Con AÉRASENS, nuestro sistema al detectar alguna presencia alta de 
                        concentración de gases tóxicos notifica al usuario mediante alertas visuales, 
                        sonoras y en su cuenta de Twitter. Estas alertas estarán presentes tanto en el 
                        propio aparato como en la página web implementada. 
                    </p>
                    </div>
                <div class="product__image">
                    <img src="/Images/Arquitectura_de_alto_nivel_Página_1.png">
                </div>
                    
            </div>
        </section>

        <footer id="contact" class="footer"><!-- esta es la seccion de contacto-->
            <div class="container">
                <a class="footer__logo" href="http://aerasens.125mb.com/index.html">
                    <img src="/Images/Pruebalogo.svg" alt="Logo">
                </a>
                <div class="footer__social">
                    <a href="https://github.com/SaBuMa/IoT-Aerasens" target="_blank"><!--agregar el link de las paginas-->
                        <img src="/Images/GitHub-Mark_github white.svg" alt="Github">
                    </a>
                    <a href="https://www.instagram.com/aerasens/" target="_blank"><!--agregar el link de las paginas-->
                        <img src="/Images/Instagram-icon_Instagram.svg" alt="instagram">
                    </a>
                </div>
                <div class="footer__links col1">
                    <a href="#aerasens">Aérasens</a>
                    <a href="#usuarios">Usuarios</a>
                </div>
                <div class="footer__links col2">
                    <a href="#servicios">Servicios</a>
                    <a href="#product">Producto</a>
                </div>
                <div class="footer__btn">
                    <a href="#" class="button">Ingresar</a>
                </div>
                <div class="footer__copyright">
                    &copy; Aérasens. All rights reserve.
                </div>
            </div>
        </footer>
            
        <script src="/app/js/script.js">
        </script>
    </body>
</html>
