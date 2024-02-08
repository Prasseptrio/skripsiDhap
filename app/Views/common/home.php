<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="section pt-4 pb-5 mt-3">
    <div class="container container-lg-custom">
        <div class="row row-gutter-sm justify-content-center mb-5">
            <div class="col-sm-9 col-md-6 col-lg-4 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
                <div class="image-frame border border-dark">
                    <div class="image-frame-wrapper">
                        <img src="assets/images/product/package/Value Package 1.jpg" class="img-fluid" alt="">
                        <!-- <div class="image-frame-info image-frame-info-show flex-column align-items-start px-4 mr-2 ml-4">
                            <span class="text-1">AMAZING</span>
                            <h2 class="text-color-primary font-weight-bold font-alternative letter-spacing-n1 text-5 text-md-4 text-xl-5 mb-4">Monoblock</h2>
                            <a href="<?= base_url('assets/images/product/package/Value Package 1.jpg'); ?>" class="btn btn-primary btn-rounded font-weight-bold btn-h-2 btn-v-3 text-0">Lihat Menu</a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-6 col-lg-4 mb-4 mb-lg-0 appear-animation" data-appear-animation="fadeIn">
                <div class="image-frame border border-dark">
                    <div class="image-frame-wrapper">
                        <img src="assets/images/product/package/Value Package 2.jpg" class="img-fluid" alt="">
                        <!-- <div class="image-frame-info image-frame-info-show flex-column align-items-start px-4 mr-2 ml-4">
                            <span class="text-1">COOL</span>
                            <h2 class="text-color-primary font-weight-bold font-alternative letter-spacing-n1 text-5 text-md-4 text-xl-5 mb-4">As Hard Chrome</h2>
                            <a href="<?= base_url('as-hard-chrome-piston-rod-as-hard-chrome'); ?>" class="btn btn-primary btn-rounded font-weight-bold btn-h-2 btn-v-3 text-0">Lihat Menu</a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-6 col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                <div class="image-frame border border-dark">
                    <div class="image-frame-wrapper">
                        <img src="assets/images/product/package/Value Package 3.jpg" class="img-fluid" alt="">
                        <!-- <div class="image-frame-info image-frame-info-show flex-column align-items-start px-4 mr-2 ml-4">
                            <span class="text-1">TRENDY</span>
                            <h2 class="text-color-primary font-weight-bold font-alternative letter-spacing-n1 text-5 text-md-4 text-xl-5 mb-4">Solenoid </h2>
                            <a href="<?= base_url('c/solenoid-valve'); ?>" class="btn btn-primary btn-rounded font-weight-bold btn-h-2 btn-v-3 text-0">Lihat Menu</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container container-lg-custom">
        <div class="row text-center mb-4">
            <div class="col">
                <div class="overflow-hidden mb-0">
                    <h2 class="font-weight-extra-bold text-5 mb-0 appear-animation text-light" data-appear-animation="maskUp" data-appear-animation-delay="200">Katergori Menu</h2>
                </div>
            </div>
        </div>
        <div class="row pb-2 mb-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
            <div class="col">
                <div class="owl-carousel owl-theme nav-style-3 nav-arrows-thin nav-color-dark" data-plugin-options="{'responsive': {'0': {'items': 1}, '575': {'items': 2}, '767': {'items': 3}, '991': {'items': 4}, '1199': {'items': 4}}, 'loop': true, 'autoplay': false, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true}">
                    <?php foreach ($Categories as $categories) :  ?>
                        <div>
                            <a href="<?= base_url('c/' . $categories['product_category_slug']); ?>">
                                <div class="d-flex flex-column align-items-center justify-content-center bg-danger border-dark  py-5">
                                    <h4 class="font-alternative text-color-light font-weight-bold text-5 mb-0"><?= $categories['product_category_name']; ?></h4>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container container-lg-custom mb-5">
        <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
            <h2 class="font-weight-extra-bold text-4 pb-1 mb-3 text-light">Menu Terbaru</h2>
            <div class="row">
                <?php foreach ($LatestProducts as $latest) : ?>
                    <div class="col-sm-4 product row row-gutter-sm align-items-center mb-4">
                        <div class="col-4 col-md-12 col-lg-4">
                            <a href="<?= base_url($latest['product_id']); ?> ">
                                <div class="image-frame">
                                    <div class="image-frame-wrapper">
                                        <img src="<?= getenv('app.assetURL') . $latest['product_image'] ?>" class="img-fluid" alt="<?= $latest['product_image'] ?>" style="min-height:100px; max-height:120px;">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-8 col-md-12 col-lg-8 ml-md-0 ml-lg-0 pl-lg-1">
                            <h3 class="text-3 font-weight-normal font-alternative mb-1"><a href="<?= base_url($latest['product_id']); ?> " class="text-color-dark text-color-hover-primary"><?= $latest['product_name'] ?></a></h3>
                            <span class="price font-alternative text-4 ml-1">
                                <strong class="text-color-light  font-weight-semibold">Rp.<?= number_format($latest['price'] - 1) ?> </strong>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>