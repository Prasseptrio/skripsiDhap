<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container container-lg-custom mb-4">
    <ul class="nav sort-source mb-3" data-sort-id="products" data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
        <li class="nav-item" data-option-value="*"><a class="nav-link active" href="#">SHOW ALL</a></li>
        <?php
        $Subcategory = getChildCategory($category['product_category_id']);
        foreach ($Subcategory as $subcategory) :
        ?>
            <li class="nav-item" data-option-value=".<?= mb_url_title($subcategory['product_category_name'], '-', true); ?>"><a class="nav-link text-uppercase" href="<?= base_url($subcategory['product_category_slug']); ?> "><?= $subcategory['product_category_name']; ?></a></li>
        <?php
        endforeach;
        ?>
    </ul>
    <div class="sort-destination-loader sort-destination-loader-showing">
        <div class="portfolio-list sort-destination" data-sort-id="products">
            <?php foreach ($ProductCategory as $productCategory) : ?>
                <div class="col-sm-6 col-md-3 p-0 isotope-item texet <?= mb_url_title($productCategory['product_category_name'], '-', true); ?>">
                    <div class="product portfolio-item portfolio-item-style-2">
                        <div class="image-frame image-frame-style-1 image-frame-effect-2 mb-3">
                            <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                <a href="<?= base_url($productCategory['product_id']); ?>">
                                    <img src="<?= getenv('app.assetURL') . $productCategory['product_image'] ?>" class="img-fluid" alt="" style="min-height:180px; max-height: 180px;">
                                </a>
                                <span class="image-frame-action">
                                    <a href="<?= base_url($productCategory['product_id']); ?>" class="btn btn-primary btn-rounded font-weight-semibold btn-v-3 btn-fs-2">Lihat Menu</a>
                                </span>
                            </span>
                        </div>
                        <div class="product-info d-flex flex-column flex-lg-row justify-content-between">
                            <div class="product-info-title">
                                <h3 class="text-color-default text-2 line-height-1 mb-1 "><a href="<?= base_url($productCategory['product_id']); ?>" class="text-dark"><?= $productCategory['product_category_name'] ?></a></h3>
                                <span class="price font-primary text-4"><strong class="text-color-dark"><?= $productCategory['product_name'] ?></strong></span>
                                <!-- <span class="old-price font-primary text-line-trough text-1"><strong class="text-color-default">$69</strong></span> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($ProductByParent as $productCategory) : ?>
                <div class="col-sm-6 col-md-3 p-0 isotope-item <?= mb_url_title($productCategory['product_category_name'], '-', true); ?>">
                    <div class="product portfolio-item portfolio-item-style-2">
                        <div class="image-frame image-frame-style-1 image-frame-effect-2 mb-3">
                            <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                <a href="<?= base_url($productCategory['product_id']); ?>">
                                    <img src="<?= getenv('app.assetURL') .  $productCategory['product_image'] ?>" class="img-fluid" alt="" style="min-height:180px; max-height: 180px;">
                                </a>
                                <span class="image-frame-action">
                                    <a href="<?= base_url($productCategory['product_id']); ?>" class="btn btn-primary btn-rounded font-weight-semibold btn-v-3 btn-fs-2">Lihat Menu</a>
                                </span>
                            </span>
                        </div>
                        <div class="product-info d-flex flex-column flex-lg-row justify-content-between">
                            <div class="product-info-title">
                                <h3 class="text-color-default text-2 line-height-1 mb-1"><a href="<?= base_url($productCategory['product_id']); ?>"><?= $productCategory['product_category_name'] ?></a></h3>
                                <span class="price font-primary text-4"><strong class="text-color-dark"><?= $productCategory['product_name'] . ' ' . $productCategory['product_category_name'] ?></strong></span>
                                <!-- <span class="old-price font-primary text-line-trough text-1"><strong class="text-color-default">$69</strong></span> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>