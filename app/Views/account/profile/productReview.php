<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>

<section class="section">
    <div class="row ">
        <div class="col">
            <a href="<?= base_url('transaction'); ?>" class="ml-2 text-primary font-weight-bold text-4"><i class="fas fa-arrow-left "></i> Kembali</a>
            <h2 class="mb-3 justify-content-center text-center"><b>Berikan Ulasan</b></h2>
        </div>
    </div>
    <div class="container">
        <hr style="border-top: 3px solid #bbb;">
        <div class="detail-transaction row">
            <div class="col-6 text-left">
                <p>Tanggal Belanja :
                    <b> <span>
                            <?= longdate_indo($Order['transaction_date']) ?>
                        </span>
                    </b>
                </p>
            </div>
            <div class="col-6 text-right">
                <h5 class="font-weight-bold text-primary text-right">AX- <?= '' . $Order['invoice_no']; ?></h5>
            </div>
        </div>
        <div class="product-detail ">
            <?php foreach ($OrderProduct as $product) : ?>
                <div class="list-group-item mb-3 mt-4">
                    <form action="<?= base_url('transaction/review'); ?>" method="post">
                        <?php $Review = getReview($Order['order_id'], $product['product_id']); ?>
                        <input type="hidden" name="orderID" value="<?= $Order['order_id']; ?>">
                        <input type="hidden" name="orderUUID" value="<?= $Order['order_uuid']; ?>">
                        <div class="row">
                            <div class="col-4 text-center mt-4">
                                <img src="<?= getenv('app.assetURL') . $product['product_image']; ?>" class="img-fluid" width="120" alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>" />
                            </div>
                            <div class="col-6 text-left mt-4">
                                <p class="text-4"><?= $product['product_name'] . ' ' . $product['product_model']; ?> <br> <small><?= $product['quantity']; ?> Barang</small></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col text-center">
                                <div class="d-block pb-2 mt-4">
                                    <?php if ($Review) : ?>
                                        <label for="rating"><b>Rate yang telah diberikan:</b></label>
                                    <?php else : ?>
                                        <label for="rating"><b>Berikan rating untuk produk :</b></label>
                                    <?php endif ?>
                                    <input type="text" class="rating-invisible" id="Rating" name="rating" value="<?= ($Review) ? $Review['product_review_rating'] : '0'; ?>" title="" data-plugin-star-rating data-plugin-options="{<?= ($Review) ? "'displayOnly': true," : ''; ?>' containerClass': 'rating-primary', 'size':'lg'}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <textarea class="form-control bg-light-5 border-0 rounded-0 block" placeholder="Berikan Ulasan...." rows="6" cols="60" name="review" required <?= ($Review) ? 'readonly' : ''; ?>><?= ($Review) ? $Review['product_review_text'] : ''; ?></textarea>
                                <label class="mt-3"><b>Tampilkan nama pemberi ulasan?</b></label>
                                <label class="switch ml-3">
                                    <input type="checkbox" name="showName" <?= ($Review) ? 'disabled' : ''; ?> value="<?= ($Review) ? $Review['product_reveiw_show_name'] : 0; ?>" <?= ($Review) ? ($Review['product_reveiw_show_name'] == 1) ? 'checked' : '' : 0; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="col-3">
                                <input type="hidden" name="productId" value="<?= $product['product_id']; ?>">
                                <?php if (!$Review) : ?>
                                    <button class="btn btn-outline-primary mt-3 btn-block" id="BtnSubmit" type="submit">Kirim Ulasan</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#BtnSubmit').click(function() {
            let rating = $('#Rating').val();
            if (rating == 0) {
                Swal.fire(
                    'Silahkan Berikan Rating',
                    '',
                    'warning'
                )
            }
        });
    });
</script>
<?= $this->endSection(); ?>