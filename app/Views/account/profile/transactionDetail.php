<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>
<section class="section bg-light">
    <div class="container">
        <div class="row ">
            <div class="col">
                <a href="<?= base_url('transaction'); ?>" class="ml-2 text-danger font-weight-bold text-4"><i class="fas fa-arrow-left "></i> Kembali</a>
                <h2 class=" mb-3 justify-content-center text-center"><b>Detail Transaksi</b></h2>
            </div>
        </div>
        <hr>
        <div class="col-12 tab-content mt-3" id="myTabContent">
            <div class="row">
                <div class="col-5">
                    <h6 class="mb-2 ">Nomor Invoice : </h6>
                </div>
                <div class="col-7 text-right">
                    <span class="text-danger font-weight-bold mb-2">
                        INV- <?= $Order['invoice_no']; ?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <h6 class="mb-2">Tanggal Pembelian :</h6>
                </div>
                <div class="col-7 text-right">
                    <span class="mb-2 text-danger font-weight-bold"><?= date_indo($Order['transaction_date']) ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <h6 class="mb-2">Status Pembayaran :</h6>
                </div>
                <div class="col-7 text-right">
                    <?php if ($Order['order_status'] >= '7' && $Order['order_status'] <= '10') : ?>
                        <span class="font-weight-bold text-4 my-2 text-success"><?= $Order['order_status_name_sky']; ?></span>
                    <?php elseif ($Order['order_status'] == '2'  || $Order['order_status'] > '10' && $Order['order_status'] < '15') : ?>
                        <span class="font-weight-bold text-4 my-2 text-secondary "><?= $Order['order_status_name_sky']; ?></span>
                    <?php else : ?>
                        <span class="font-weight-bold text-4 my-2 text-warning"><?= $Order['order_status_name_sky']; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="detail-address">
                <div class="row">
                    <div class="col-6">
                        <h4><b>Alamat Pengiriman</b></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5><?= $Order['notes']; ?><br></h5>
                    </div>
                </div>
                <hr>
            </div>
            <div class="detail-product">
                <h4><b>Detail Barang Yang dibeli</b></h4>
                <div class="table-responsive">
                    <table class="shop-cart-table w-100 ">
                        <thead class="my-2">
                            <tr>
                                <th></th>
                                <th class="product-name pr-5" style="color: grey;">
                                    Menu
                                </th>
                                <th class="product-price pr-5" style="color: grey;">
                                    <center>Harga</center>
                                </th>
                                <th class="product-quantity " style="color: grey;">
                                    <center>Qty</center>
                                </th>
                                <th class="product-subtotal" style="color: grey;">
                                    <center>Sub Total</center>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="my-2">
                            <?php foreach ($OrderProduct as $product) : ?>
                                <tr>
                                    <td><img src="<?= getenv('app.assetURL') . $product['product_image']; ?>" class="img-fluid" width="100" alt="<?= $product['product_name']; ?>" /></td>
                                    <td><?= $product['product_name']; ?></td>
                                    <td class="text-justify">Rp. <?= number_format($product['price']); ?></td>
                                    <td class="text-center"><?= $product['quantity']; ?> pcs</td>
                                    <td class="text-center">Rp. <?= number_format($product['total']); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <h4 class="mt-4 text-2"><b>Catatan Pembelian :</b></h4>
            <p><span><?= ($Order['notes']) ? $Order['notes'] : 'tidak ada catatan'; ?></span></p>
            <hr>
            <div class="detail-shipping">
                <h4 class="my-4 text-2"><b>Detail Info Pengiriman :</b></h4>
                <table width="600px">
                    <tr>
                        <td>Biaya Pengiriman</td>
                        <td> : </td>
                        <td class="font-weight-bold"><span>Rp. <?= number_format($Order['cost_delivery']); ?></span></td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="detail-grandtotal">
                <div class="row">
                    <div class="col-6">
                        <h4><b>Rincian Total Harga</b></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>Total Harga Barang</h5>
                    </div>
                    <div class="col-6 text-right">
                        <h6><b>Rp. <?= number_format($Order['total']); ?></b></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>Total Biaya Pengiriman</h5>
                    </div>
                    <div class="col-6 text-right">
                        <h6><b>Rp. <?= number_format($Order['cost_delivery']); ?></b></h6>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <h4><b>Total Belanja</b></h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4 class="text-danger"><b>Rp. <?= number_format($Order['cost_delivery'] + $Order['total']); ?></b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<?= $this->endSection(); ?>