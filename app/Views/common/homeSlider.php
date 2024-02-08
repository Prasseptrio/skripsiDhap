<section class="section py-3">
    <div class="container">
        <div class="row">
            <div class="col-4 col-lg-3 p-1 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
                <div class="image-frame">
                    <div class="image-frame-wrapper align-items-start">
                        <?php $bannerTopLeft = banner('top-left'); ?>
                        <img src="<?= getenv('app.assetURL') . $bannerTopLeft['images']; ?>" class="img-fluid" alt="">
                        <div class="image-frame-info image-frame-info-show flex-column align-items-start px-4 pt-2 mx-2 mt-5">
                            <h2 class="text-color-dark font-weight-bold text-4 mb-2 font-alternative letter-spacing-0"><?= $bannerTopLeft['title'] . ' ' . $bannerTopLeft['subtitle']; ?></h2>
                            <!-- <div class="mb-4">
                                <span class="old-price font-primary font-weight-semibold text-color-default text-line-trough text-4">Rp. 192.000</span>
                                <span class="price font-primary font-weight-semibold text-color-primary text-4">Rp. 179.000</span>
                            </div> -->
                            <a href="<?= base_url() . $bannerTopLeft['url']; ?>" class="btn btn-dark btn-rounded font-weight-bold btn-h-2 btn-v-3 text-0">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 col-lg-6 p-1 z-index-1">
                <div class="image-frame">
                    <div class="image-frame-wrapper">
                        <?php $bannerTopMiddle = banner('top-middle'); ?>
                        <img src="<?= getenv('app.assetURL') . $bannerTopMiddle['images']; ?>" height="auto" class="img-fluid appear-animation" alt="" data-appear-animation="scaleOut" data-appear-animation-duration="8s">
                        <div class="image-frame-info image-frame-info-show flex-column align-items-start px-5 pt-4 mx-2">
                            <span class="text-color-dark font-alternative font-weight-bold text-3"><?= $bannerTopMiddle['title']; ?></span>
                            <h2 class="text-color-dark font-weight-bold font-alternative text-5-6 pb-2 mb-3"><?= $bannerTopMiddle['subtitle']; ?></h2>
                            <!-- <div class="mb-4">
                                <span class="old-price font-primary font-weight-semibold text-color-default text-line-trough text-5">Rp. 576.000</span>
                                <span class="price font-primary font-weight-semibold text-color-primary text-5">Rp. 559.000</span>
                            </div> -->
                            <a target="_blank" href="<?= base_url() . $bannerTopMiddle['url']; ?>" class="btn btn-primary btn-rounded font-weight-bold btn-h-2 btn-v-3 text-0">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-5 col-lg-12 p-1 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                        <div class="image-frame">
                            <?php $bannerRightTop = banner('top-right-top'); ?>
                            <div class="image-frame-wrapper align-items-start">
                                <img src="<?= getenv('app.assetURL') . $bannerRightTop['images']; ?>" class="img-fluid" alt="">
                                <div class="image-frame-info image-frame-info-show flex-column align-items-center pt-4">
                                    <h2 class="text-color-dark text-center text-4 mb-4"><?= $bannerRightTop['title']; ?><br> <strong><?= $bannerRightTop['subtitle']; ?></strong></h2>
                                </div>
                                <!-- <span class="text-color-dark bg-primary font-primary font-weight-bold rounded-circle off-tag-bottom-left line-height-1 text-4 p-4">45%<br>OFF</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-5 col-lg-12 p-1 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
                        <div class="image-frame">
                            <div class="image-frame-wrapper">
                                <?php $bannerRightBottom = banner('top-right-bottom'); ?>
                                <img src="<?= getenv('app.assetURL') . $bannerRightBottom['images']; ?>" class="img-fluid" alt="">
                                <div class="image-frame-info image-frame-info-show flex-column align-items-center">
                                    <span class="text-color-dark font-primary font-weight-bold text-3"><?= $bannerRightBottom['title']; ?></span>
                                    <h2 class="text-color-dark font-weight-bold text-5 line-height-1 mb-2"><?= $bannerRightBottom['subtitle']; ?></h2>
                                    <!-- <span class="text-color-dark font-primary text-3 mb-4">FLAT <strong>75% OFF</strong></span> -->
                                    <a href="<?= base_url('') .  $bannerRightBottom['url']; ?>" class="btn btn-primary btn-rounded font-weight-bold btn-h-2 btn-v-3">SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>