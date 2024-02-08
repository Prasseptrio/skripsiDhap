<!DOCTYPE html>
<html lang="id" class="shop alternative-style-1">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="id" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?>" />
    <title><?= $title; ?></title>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2 class=" font-weight-bold text-color-light text-4 mt-3 mb-4">Lupa Password</h2>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?= base_url(); ?> ">
                                        <img alt="Logo Karnevor" class="img-fluid" style="max-height: 100px;" src="<?= base_url('assets/images/brand/karnevor_logo_symbol_no_background.png'); ?> ">
                                    </a>
                                </div>
                            </div>
                            <?= $this->include('common/alerts'); ?>
                            <form action="<?= base_url('resetPassword'); ?>" id="shopLoginSignIn" method="post">
                                <div class="form-row">
                                    <div class="form-group col mb-2">
                                        <label class="" for="inputEmail">EMAIL </label>
                                        <input type="email" value="" maxlength="100" class="form-control border-light  rounded text-1" name="inputEmail" id="inputEmail" value="<?= old('inputEmail'); ?>" required>
                                        <small id="inputEmail" class="form-text text-warning"> <?= (($validation->hasError('inputEmail'))) ? $validation->getError('inputEmail') : ''; ?></small>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col">
                                        <a href="<?= base_url('register'); ?> " class="forgot-pw  text-color-light  d-block">Belum punya akun ? Daftar</a>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-danger btn-rounded btn-v-3 btn-h-3 font-weight-bold">Kirim Kode</button>
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
</body>

</html>