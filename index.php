<?php
$maxlifetime = 3600;
$secure = true;
$httponly = true;
$samesite = 'Lax';

session_set_cookie_params([
    'lifetime' => $maxlifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $secure,
    'httponly' => $httponly,
    'samesite' => $samesite
]);
session_start();
include 'get_news.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    // echo $_SESSION['csrf_token'];
}
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'self'");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- bootstrap grid css -->
    <link rel="stylesheet" href="css/plugins/bootstrap-grid.css">
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/plugins/font-awesome.min.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="css/plugins/swiper.min.css">
    <!-- itsulu css -->
    <link rel="stylesheet" href="css/style.css">
    <title>RALKTECH</title>
    <link rel="icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <style>
        @media (max-width: 768px),
        (max-width: 1024px) {

            .mil-main-image,
            .icon-image {
                width: 80%;
                height: auto;
                margin: 0 auto;
            }

            .title-image {
                width: 70%;
            }

            .services-list li {
                font-size: 0.9em;
                margin: 8px 0;
            }
        }

        .container {
            padding: 20px;
        }

        .icon-text-container {
            display: flex;
            align-items: flex-start;
        }

        .icon-container {
            margin-top: 20px;
            padding-right: 40px;
        }

        .text-container {
            display: flex;
            flex-direction: column;
        }

        .title-image {
            margin-bottom: 10px;
        }

        .services-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .services-list li {
            font-size: 1.2em;
            color: #333;
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <!-- wrapper -->
    <div class="mil-wrapper">
        <!-- top bar -->
        <div class="mil-top-position mil-fixed">
            <div class="mil-top-panel mil-top-panel-transparent mil-animated">
                <!-- mil-top-panel-transparent -->
                <div class="container">
                    <a href="index.php" class="mil-logo" style="width: 140px"></a>
                    <div class="mil-navigation">
                        <nav>
                            <ul>
                                <!-- <li class="mil-has-children">
                                    <a href="#.">Nosotros</a>
                                </li> -->
                                <li class="mil-has-children">
                                    <a href="#soluciones">Soluciones</a>
                                </li>
                                <li class="mil-has-children">
                                    <a href="#exito">Casos de Éxito</a>
                                </li>
                                <li class="mil-has-children">
                                    <a href="servicios.php">Servicios</a>
                                </li>
                                <li class="mil-has-children">
                                    <a href="#.">Industrias</a>
                                    <ul>
                                        <li><a href="salud_y_telemedicina.php">Salud y Telemedicina</a></li>
                                        <li><a href="manufactura_y_logistica.php">Manufactura y Lógistica</a></li>
                                        <li><a href="Financieras_y_Bancarias.php">Financieras y Bancarias</a></li>
                                        <li><a href="Comercio_electronico.php">Comercio Electrónico y Retail</a></li>
                                        <li><a href="Startups_y_tecnologia.php">Startups y Tecnología</a></li>
                                    </ul>
                                </li>
                                <li class="mil-has-children">
                                    <a href="#contacto">Contacto</a>
                                </li>
                                <li class="mil-has-children">
                                    <a href="login.php">Personal</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- mobile menu button -->
                    <div class="mil-menu-btn">
                        <span></span>
                    </div>
                    <!-- mobile menu button end -->
                </div>
            </div>
        </div>
        <div class="mil-banner mil-top-space-0">
            <div class="swiper-container mil-banner-slideshow">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="img\banners\RALKTECH_webBanner05_V2.png" class="" style="object-position: center" data-swiper-parallax="-100" data-swiper-parallax-scale="1.1" alt="image">
                    </div>
                </div>
            </div>
            <div class="mil-overlay"></div>
            <div class="mil-banner-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-8">
                            <h1 class="mil-mb-60"><span class="mil-uppercase mil-light">Colaboramos contigo <br>para
                                    digitalizar <br>la operacion de tu empresa</span></h1>
                            <h3 class="mil-mb-60"><span class="mil-uppercase mil-light">Soluciones de IT y
                                    Software</span></h3>
                            <div class="mil-flex-hori-center">
                                <div>
                                    <a href="" class="mil-button mil-dark"><span>Conócenos</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="mil-illustration-1">
                                <div class="mil-item mil-item-1">
                                    <div class="mil-plus">
                                        <div class="mil-hover-window">
                                            <div class="mil-window-content">
                                                <h5 class="mil-dark mil-mb-15">Casos de Éxito</h5>
                                                <div class="mil-divider mil-divider-left mil-mb-15"></div>
                                                <p class="mil-text-sm">Construimos relaciones que digitalizan la forma de trabajar</p>
                                            </div>
                                        </div>
                                        <div class="mil-item-hover">
                                            <div class="mil-plus-icon">+</div>
                                            <h6 class="mil-light">Casos de Éxito</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="mil-item mil-item-2">
                                    <div class="mil-plus">
                                        <div class="mil-hover-window">
                                            <div class="mil-window-content">
                                                <h5 class="mil-dark mil-mb-15">Nuestras Soluciones</h5>
                                                <div class="mil-divider mil-divider-left mil-mb-15"></div>
                                                <p class="mil-text-sm">Soluciones a medida, que elevan el modelo de negocio de nuestros clientes</p>
                                            </div>
                                        </div>
                                        <div class="mil-item-hover">
                                            <div class="mil-plus-icon">+</div>
                                            <h6 class="mil-light">Nuestras Soluciones</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="mil-item mil-item-3">
                                    <div class="mil-plus">
                                        <div class="mil-hover-window">
                                            <div class="mil-window-content">
                                                <h5 class="mil-dark mil-mb-15">Nuestro valor agregado</h5>
                                                <div class="mil-divider mil-divider-left mil-mb-15"></div>
                                                <p class="mil-text-sm">Transformamos a través de metodologías ágiles y sumando capacidades</p>
                                            </div>
                                        </div>
                                        <div class="mil-item-hover">
                                            <div class="mil-plus-icon">+</div>
                                            <h6 class="mil-light">Nuestro valor agregado</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- services -->
        <section class="mil-services" id="soluciones" style="margin-top: 40px;">
            <div class="mil-deco" style="top: 0; right: 20%;"></div>
            <div class="container">
                <img class="mil-main-image" src="img\titles\Soluciones de IT y Software.svg" alt="Soluciones de IT y Software">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="mil-divider mil-divider-left"></div>
                        <div class="container">
                            <div class="icon-text-container">
                                <div class="icon-container">
                                    <img class="icon-image" src="img/icons/Icon.svg" alt="Icono de Desarrollo de Software" style="width: 65px;">
                                </div>
                                <div class="text-container">
                                    <img class="title-image" src="img/titles/Desarrollo de Software.svg" alt="Desarrollo de Software" width="400px">
                                    <ul class="services-list">
                                        <li>Desarrollo a la medida</li>
                                        <li>Desarrollo de Estrategia y Diseño de Producto</li>
                                        <li>Desarrollo Ágil</li>
                                        <li>Reingeniería y Modernización de Aplicaciones</li>
                                        <li>Asignación y Administración de Talento especializado on-premise (REPSE)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mil-divider mil-divider-left"></div>
                        <div class="container">
                            <div class="icon-text-container">
                                <div class="icon-container">
                                    <img class="icon-image" src="img/icons/Icon2.svg" alt="Icono de Desarrollo de Software" style="width: 65px;">
                                </div>
                                <div class="text-container">
                                    <img class="title-image" src="img\titles\QA&Testing.svg" alt="Desarrollo de Software" width="200px">
                                    <ul class="services-list">
                                        <li>Fábrica de Testing</li>
                                        <li>Pruebas de Vulnerabilidad</li>
                                        <li>Pruebas de Calidad de Software</li>
                                        <li>Pruebas de Estrés</li>
                                        <li>Auditorías de Código</li>
                                        <li>Pruebas de Penetración</li>
                                        <li>Cumplimineto de ISO/IEC 27001</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="mil-divider mil-divider-left"></div>
                        <div class="container">
                            <div class="icon-text-container">
                                <div class="icon-container">
                                    <img class="icon-image" src="img/icons/Icon3.svg" alt="Icono de Desarrollo de Software" style="width: 65px;">
                                </div>
                                <div class="text-container">
                                    <img class="title-image" src="img\titles\IntegracionTecnologica.svg" alt="Desarrollo de Software" width="420px">
                                    <ul class="services-list">
                                        <li>Integración y Optimización de Aplicaciones</li>
                                        <li>Creación de API´s especializadas</li>
                                        <li>Integración de Inventarios y Puntos de Venta (PDV)</li>
                                        <li>Integración de Arquitecturas y Sistemas Operativos</li>
                                        <li>Análisis e integración de Aplicativos por Licenciamiento</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mil-divider mil-divider-left"></div>
                        <div class="container">
                            <div class="icon-text-container">
                                <div class="icon-container">
                                    <img class="icon-image" src="img/icons/Icon4.svg" alt="Icono de Desarrollo de Software" style="width: 65px;">
                                </div>
                                <div class="text-container">
                                    <img class="title-image" src="img\titles\Estategias de digitalizacion.svg" alt="Desarrollo de Software" width="420px">
                                    <ul class="services-list">
                                        <li>Diagnóstico de Procesos Internos</li>
                                        <li>Reingeniería de Procesos Operativos</li>
                                        <li>Alineación de Negocio y Estrategia de TI</li>
                                        <li>Análisis y Diseño de Estrategia TI</li>
                                        <li>Automatización de Procesos de Negocio</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- services end -->
        <div class="container">
            <div class="mil-divider"></div>
        </div>
        <!-- portfolio -->
        <section id="exito" class="mil-works">
            <div class="mil-deco" style="top: 0; right: 40%;"></div>
            <div class="container">
                <div class="row align-items-center mil-mb-60-adapt">
                    <div class="col-md-6 col-xl-6">
                        <img class="mil-main-image" src="img\titles\Casos de Exito.svg" alt="">
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="mil-adaptive-right">
                            <div class="mil-slider-nav mil-mb-30">
                                <div class="mil-slider-btn-prev mil-works-prev"><i class="fas fa-arrow-left"></i><span class="mil-h6">Anterior</span></div>
                                <div class="mil-slider-btn-next mil-works-next"><span class="mil-h6">Siguiente</span><i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-container mil-works-slider mil-mb-90">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a class="mil-card">
                                <div class="mil-cover-frame">
                                    <img src="img\que-es-medicina-nuclear.jpg" alt="project">
                                </div>
                                <div class="mil-description">
                                    <div class="mil-card-title">
                                        <h4 class="mil-mb-20">Farmaceutica líder en desarrollo de medicina nuclear</h4>
                                    </div>
                                    <div class="mil-card-text" style="text-align: justify;">
                                        <p>Esta farmacéutica especializada nos contactó para apoyarlos en la
                                            reingeniería de negocios que estaban llevando a cabo y la documentación de
                                            sus procesos internos. Sin embargo, por lo complejo de su operación y
                                            gestión del proceso de desarrollo y gestión de medicina nuclear, la
                                            necesidad de crear e implementar un sistema ERP a la medida fue inminente.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="mil-card">
                                <div class="mil-cover-frame">
                                    <img src="img\pizzahut.png" alt="project">
                                </div>
                                <div class="mil-description">
                                    <div class="mil-card-title">
                                        <h4 class="mil-mb-20">Holding global para delivery de pizzas</h4>
                                    </div>
                                    <div class="mil-card-text" style="text-align: justify;">
                                        <p>Un grupo multimarca líder en delivery de pizzas basado en España, con
                                            operación en 32 países, necesitaba optimizar su servicio de delivery y
                                            take-out para mejorar la experiencia de sus clientes.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a class="mil-card">
                                <div class="mil-cover-frame">
                                    <img src="img\audi-mexico_stage_1300x551.jpg" alt="project">
                                </div>
                                <div class="mil-description">
                                    <div class="mil-card-title">
                                        <h4 class="mil-mb-20">Empresa alemana del sector automotriz</h4>
                                    </div>
                                    <div class="mil-card-text" style="text-align: justify;">
                                        <p>La empresa automotriz buscaba evaluar la capacidad de respuesta de su comité
                                            directivo para manejar crisis ante un ciberataque, como parte de su proceso
                                            de mejora continua.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 col-xl-6">
                        <a href="portfolio.php" class="mil-link mil-mb-30"><img src="img\Buttons\Ver todos.svg" alt="" width="200px"></span></a>
                    </div>
                    <!-- <div class="col-md-6 col-xl-6">
                        <div class="mil-adaptive-right">
                            <a href="contact.php" class="mil-button mil-border mil-mb-30"><span>Get Started</span></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <section class="mil-reviews mil-deep-bg">
            <div class="mil-deco" style="top: 0; right: 30%;"></div>
            <div class="container">
                <div class="row align-items-center mil-mb-90">
                    <div class="col-md-6 col-xl-6">
                        <img class="mil-main-image" src="img\titles\Nuestro Proceso.svg" alt="">
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="mil-adaptive-right mil-mt-60-adapt">
                            <div class="mil-slider-nav">
                                <div class="mil-slider-btn-prev mil-revi-prev"><i class="fas fa-arrow-left"></i><span class="mil-h6">Anterior</span></div>
                                <div class="mil-slider-btn-next mil-revi-next"><span class="mil-h6">Siguiente</span><i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-container mil-revi-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Integración</h3>
                                </div>
                                <br>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">Facilitamos la integración de aplicaciones con otros sistemas y plataformas existentes, mejorando la interoperabilidad de las arquitecturas.</p>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Desarrollo a Medida</h3>
                                </div>
                                <br>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">Ofrecemos soluciones personalizadas que se adapten específicamente a las necesidades y requisitos únicos de cada cliente.</p>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Experiencia Técnica Especializada</h3>
                                </div>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">Alta disponibilidad de capacidades en diferentes lenguajes de programación, tecnologías específicas e industrias.</p>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Metodologías Ágiles</h3>
                                </div>
                                <br>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">Utilizamos metodologías ágiles para el desarrollo rápido y flexible, permitiendo una adaptación eficiente a los cambios en los requisitos del cliente.</p>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Transparencia y Colaboración</h3>
                                </div>
                                <br>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">Fomentamos la transparencia en la comunicación y la colaboración estrecha con los clientes durante todo el proceso de desarrollo.</p>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-right: 50px;">
                            <div class="mil-review">
                                <div class="mil-stars mil-mb-30">
                                    <h3>Garantía y Satisfacción</h3>
                                </div>
                                <br>
                                <p class="mil-mb-30" style="text-align: justify; color: black;">
                                    Ponemos todo nuestro compromiso con la satisfacción del cliente, ofreciendo ajustes y mejoras según las retroalimentaciones y necesidades del cliente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="mil-divider"></div>
        </div>
        <!-- blog -->
        <section class="mil-blog">
            <div class="mil-deco" style="top: 0; right: 30%;"></div>
            <div class="container">
                <div class="row align-items-center mil-mb-90">
                    <div class="col-md-6 col-xl-6">
                        <img class="mil-main-image" src="img/titles/Noticias de la Industria.svg" alt="">
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="mil-adaptive-right mil-mt-60-adapt">
                            <div class="mil-slider-nav">
                                <div class="mil-slider-btn-prev mil-blog-prev">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="mil-h6">Anterior</span>
                                </div>
                                <div class="mil-slider-btn-next mil-blog-next">
                                    <span class="mil-h6">Siguiente</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-container mil-blog-slider mil-mb-90">
                    <div class="swiper-wrapper">
                        <?php foreach ($noticias as $noticia) : ?>
                            <?php
                            $slideClass = $noticia['imagen_grande'] ? '50' : '25';
                            $cardClass = $noticia['imagen_grande'] ? 'mil-card' : 'mil-card mil-card-sm';
                            $foto = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $noticia['foto']);
                            $imagePath = htmlspecialchars(substr($foto, strpos($foto, 'uploads' . DIRECTORY_SEPARATOR)), ENT_QUOTES);
                            $link = htmlspecialchars($noticia['link'], ENT_QUOTES);
                            $nombre = htmlspecialchars($noticia['nombre'], ENT_QUOTES);
                            $descripcion = htmlspecialchars($noticia['descipcion'], ENT_QUOTES);
                            $descripcionCorta = strlen($descripcion) > 200 ? substr($descripcion, 0, 200) . '...' : $descripcion;
                            ?>
                            <div class="swiper-slide mil-slide-<?php echo $slideClass; ?>">
                                <a href="<?php echo $link; ?>" class="<?php echo $cardClass; ?>">
                                    <div class="mil-cover-frame">
                                        <img src="<?php echo $imagePath; ?>" alt="project">
                                    </div>
                                    <div class="mil-description">
                                        <div class="mil-card-title">
                                            <h4 class="mil-mb-20"><?php echo $nombre; ?></h4>
                                        </div>
                                        <div class="mil-card-text">
                                            <p><?php echo $descripcionCorta; ?></p>
                                        </div>
                                        <div class="mil-card-read-more">
                                            <a href="<?php echo $link; ?>" class="mil-btn-read-more" style="color: rgb(252, 37, 0);">Leer más</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="mil-reviews mil-deep-bg ">
            <div class="mil-deco" style="top: 0; right: 30%;"></div>
            <div class="container">
                <div class="row align-items-center mil-mb-90">
                    <div class="col-md-6 col-xl-6">
                        <img class="mil-main-image" src="img\titles\Nuestros Clientes.svg" alt="">
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <!-- <div class="mil-adaptive-right mil-mt-60-adapt">
                            <div class="mil-slider-nav">
                                <div class="mil-slider-btn-prev mil-revi-prev"><i class="fas fa-arrow-left"></i><span class="mil-h6">Prev</span></div>
                                <div class="mil-slider-btn-next mil-revi-next"><span class="mil-h6">Next</span><i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="swiper-container mil-revi-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="mil-review">
                                <h3>Intecfra</h3>
                                <div class="mil-stars mil-mb-30">
                                    <!-- <img src="img/icons/sm/11.svg" alt="quote"> -->
                                    <br>
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <p class="mil-mb-30" style="text-align: justify; color:black;font-size: 14px;">Desde el año 2020 hemos trabajado
                                    juntos en varios proyectos de
                                    desarrollo de software, brindando soluciones de alta calidad y satisfaciendo las
                                    necesidades de nuestros clientes de manera excepcional.
                                    Nuestra asociación ha abarcado una amplia gama de proyectos, incluyendo
                                    integraciones complejas con sistemas de software (puntos de venta) como S4D,
                                    facturación electrónica, middleware y aplicaciones internas personalizadas para
                                    nuestro cliente FDB (Food Delivery Brands).
                                    Han demostrado una capacidad sobresaliente para entender las necesidades específicas
                                    de cada proyecto y proporcionar soluciones efectivas y eficientes, que han superado
                                    nuestras expectativas.
                                    Su enfoque centrado en el cliente y compromiso con la excelencia han sido
                                    fundamentales para el éxito de nuestros proyectos conjuntos.
                                </p>
                                <div class="mil-author">
                                    <img src="img\intecfra.png" alt="Customer">
                                    <div class="mil-name">
                                        <h6 class="mil-mb-5">Ramon Nava</h6>
                                        <span class="mil-text-sm">Director de Operaciones</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide" style="padding-left: 20px; padding-right: 20px;">
                            <div class="mil-review">
                                <h3>Embajada de Australia en México</h3>
                                <div class="mil-stars mil-mb-30">
                                    <!-- <img src="img/icons/sm/11.svg" alt="quote"> -->
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <p class="mil-mb-30" style="text-align: justify; color:black;font-size: 14px;">Nos dimos cuenta que estábamos en
                                    buenas manos desde que nos
                                    ayudaron a definir y a entender la problemática a resolver más allá de lo que
                                    veíamos nosotros, así como con la elaboración de un plan de trabajo muy detallado
                                    que se cumplió en tiempo y forma, destacó también las entregas de los avances
                                    siempre puntuales y su apertura a recibir mejoras continuas durante el proceso.</p>
                                <div class="mil-author">
                                    <img src="img\embajada.png" alt="Customer">
                                    <div class="mil-name">
                                        <h6 class="mil-mb-5">Edgar Sanchéz L.</h6>
                                        <span class="mil-text-sm">Embajada de Australia en México</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="mil-review">
                                <h3>AccesoLab</h3>
                                <div class="mil-stars mil-mb-30">
                                    <!-- <img src="img/icons/sm/11.svg" alt="quote"> -->
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <p class="mil-mb-30" style="text-align: justify; color:black;font-size: 14px;">A nombre propio y de la compañía nos
                                    encontramos sumamente
                                    satisfechos con el servicio proporcionado por Ralken; el equipo ha mostrando
                                    habilidades excepcionales en la comprensión de las necesidades operativas en las
                                    distintas áreas de negocio y traducirlas en soluciones efectivas; sin distinción
                                    alguna, cada una de las personas que conforman el equipo muestran enfoque centrado
                                    al cliente y capacidad para adaptarse a los cambios en el proyecto.
                                    Ralken representa una verdadera solución como socio de negocio
                                </p>
                                <div class="mil-author">
                                    <img src="img\icono.png" alt="Customer">
                                    <div class="mil-name">
                                        <h6 class="mil-mb-5">Omar Sanchez</h6>
                                        <span class="mil-text-sm">Director General</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="swiper-slide">
                            <div class="mil-review">
                                <img src="img\Contenido 12.png" alt="">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- reviews end -->
        <div class="mil-p-90-60">
            <div class="container">
                <div class="mil-partners-frame">
                    <a href="#."><img src="img\image 12.png" alt="partner"></a>
                    <a href="#."><img src="img\image 7.png" alt="partner"></a>
                    <a href="#."><img src="img\logonuevo.png" alt="partner"></a>
                    <a href="#."><img src="img\image 11.png" alt="partner"></a>
                    <a href="#."><img src="img\image 9.png" alt="partner"></a>
                    <a href="#."><img src="img\image 10.png" alt="partner"></a>
                </div>
            </div>
        </div>

        <!-- contact -->
        <section id="contacto" class="mil-contact mil-gradient-bg mil-p-120-0">
            <div class="mil-deco mil-deco-accent" style="top: 0; right: 10%;"></div>
            <div class="container">
                <h2 class="mil-light"><span class="mil-accent2">Contáctanos</span></h2>
                <h4 class="mil-light"><span class="mil-accent2">Email: contacto@ralkentech.com</span></h4>
                <h4 class="mil-light mil-mb-90"><span class="mil-accent2">Teléfono: 5548994737</span></h4>
                <form method="post" action="correo.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mil-input-frame mil-mb-30">
                                <label><span class="mil-light">Nombre</span><span class="mil-accent2">Requerido</span></label>
                                <input type="text" name="name" required placeholder="Enter Your Name Here">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            </div>
                            <div class="mil-input-frame mil-mb-30">
                                <label><span class="mil-light">Correo electrónico</span><span class="mil-accent2">Requerido</span></label>
                                <input type="email" name="email" required id="email" placeholder="Your Email">
                            </div>
                            <div class="mil-input-frame mil-mb-60">
                                <label><span class="mil-light">Teléfono</span><span class="mil-light-soft">Opcional</span></label>
                                <input type="tel" name="phone" placeholder="Your Phone">
                            </div>
                            <div class="mil-attach-frame mil-mb-60">
                                <i class="fas fa-paperclip"></i>
                                <label class="mil-custom-file-input">
                                    <span>Carga un archivo</span>
                                    <input type="file" name="userfile" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                    text/plain, application/pdf, image/*" id="mil-file-input">
                                </label>
                                <p class="mil-text-sm mil-light-soft">Máximo 20MB</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mil-input-frame mil-mb-30">
                                <label><span class="mil-light">Tu mensaje</span><span class="mil-accent2">Requerido</span></label>
                                <textarea placeholder="Your Message" name="message"></textarea>
                            </div>
                            <p class="mil-text-sm mil-light-soft mil-mb-15">Acepto terminos y condiciones.</p>
                            <div class="mil-checbox-frame mil-mb-60">
                                <input class="mil-checkbox" id="checkbox-1" type="checkbox" name="agree" value="1" required>
                                <label for="checkbox-1" class="mil-text-sm mil-light">Procesaremos su información
                                    personal de acuerdo a nuestra Política de privacidad</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="mil-button mil-accent-bg mil-fw"><span style="color: white;">Enviar Mensaje</span></button>
                        </div>
                    </div>
                    <div class="alert-success" style="display: none;">
                        <h5>Thanks, your message is sent successfully.</h5>
                    </div>
                    <div class="alert-error" style="display: none;">
                        <h5>Error! Message could not be sent.</h5>
                    </div>
                </form>
            </div>
            <br>
            <br>
        </section>
        <?php include('footer.php'); ?>
    </div>
    <script src="js/plugins/jquery.min.js"></script>
    <!-- swiper js -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                nextEl: '.mil-slider-btn-next',
                prevEl: '.mil-slider-btn-prev',
            },
            slidesPerView: 1,
            spaceBetween: 10,
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    </script>
    <!-- itsulu js -->
    <script src="js/main.js"></script>
    <script src="js/forms.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.mil-navigation a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>

</body>

</html>