<!DOCTYPE html>
<html lang="id" class="shop alternative-style-1">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="id" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?>" />
    <title><?= $title; ?> - Alenxi Technology | Pneumatic Hydraulic Components</title>
    <meta name="keywords" content="<?= $keyword; ?>" />
    <meta name="description" content="<?= $description; ?>">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="msapplication-TileColor" content="#137BEF">
    <meta name="theme-color" content="#1D6EDC">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700,800,900%7CPoppins:100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/animate/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/linear-icons/css/linear-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/owl.carousel/assets/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/owl.carousel/assets/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/magnific-popup/magnific-popup.min.css') ?>">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/theme-elements.css') ?>">
    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?= base_url('plugins/rs-plugin/css/settings.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/rs-plugin/css/layers.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/rs-plugin/css/navigation.css') ?>">
    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <!-- Head Libs -->
    <script src="<?= base_url('plugins/modernizr/modernizr.min.js') ?>"></script>
    <!-- </?= html_entity_decode($config_google_analytics) ?> -->
</head>

<body>
    <div class="body">
        <header id="header" class="header-shop-1" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 168, 'stickySetTop': '-168px', 'stickyChangeLogo': false}">
            <div class="header-body">
                <div class="header-top header-top-colored" style=" background-color: #dfcccc;">
                    <div class="header-top-container container container-lg-custom">
                        <div class="header-row">
                            <div class="header-column justify-content-start">
                                <a href="<?= base_url(); ?> ">
                                    <img width="250" height="48" src="assets/images/brand/karnevor_logo_side.png" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="section">
            <div class="container container-lg-custom">
                <div class="d-flex justify-content-center">
                    <div class="col-md-6 ">
                        <div class="border border-light rounded p-5">
                            <div class="row mb-2">
                                <div class="col-sm-6 mt-2">
                                    <span class="top-sub-title ">Butuh Bantuan? <a href="https://wa.me/085869948016" class="text-color-light">Hubungi Kami</a> </span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?= base_url(); ?> ">
                                        <img alt="Logo Karnevor" class="img-fluid" style="max-height: 100px;" src="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?> ">
                                    </a>
                                </div>
                            </div>
                            <!-- </?= $this->include('common/alerts'); ?> -->
                            <div class="row justify-content-center my-4">
                                <div class="d-flex flex-column align-items-center mt-3">
                                    <h3 class="font-weight-bold">Link Aktivasi Berhasil Dikirim!</h3>
                                    <svg style="color: rgb(35, 136, 237); height: 100px;" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                        <title>ionicons-v5-e</title>
                                        <path d="M256,48C141.31,48,48,141.31,48,256s93.31,208,208,208,208-93.31,208-208S370.69,48,256,48Zm48.19,121.42,24.1,21.06-73.61,84.1-24.1-23.06ZM191.93,342.63,121.37,272,144,249.37,214.57,320Zm65,.79L185.55,272l22.64-22.62,47.16,47.21L366.48,169.42l24.1,21.06Z" fill="#dfcccc"></path>
                                    </svg>
                                    <div class="text-center">
                                        <form action="<?= base_url('resentEmail'); ?>" method="post">
                                            <h5 class="my-2">Silahkan Cek Email Untuk Verifikasi Akun Anda.</h5>
                                            <h6>Belum mendapatkan email verifikasi? </h6>
                                            <h6 class="text-center"><strong id="waktu" class="text-4 text-light"></strong></h6>
                                            <button class="text-color-light btn btn-link" id="buttonResent" disabled> Kirim ulang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                Sudah melakukan verifikasi? &nbsp; <a href="<?= base_url('login'); ?> " class=" text-color-light "> Masuk</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?= $this->include('layouts/footer'); ?>
    </div>

    <!-- Vendor -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.appear/jquery.appear.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.cookie/jquery.cookie.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/common/common.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.gmap/jquery.gmap.min.js') ?>"></script>
    <script src="<?= base_url('plugins/jquery.lazyload/jquery.lazyload.min.js') ?>"></script>
    <script src="<?= base_url('plugins/isotope/jquery.isotope.min.js') ?>"></script>
    <script src="<?= base_url('plugins/owl.carousel/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('plugins/magnific-popup/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('plugins/vide/jquery.vide.min.js') ?>"></script>
    <script src="<?= base_url('plugins/vivus/vivus.min.js') ?>"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="<?= base_url('assets/js/theme.js') ?>"></script>

    <!-- Current Page Vendor and Views -->
    <script src="<?= base_url('plugins/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>
    <script src="<?= base_url('plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') ?>"></script>
    <!-- Theme Custom -->
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script>
        $(document).ready(function() {
            // Set a valid end date
            var endOfTime = new Date("<?= date("Y-m-d H:i:s", strtotime("+5 minutes", $time)) ?>").getTime();
            // Update the count down every 1 second
            var x = setInterval(function() {
                var now = new Date().getTime();
                // console.log(now);
                var distance = endOfTime - now;
                // Calculate Remaining Time
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // console.log(minutes);
                // console.log(seconds);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                // Display the result in the element with id="demo"
                document.getElementById("waktu").innerHTML = minutes + " menit : " + seconds + " detik ";

                // If the countdown is finished, write some text
                if (distance < 0) {
                    document.getElementById("waktu").innerHTML = "";
                    clearInterval(x);
                    $('#buttonResent').attr('disabled', false);
                }
            }, 1000);
        });
    </script>
    <!-- Theme Initialization Files -->
    <script async src="<?= base_url('assets/js/theme.init.js') ?>"></script>


    <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
        ga('create', 'UA-12345678-1', 'auto');
        ga('send', 'pageview');
    </script>
     -->

</body>

</html>