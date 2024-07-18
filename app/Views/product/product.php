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
        <div class="col"></div>
        <div class="col-md-9 col-lg-12 order-1 mb-5 mb-md-0">
            <div class="card" style="background-color: #dfcccc;">
                <div class="row mb-5 card-body">
                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <div class="thumb-gallery-wrapper">
                            <div class="thumb-gallery-detail owl-carousel owl-theme manual dots-style-2 nav-style-2 nav-color-dark mb-3">
                                <div>
                                    <img src="<?= getenv('app.assetURL') . $product['product_image'] ?>" class="img-fluid" alt="<?= $product['product_name'] . ' '; ?>">
                                </div>
                            </div>
                            <div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
                                <div>
                                    <span class="d-block">
                                        <img alt="<?= $product['product_name'] . ' '; ?>" src="<?= getenv('app.assetURL') . $product['product_image'] ?>" class="img-fluid">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <h3 class="line-height-1 font-weight-bold mb-2"><?= $product['product_name'] . ' '; ?></h3>
                        <div class="product-info-rate d-flex mb-3">
                            <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                            <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                            <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                            <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                            <i class="fas fa-star-half text-color-warning" style="color: #ffe234;"></i>
                        </div>
                        <h2 class="price font-primary "><strong class="text-color-light"><?= ($product['price'] != 0) ? 'Rp. ' . number_format($product['price']) : ''; ?></strong></h2>
                        <ul class="list list-unstyled">
                            <li>Stok Menu: <strong>Tersedia</strong></li>
                            <?php if ($product['price'] != 0) : ?>
                                <div class="row mt-2">
                                    <form action="<?= base_url('wishlist/addToWishlist'); ?>" method="post">
                                        <input type="hidden" name="productID" value="<?= $product['product_id']; ?>">
                                        <input type="hidden" name="slug" value="<?= $product['product_id']; ?>">
                                        <button class="btn d-inline" type="submit"><b><span><?= ($wishlist) ? '<i class="fas fa-heart text-3" style="color: #e31b23;"></i>' : '<i class="lnr lnr-heart text-3"></i>'; ?> Wishlist</span></b></button>
                                    </form>
                                    <span class="mt-2"><b>|</b></span>
                                    <a href="https://wa.me/+6285869948016?text=<?= urlencode('Hallo Admin, saya butuh bantuan untuk produk ' . $product['product_name']); ?>  " class="btn"><b><span><i class="lnr lnr-envelope text-3"></i> Hubungi kami</span></b></a>
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
                                <input type="hidden" name="productID" value="<?= $product['product_id']; ?>">
                                <input type="hidden" name="customerID" id="CustomerID" value="<?= session()->get('CID'); ?>">
                                <button type="submit" class="add-to-cart btn btn-outline-danger text-light border-light btn-rounded font-weight-bold text-3 btn-v-3 btn-h-2 btn-fs-2 ml-3 BtnAddToCart"><i class="lnr lnr-cart text-2"></i>&nbsp Masukan Keranjang</button>
                                <button type="button" class="add-to-cart btn btn-danger border-light btn-rounded font-weight-bold text-3 btn-v-3 btn-h-2 btn-fs-2 ml-3 BtnCheckout" data-name="<?= $product['product_name']; ?>" data-price="<?= $product['price']; ?>" data-sku="<?= $product['product_id']; ?>" data-image="<?= $product['product_image']; ?>"><i class="lnr lnr-store text-2"></i>&nbsp Beli Sekarang</button>
                            </form>
                        <?php else : ?>
                            <div id="accordionDefault" class="accordion accordion-primary accordion-default" role="tablist">
                                <div class="card">
                                    <div class="card-header accordion-header" role="tab" id="accordionDefault1">
                                        <h5 class="mb-0">
                                            <a href="#" data-toggle="collapse" data-target="#accordionDefaultCollapse1" aria-expanded="false" aria-controls="accordionDefaultCollapse1">Pilihan Varian Menu</a>
                                        </h5>
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
                            <!-- <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="productDetailReviewsTab" data-toggle="tab" href="#productDetailReviews" role="tab" aria-controls="productDetailReviews">ULASAN PELANGGAN (</?= ($ProductReview) ? count($ProductReview) : '0'; ?>)</a>
                            </li> -->
                        </ul>
                        <div class="tab-content" id="contentTabProductDetail">
                            <div class="tab-pane fade pt-4 pb-4 show active mx-auto" id="productDetailDesc" role="tabpanel" aria-labelledby="productDetailDescTab">
                                <?= htmlspecialchars_decode($product['product_description']); ?>
                            </div>
                            <!-- <div class="tab-pane fade pt-4 pb-4" id="productDetailReviews" role="tabpanel" aria-labelledby="productDetailReviewsTab">
                                <ul class="comments">
                                    </?php
                                    if ($ProductReview) :
                                        foreach ($ProductReview as $review) : ?>
                                            <li>
                                                <div class="comment">
                                                    <div class="d-none d-sm-block">
                                                        </?php $customer = getCustomerByCustomerID($review['product_review_customer_id']); ?>
                                                        <img class="avatar rounded-circle" alt="" src="</?= ($customer['profile_image'] != null) ?  getenv('app.assetURL') . "/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>">
                                                    </div>
                                                    <div class="comment-block">
                                                        <span class="comment-by">
                                                            <span class="comment-rating">
                                                                <input type="text" class="rating-invisible" id="Rating" name="rating" value="</?= $review['product_review_rating'] ?>" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'containerClass': 'rating-primary', 'size':'sm'}">
                                                            </span>
                                                            <strong class="comment-author text-color-dark"></?= $review['product_review_author']; ?></strong>
                                                            <span class="comment-date border-right-0 text-color-light-3">
                                                                </?= tgl_indonesia(date(" d M Y, H:i", $review['created_at'])); ?>
                                                            </span>

                                                        </span>
                                                        <p></?= $review['product_review_text']; ?> </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </?php endforeach;
                                    else : ?>
                                        <section>
                                            <div class="text-center">
                                                <p class="text-5">Belum ada ulasan untuk menu ini <br><span class="text-2">Beli menu ini dan jadilah orang pertama dalam memberikan ulasan</span></p>
                                            </div>
                                        </section>
                                    </?php endif; ?>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
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