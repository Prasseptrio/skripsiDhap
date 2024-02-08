<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="page-header py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <ul class="breadcrumb justify-content-start ">
                    <li><a href="#">Home</a></li>
                    <li class="active">Pencarian</li>
                </ul>
            </div>
            <div class="col-md-8 text-left">
                <span class="tob-sub-title text-color-primary d-block">PENCARIAN Menu</span>
                <p class="lead text-color-dark">Menampilkan hasil <b>" <?= $keyword; ?>"</b> <?= count($totalProduct); ?> Menu</p>
            </div>
        </div>
    </div>
</section>


<div class="container container-lg-custom">
    <div class="row">
        <aside class="sidebar col-md-4 col-lg-3 order-2 order-md-1">
            <div class="accordion accordion-default accordion-toggle accordion-style-1" role="tablist">
                <div class="card">
                    <div class="card-header accordion-header" role="tab" id="categories">
                        <h5 class="mb-0">
                            <a href="#" data-toggle="collapse" data-target="#toggleCategories" aria-expanded="false" aria-controls="toggleCategories">KATEGORI</a>
                        </h5>
                    </div>
                    <div id="toggleCategories" class="accordion-body collapse show" role="tabpanel" aria-labelledby="categories">
                        <div class="card-body">
                            <ul class="list list-unstyled mb-0">
                                <?php foreach ($ParentCategory as $childCategory) : ?>
                                    <li><a href="<?= base_url('search?q=' . $childCategory['product_category_name']); ?>"><?= $childCategory['product_category_name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-header accordion-header" role="tab" id="brands">
                        <h5 class="mb-0">
                            <a href="#" data-toggle="collapse" data-target="#toggleBrands" aria-expanded="false" aria-controls="toggleBrands">BRANDS</a>
                        </h5>
                    </div>
                    <div id="toggleBrands" class="accordion-body collapse show" role="tabpanel" aria-labelledby="brands">
                        <div class="card-body">
                            <ul class="list list-unstyled mb-0">
                                <li><a href="#">Adidas <span class="float-right">18</span></a></li>
                                <li><a href="#">Camel <span class="float-right">22</span></a></li>
                                <li><a href="#">Samsung Galaxy <span class="float-right">05</span></a></li>
                                <li><a href="#">Seiko <span class="float-right">68</span></a></li>
                                <li><a href="#">Sony <span class="float-right">03</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </aside>
        <div class="col-md-8 col-lg-9 order-1 order-md-2 mb-5 mb-md-0">
            <div class="row align-items-center justify-content-between mb-4">
                <div class="col-auto mb-3 mb-sm-0">
                    <!-- PR MEMBUAT SORT -->
                    <!-- <form method="get">
                        <div class="custom-select-1">
                            <select class="form-control border">
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date" selected="selected">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div>
                    </form> -->
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <!-- <span>Menampilan 1-12 of <?= count($totalProduct); ?> hasil perncarian</span> -->
                        <a href="#" class="text-color-dark text-3 ml-2" data-toggle="tooltip" data-placement="top" title="Grid"><i class="fas fa-th"></i></a>
                        <a href="#" class="text-color-dark text-3 ml-2" data-toggle="tooltip" data-placement="top" title="List"><i class="fas fa-list-ul"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($Products as $product) :   ?>
                    <?php if ($product['product_parent'] == null && $product['product_category'] == null) : ?>
                    <?php else : ?>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <div class="product portfolio-item portfolio-item-style-2">
                                <div class="image-frame image-frame-style-1 image-frame-effect-2 mb-3">
                                    <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                        <a href="<?= base_url($product['product_id']); ?>">
                                            <img src="<?= getenv('app.assetURL') . $product['product_image'] ?>" class="img-fluid" alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>" style="min-height:180px; max-height: 180px;">
                                        </a>
                                        <span class="image-frame-action">
                                            <a href="<?= base_url($product['product_id']); ?>" class="btn btn-primary btn-rounded font-weight-semibold btn-v-3 btn-fs-2">Lihat Menu</a>
                                        </span>
                                    </span>
                                </div>
                                <div class="product-info d-flex flex-column flex-lg-row justify-content-between">
                                    <div class="product-info-title">
                                        <h3 class="text-color-default text-2 line-height-1 mb-1"><a href="<?= base_url($product['product_id']); ?>"><?= $product['product_name'] . ' ' . $product['product_model']; ?></a></h3>
                                        <span class="price font-primary text-4"><strong class="text-color-primary">Rp. <?= number_format($product['price']); ?></strong></span>
                                        <!-- <span class="old-price font-primary text-line-trough text-1"><strong class="text-color-default">$69</strong></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <hr class="mt-5 mb-4">
            <div class="row justify-content-center">
                <?= ($pagination != 0 && count($totalProduct) > 12) ? $pagination : ''; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>