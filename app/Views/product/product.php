<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container container-lg-custom">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb mt-3">
                <li><a href="#">Home</a></li>
                <li><a href="#"><?= $category['product_category_name']; ?></a></li>
                <li class="active"><?= $product['product_name']; ?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <aside class="sidebar col-md-4 col-lg-3 order-2">
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
                                <?php foreach ($ChildCategory as $childCategory) : ?>
                                    <li><a href="<?= base_url('c/' . $childCategory['product_category_slug']); ?>"><?= $childCategory['product_category_name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header accordion-header" role="tab" id="price">
                        <h5 class="mb-0">
                            <a href="#" data-toggle="collapse" data-target="#togglePrice" aria-expanded="false" aria-controls="togglePrice">PRODUK TERKAIT</a>
                        </h5>
                    </div>
                    <div id="togglePrice" class="accordion-body collapse show" role="tabpanel" aria-labelledby="price">
                        <div class="card-body">
                            <?php foreach ($ProductRelated as $related) : ?>
                                <div class="product row align-items-center mb-4">
                                    <div class="col-5 pr-0">
                                        <div class="image-frame image-frame-border image-frame-style-1 image-frame-effect-1">
                                            <span class="image-frame-wrapper">
                                                <img src="<?= getenv('app.assetURL') . $related['product_image'] ?>" class="img-fluid" alt="">
                                                <span class="image-frame-action image-frame-action-style-2 image-frame-action-effect-1 image-frame-action-md">
                                                    <a href="<?= base_url() . '/' . $related['product_slug']; ?>">
                                                        <span class="image-frame-action-icon">
                                                            <i class="lnr lnr-link text-color-light"></i>
                                                        </span>
                                                    </a>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <h3 class="font-secondary text-color-default text-2 mb-0"><a href="<?= base_url() . '/' . $related['product_slug']; ?>"><?= $related['product_name'] . ' ' . $related['product_model'] ?></a></h3>
                                        <div class="product-info-rate product-info-rate-sm py-1 d-flex">
                                            <i class="fas fa-star text-color-default mr-1" style="color: #ffe234;"></i>
                                            <i class="fas fa-star text-color-default mr-1" style="color: #ffe234;"></i>
                                            <i class="fas fa-star text-color-default mr-1" style="color: #ffe234;"></i>
                                            <i class="fas fa-star text-color-default mr-1" style="color: #ffe234;"></i>
                                            <i class="far fa-star-half text-color-default" style="color: #ffe234;"></i>
                                        </div>
                                        <span class="price font-primary text-2"><strong class="text-color-dark"><?= 'Rp. ' . number_format($related['price']); ?></strong></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                    <div id="toggleSizes" class="accordion-body collapse show" role="tabpanel" aria-labelledby="sizes">
                        <div class="card-body pt-4">
                            <div class="image-frame">
                                <div class="image-frame-wrapper align-items-start">
                                    <img src="http://localhost/template/ezy/HTML/img/shop/product-bg-15.jpg" class="img-fluid" alt="">
                                    <div class="image-frame-info image-frame-info-show flex-column align-items-center mt-5">
                                        <span class="text-color-dark font-primary font-weight-semibold text-2 line-height-1">Amazing</span>
                                        <h2 class="text-color-dark font-weight-bold text-3 mb-2">LADIES DRESSES</h2>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-outline btn-rounded font-weight-bold btn-h-2 btn-v-3 d-block absolute-x-center align-self-end shop-now-bottom">SHOP NOW!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </aside>
        <div class="col-md-8 col-lg-9 order-1 mb-5 mb-md-0">
            <div class="row mb-5">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="thumb-gallery-wrapper">
                        <div class="thumb-gallery-detail owl-carousel owl-theme manual dots-style-2 nav-style-2 nav-color-dark mb-3">
                            <div>
                                <img src="<?= getenv('app.assetURL') . $product['product_image'] ?>" class="img-fluid" alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>">
                            </div>
                            <?php foreach ($ProductImages as $images) : ?>
                                <div>
                                    <img src="<?= getenv('app.assetURL') . '/images/' . $images['image']; ?>" class="img-fluid" alt="<?= $product['product_name']; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
                            <div>
                                <span class="d-block">
                                    <img alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>" src="<?= getenv('app.assetURL') . $product['product_image'] ?>" class="img-fluid">
                                </span>
                            </div>
                            <?php foreach ($ProductImages as $images) : ?>
                                <div>
                                    <span class="d-block">
                                        <img alt="Product Image" src="<?= getenv('app.assetURL') . '/images/' . $images['image']; ?>" class="img-fluid">
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h3 class="line-height-1 font-weight-bold mb-2"><?= $product['product_name'] . ' ' . $product['product_model']; ?></h3>
                    <div class="product-info-rate d-flex mb-3">
                        <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                        <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                        <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                        <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                        <i class="fas fa-star-half text-color-warning" style="color: #ffe234;"></i>
                    </div>
                    <h2 class="price font-primary "><strong class="text-color-primary"><?= ($product['price'] != 0) ? 'Rp. ' . number_format($product['price']) : ''; ?></strong></h2>
                    <ul class="list list-unstyled">
                        <li>Model : <strong><?= $product['product_model']; ?></strong></li>
                        <li>SKU : <strong><?= $product['product_sku']; ?></strong></li>
                        <li>Stok Produk: <strong><?= $product['stock_name']; ?></strong></li>
                        <?php if ($product['price'] != 0) : ?>
                            <div class="row mt-2">
                                <form action="<?= base_url('wishlist/addToWishlist'); ?>" method="post">
                                    <input type="hidden" name="productID" value="<?= $product['product_id']; ?>">
                                    <input type="hidden" name="slug" value="<?= $product['product_slug']; ?>">
                                    <button class="btn d-inline" type="submit"><b><span><?= ($wishlist) ? '<i class="fas fa-heart text-3" style="color: #e31b23;"></i>' : '<i class="lnr lnr-heart text-3"></i>'; ?> Wishlist</span></b></button>
                                </form>
                                <span class="mt-2"><b>|</b></span>
                                <a href="mailto:<?= getenv('SMTPUser.config'); ?>" class="btn"><b><span><i class="lnr lnr-envelope text-3"></i> Hubungi kami</span></b></a>
                            </div>
                        <?php endif ?>
                    </ul>
                    <hr class="my-4">
                    <?php if ($product['price'] != 0) : ?>
                        <form class="shop-cart align-items-center" action="<?= base_url('addToCart'); ?>" method="post" enctype="multipart/form-data">
                            <div class="d-flex align-items-center">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <h5 class="font-weight-bold">Jumlah : </h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="quantity">
                                            <input type="button" value="-" class="minus">
                                            <input type="number" step="1" min="1" name="quantity" id="QTY" value="1" title="Qty" class="qty" size="2">
                                            <input type="button" value="+" class="plus">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="productSlug" value="<?= $product['product_slug']; ?>">
                            <input type="hidden" name="customerID" id="CustomerID" value="<?= session()->get('CID'); ?>">
                            <button type="submit" class="add-to-cart btn btn-outline-primary btn-rounded font-weight-bold text-3 btn-v-3 btn-h-2 btn-fs-2 ml-3 BtnAddToCart"><i class="lnr lnr-cart text-2"></i>&nbsp Masukan Keranjang</button>
                            <button type="button" class="add-to-cart btn btn-primary btn-rounded font-weight-bold text-3 btn-v-3 btn-h-2 btn-fs-2 ml-3 BtnCheckout" data-name="<?= $product['product_name']; ?>" data-price="<?= $product['price']; ?>" data-sku="<?= $product['product_sku']; ?>" data-image="<?= $product['product_image']; ?>" data-model="<?= $product['product_model']; ?>" data-weight="<?= $product['weight']; ?>"><i class="lnr lnr-store text-2"></i>&nbsp Beli Sekarang</button>
                        </form>
                    <?php else : ?>
                        <div id="accordionDefault" class="accordion accordion-primary accordion-default" role="tablist">
                            <div class="card">
                                <div class="card-header accordion-header" role="tab" id="accordionDefault1">
                                    <h5 class="mb-0">
                                        <a href="#" data-toggle="collapse" data-target="#accordionDefaultCollapse1" aria-expanded="false" aria-controls="accordionDefaultCollapse1">Pilihan Varian Produk</a>
                                    </h5>
                                </div>
                                <div id="accordionDefaultCollapse1" class="collapse show" role="tabpanel" aria-labelledby="accordionDefault1" data-parent="#accordionDefault">
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>Model</th>
                                                <th>Harga</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($Subproduct as $subproduct) : ?>
                                                    <tr>
                                                        <td><?= $subproduct['product_name'] . ' ' . $subproduct['product_model']; ?></td>
                                                        <td><?= 'Rp. ' . number_format($subproduct['price']); ?></td>
                                                        <td><a href="<?= base_url() . '/' . $subproduct['product_slug']; ?>" class="btn btn-outline-primary btn-sm">Lihat</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <hr class="my-4">

                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <ul class="nav nav-tabs nav-tabs-default" id="productDetailTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold active" id="productDetailDescTab" data-toggle="tab" href="#productDetailDesc" role="tab" aria-controls="productDetailDesc" aria-expanded="true">DESKRIPSI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="productDetailMoreInfoTab" data-toggle="tab" href="#productDetailMoreInfo" role="tab" aria-controls="productDetailMoreInfo">SPESIFIKASI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="productDetailReviewsTab" data-toggle="tab" href="#productDetailReviews" role="tab" aria-controls="productDetailReviews">ULASAN PELANGGAN (<?= ($ProductReview) ? count($ProductReview) : '0'; ?>)</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="contentTabProductDetail">
                        <div class="tab-pane fade pt-4 pb-4 show active" id="productDetailDesc" role="tabpanel" aria-labelledby="productDetailDescTab">
                            <?= htmlspecialchars_decode($product['product_description']); ?>

                        </div>
                        <div class="tab-pane fade pt-4 pb-4" id="productDetailMoreInfo" role="tabpanel" aria-labelledby="productDetailMoreInfoTab">
                            <table class="table">
                                <thead>
                                    <th>Spesifikasi</th>
                                    <th>Nilai</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($ProductAttribute as $attribute) : ?>
                                        <tr>
                                            <th scope="row"><?= $attribute['specification_name']; ?></th>
                                            <td><?= $attribute['specification_value']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade pt-4 pb-4" id="productDetailReviews" role="tabpanel" aria-labelledby="productDetailReviewsTab">
                            <ul class="comments">
                                <?php
                                if ($ProductReview) :
                                    foreach ($ProductReview as $review) : ?>
                                        <li>
                                            <div class="comment">
                                                <div class="d-none d-sm-block">
                                                    <?php $customer = getCustomerByCustomerID($review['product_review_customer_id']); ?>
                                                    <img class="avatar rounded-circle" alt="" src="<?= ($customer['profile_image'] != null) ?  getenv('app.assetURL') . "/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>">
                                                </div>
                                                <div class="comment-block">
                                                    <span class="comment-by">
                                                        <span class="comment-rating">
                                                            <input type="text" class="rating-invisible" id="Rating" name="rating" value="<?= $review['product_review_rating'] ?>" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'containerClass': 'rating-primary', 'size':'sm'}">
                                                        </span>
                                                        <strong class="comment-author text-color-dark"><?= $review['product_review_author']; ?></strong>
                                                        <span class="comment-date border-right-0 text-color-light-3">
                                                            <?= tgl_indonesia(date(" d M Y, H:i", $review['created_at'])); ?>
                                                        </span>

                                                    </span>
                                                    <p><?= $review['product_review_text']; ?> </p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach;
                                else : ?>
                                    <section>
                                        <div class="text-center">
                                            <p class="text-5">Belum ada ulasan untuk produk ini <br><span class="text-2">Beli produk ini dan jadilah yang pertama memberikan ulasan</span></p>
                                        </div>
                                    </section>
                                <?php endif; ?>
                            </ul>

                            <!-- <div class="row mt-4 pt-2">
                                <div class="col">
                                    <h2 class="font-weight-bold text-3 mb-3">Tinggalkan Ulasan</h2>
                                    <form class="form-style-2" action="#" method="post">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <div class="rating p-1">
                                                    <label>
                                                        <input type="radio" name="rating" value="5" title="5 stars"> 5
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="4" title="4 stars"> 4
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="3" title="3 stars"> 3
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="2" title="2 stars"> 2
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="1" title="1 star"> 1
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <textarea class="form-control bg-light-5 border-0 rounded-0" placeholder="Ulasan" rows="6" name="review" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" value="" class="form-control border-0 rounded-0" name="name" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="email" value="" class="form-control border-0 rounded-0" name="email" placeholder="Alamat Email" required>
                                            </div>
                                        </div>
                                        <div class="form-row mt-2">
                                            <div class="col">
                                                <input type="submit" value="KIRIM ULASAN" class="btn btn-primary btn-rounded btn-h-2 btn-v-2 font-weight-bold">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    function pageRedirect() {
        window.location.replace("<?= base_url('checkout'); ?>");
    }
    //insertCart
    $('.BtnCheckout').click(function() {
        const cust = $('#CustomerID').val();
        const product_sku = $(this).data("sku");
        const image = $(this).data("image");
        let weight = $(this).data("weight");
        let quantity = $('#QTY').val();
        let price = $(this).data("price");
        let product_model = $(this).data("model");
        let name = $(this).data("name");
        $.ajax({
            url: "<?= base_url('cart/insertCart'); ?>",
            method: "POST",
            type: 'JSON',
            data: {
                id: product_sku,
                name: name,
                qty: quantity,
                price: price,
                customer: cust,
                image: image,
                model: product_model,
                weight: weight
            },
            success: function(result) {
                setTimeout("pageRedirect()", 10);
            }
        });
    });
</script>
<?= $this->endSection(); ?>