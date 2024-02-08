<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div role="main" class="main">
    <div class="container">
        <div class="header-cart my-4">
            <h2 class=" mb-3"><b>Wishlist</b></h2>
        </div>
        <?= $this->include('common/alerts'); ?>
        <div class="card-deck row-cols-1 row-cols-md-3">
            <?php foreach ($Wishlist as $wishlist) : ?>
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= getenv('app.assetURL') . $wishlist['product_image'] ?>" class="card-img-top" alt="<?= $wishlist['product_name'] . ' ' . $wishlist['product_model']; ?>" style="min-height:180px; max-height: 180px; width:100%">

                        <div class="card-body">
                            <div class="product-info-rate d-flex mb-3">
                                <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                                <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                                <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                                <i class="fas fa-star text-color-warning mr-1" style="color: #ffe234;"></i>
                                <i class="fas fa-star-half text-color-warning" style="color: #ffe234;"></i>
                            </div>
                            <h5 class="card-title"><b><a href="<?= base_url($wishlist['product_slug']); ?>"><?= $wishlist['product_name'] . ' ' . $wishlist['product_model']; ?></a></b></h5>
                            <span>Model : </span><br>
                            <span class="price font-primary text-1"><b><?= $wishlist['product_model']; ?></b></span><br>
                            <span>Stok Menu: </span><br>
                            <span class="price font-primary text-1"><b><?= $wishlist['stock_status']; ?></b></span><br><br>
                            <span class="price font-primary text-4" style="position:absolute; bottom: 80px; "><strong class="text-color-primary">Rp. <?= number_format($wishlist['price']); ?></strong></span>
                        </div>
                        <div class="card-footer bg-light  d-inline d-flex float-center mt-2 text-center">
                            <form action="<?= base_url('wishlist/deleteWishlist'); ?>" method="post" class="d-inline text-center ml-3">
                                <input type="hidden" name="productID" id="productID" value="<?= $wishlist['product_id']; ?>">
                                <button type="submit" class="btn btn-outline-dark font-weight-bold text-3 btn-v-3 btn-fs-2 mr-2"><i class="lnr lnr-trash text-3"></i></button>
                            </form>
                            <form action="<?= base_url('wishlist/addToCart'); ?>" method="post" class="align-items-center text-center">
                                <input type="hidden" name="productSlug" value="<?= $wishlist['product_slug']; ?>">
                                <input type="hidden" name="productID" id="productID" value="<?= $wishlist['product_id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="resource" value="wishlist">
                                <input type="hidden" name="customerID" id="CustomerID" value="<?= session()->get('CID'); ?>">
                                <button type="submit" class="btn btn-outline-primary font-weight-bold text-3 btn-v-3 btn-fs-2"><i class="fa fa-plus font-weight-semibold mr-1 text-2"></i> Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>