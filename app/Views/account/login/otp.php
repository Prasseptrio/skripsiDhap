<!DOCTYPE html>
<html lang="id" class="shop alternative-style-1">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="id" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?>" />
    <title><?= $title; ?></title>
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
                                    <span class="top-sub-title text-color-dark ">Butuh Bantuan? <a href="" class="text-color-light">Hubungi Kami</a> </span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?= base_url(); ?> ">
                                        <img alt="Logo Karnevor" class="img-fluid" style="max-height: 80px;" src="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?> ">
                                    </a>
                                </div>
                            </div>
                            <?= $this->include('common/alerts'); ?>
                            <form action="<?= base_url('checkOtp') ?>" id="shopLoginSignIn" method="POST">
                                <div class="form-row">
                                    <div class="form-group col mb-2 text-center my-3">
                                        <label class="text-color-dark text-5 my-4" for="num">Kode OTP </label><br>
                                        <!-- <input type="number" value="" maxlength="100" class="form-control border-grey rounded text-1 <?= ($validation->hasError('OTP')) ? 'is-invalid' : ''; ?>" id="OTP" name="OTP" placeholder="Masukan Kode Otp yang sudah terkirim di email" required> -->
                                        <input type="text" class="num" name="1" maxlength="1" required>
                                        <input type="text" class="num" name="2" maxlength="1" required>
                                        <input type="text" class="num" name="3" maxlength="1" required>
                                        <span class="splitter">&ndash;</span>
                                        <input type="text" class="num" name="4" maxlength="1" required>
                                        <input type="text" class="num" name="5" maxlength="1" required>
                                        <input type="text" class="num" name="6" maxlength="1" required>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-danger btn-rounded btn-v-3 btn-h-3 font-weight-bold">Kirim</button>
                                    </div>
                                </div>
                            </form>
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

    <!-- Theme Initialization Files -->
    <script async src="<?= base_url('assets/js/theme.init.js') ?>"></script>
    <script>
        const nums = document.querySelectorAll('.num')
        const form = document.querySelector('form')

        nums.forEach((num, index) => {
            num.dataset.id = index

            num.addEventListener('keyup', () => {
                if (num.value.length == 1) {
                    if (nums[nums.length - 1].value.length == 1) form.submit()
                    nums[parseInt(num.dataset.id) + 1].focus()
                }
            })
        })
    </script>

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