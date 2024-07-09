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
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    echo $_SESSION['csrf_token'];
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
    <title>RALKTECH CONTACTO</title>
    <link rel="icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
</head>

<body>

    <div class="mil-wrapper">
        <?php include('navbar.php'); ?>
        <div class="mil-banner-sm mil-deep-bg">
            <img src="img\banners\RALKTECH_webBanner01_V2.png" alt="background" class="mil-background-image">
            <div class="mil-deco mil-deco-accent" style="top: 47%; right: 10%; transform: rotate(90deg)"></div>
            <div class="mil-banner-content">
                <div class="container mil-relative">
                    <h1 class="mil-uppercase mil-light">Contactanos</h1>
                </div>
            </div>
        </div>
        <section id="contacto" class="mil-contact mil-gradient-bg mil-p-120-0">
            <div class="mil-deco mil-deco-accent" style="top: 0; right: 10%;"></div>
            <div class="container">
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
                </form>
            </div>
            <br>
            <br>
        </section>
        <div>
            <div class="mil-map-frame">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.8723266444445!2d-99.1627314!3d19.4179216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff398f7fed6d%3A0x430fd79f54e78613!2sAv.%20%C3%81lvaro%20Obreg%C3%B3n%20171%2C%20Roma%20Nte.%2C%20Cuauht%C3%A9moc%2C%2006700%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1716851747315!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="container"></div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>

</html>