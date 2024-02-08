<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>
<section class="section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <h2 class=" mb-3"><b>Daftar Transaksi</b></h2>
        </div>
        <div class="row align-items-center mb-4">
            <div class="col-md-8 col-lg-9">
                <ul id="portfolioLoadMoreFilter" class="nav sort-source justify-content-center justify-content-md-start mb-4 mb-md-0" data-sort-id="products" data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
                    <li class="nav-item" data-option-value="*">
                        <a class="nav-link active" href="#" role="tab">Semua</a>
                    </li>
                    <li class="nav-item" data-option-value=".ongoing">
                        <a class="nav-link" href="#" role="tab">Sedang Berlangsung</a>
                    </li>
                    <li class="nav-item" data-option-value=".success">
                        <a class="nav-link" href="#" role="tab">Berhasil</a>
                    </li>
                    <li class="nav-item" data-option-value=".canceled">
                        <a class="nav-link" href="#" role="tab">Dibatalkan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sort-destination-loader sort-destination-loader-showing">
            <hr style="border-top: 3px solid #bbb;">
            <?php if ($Orders == null) : ?>
                <div id="LoadMoreWrapper" class="sort-destination" data-sort-id="products">
                    <section>
                        <div class="text-center">
                            <p class="text-4">Oops... belum ada transaksi</p>
                            <p class="text-3">Yuk segera belanja aja...</p>
                        </div>
                    </section>
                </div>
            <?php else : ?>
                <p class="text-right"><i>Menampilkan <b><?= count($Orders); ?> transaksi</b> dari total <b><?= $totalTransaction; ?> Transaksi</b></i></p>
                <div id="LoadMoreWrapper" class="sort-destination" data-sort-id="products">
                    <ul>
                        <?php foreach ($Orders as $order) : ?>
                            <li class="list-group-item list-group-item-action rounded mb-2 isotope-item
                                <?php if ($order['order_status'] == '10' || $order['order_status'] == '8') : ?>
                                    success
                                    <?php elseif ($order['order_status'] == '2' || $order['order_status'] > '10' && $order['order_status'] < '15') : ?>
                                        canceled
                                        <?php else : ?>
                                            ongoing  
                                            <?php endif; ?>
                                            ">
                                <a href="<?= base_url('transaction/detailTransaction?inv=' . base64_encode($order['order_uuid'])); ?>">
                                    <div class="d-flex w-100 justify-content-between">
                                        <p><b>Tanggal Belanja :</b>
                                            <span>
                                                <?= longdate_indo($order['transaction_date']) ?>
                                            </span>
                                            <?php if ($order['order_status'] == '8' || $order['order_status'] == '10') : ?>
                                                <span class="badge badge-success" style="color:SeaGreen ; background-color:SpringGreen;"><?= $order['order_status_name_sky']; ?></span>
                                        </p>
                                        <h5 class=" font-weight-bold text-right">AX- <?= '' . $order['invoice_no']; ?></h5>
                                    <?php elseif ($order['order_status'] == '2'  || $order['order_status'] > '10' && $order['order_status'] < '15') : ?>
                                        <span class="badge badge-danger" style="color:Maroon; background-color:Red;"><?= $order['order_status_name_sky']; ?></span>
                                        </p>
                                    <?php else : ?>
                                        <span class="badge badge-warning" style="color:GoldenRod ; background-color:LightGoldenRodYellow;"><?= $order['order_status_name_sky']; ?></span>
                                        </p>
                                        <?php if ($order['order_status'] >= '7' && $order['order_status'] <= '10') : ?>
                                            <h5 class=" font-weight-bold text-right">AX- <?= '' . $order['invoice_no']; ?></h5>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                                    <div class="product-detail">
                                        <?php $Products = getSalesOrderProductByOrderID($order['order_id']);
                                        foreach ($Products as $product) :
                                        ?>
                                            <div class="row mb-3">
                                                <div class="col-3 text-center">
                                                    <img src="<?= getenv('app.assetURL') . $product['product_image']; ?>" class="img-fluid" width="100" alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>" />
                                                </div>
                                                <div class="col-6 text-left">
                                                    <p><?= $product['product_name'] . ' ' . $product['product_model']; ?> <br> <small><?= $product['quantity']; ?> Barang</small></p>
                                                </div>
                                                <div class="col-3 text-right ">
                                                    <p class="text-primary font-weight-semibold">Rp. <?= number_format($product['price']); ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endforeach; ?>
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="text-left"><small>Catatan : <?= ($order['shipping_comment']) ? $order['shipping_comment'] : 'tidak ada catatan'; ?></small></p>
                                            </div>
                                            <div class="col-5 text-right">
                                                <h3 class="text-3 font-weight-semibold"> <b>Total Belanja</b> Rp. <?= number_format($order['total'] + $order['shipping_cost']); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="row justify-content-end my-2">
                                    <a href="<?= base_url('transaction/detailTransaction?inv=' .  base64_encode($order['order_uuid'])); ?>" class="btn text-primary btn-h-2 btn-v-3 font-weight-semibold">
                                        <b>Detail Transaksi</b>
                                    </a>
                                    <?php if ($order['order_status'] == '10' || $order['order_status'] == '8') : ?>
                                        <a href="<?= base_url('transaction/review?inv=' . base64_encode($order['order_uuid'])); ?>" class="btn btn-primary mx-2 btn-h-2 btn-v-3 font-weight-semibold">Beri ulasan</a>
                                    <?php elseif ($order['order_status'] == 7) : ?>
                                        <form action="<?= base_url('transaction/received?inv=' . base64_encode($order['order_uuid'])); ?>" method="post">
                                            <button class="btn btn-outline-primary mx-2 btn-h-2 btn-v-3 font-weight-semibold">Barang Diterima</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button id="portfolioLoadMore" type="button" class="btn btn-primary btn-rounded btn-wide-5 btn-icon-effect-2 outline-none font-weight-semibold text-0" <?= (count($Orders) == $totalTransaction) ? 'hidden' : '' ?>>
                            <span>Lihat Lainnya</span>
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $('document').ready(function() {
        $('#portfolioLoadMore').click(function() {
            const url = new URL(window.location);
            const queryString = window.location.search;
            let pageNow = 1;
            if (queryString != '') {
                urlParams = new URLSearchParams(queryString);
                pageNow = parseInt(urlParams.get('page'));
            }
            let totalPage = pageNow + 1;
            url.searchParams.set('page', totalPage)
            window.history.pushState({}, '', url);
            $.ajax({
                url: "<?= base_url('transaction'); ?>",
                method: "GET",
                type: 'JSON',
                data: {
                    page: totalPage,
                },
                success: function(result) {
                    location.reload();
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>