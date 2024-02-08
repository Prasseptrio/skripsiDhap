<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>

<section class="section">
    <div class="row ">
        <div class="col">
            <a href="<?= base_url('transaction'); ?>" class="ml-2 text-primary font-weight-bold text-4"><i class="fas fa-arrow-left "></i> Kembali</a>
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
                <span class="text-primary font-weight-bold mb-2">
                    <?php if ($Order['order_status'] >= '6' && $Order['order_status'] <= '10') : ?>
                        AX- <?= $Order['invoice_no']; ?>
                    <?php else : ?>
                        Nomor Invoice Belum Diterbitkan
                    <?php endif ?>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <h6 class="mb-2">Tanggal Pembelian :</h6>
            </div>
            <div class="col-7 text-right">
                <span class="mb-2 text-primary font-weight-bold"><?= date_indo($Order['transaction_date']) ?></span>
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
                    <span class="font-weight-bold text-4 my-2 text-danger "><?= $Order['order_status_name_sky']; ?></span>
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
                    <h5><?= $Order['shipping_address']; ?><br><?= $Order['shipping_subdistrict'] . ', ' . $Order['shipping_city'] . ', ' . $Order['shipping_province']; ?> <br>Kode Pos : <?= $Order['shipping_postalcode']; ?></h5>
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
                                Produk
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
                                <td><img src="<?= getenv('app.assetURL') . $product['product_image']; ?>" class="img-fluid" width="100" alt="<?= $product['product_name'] . ' ' . $product['product_model']; ?>" /></td>
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
        <p><span><?= ($Order['shipping_comment']) ? $Order['shipping_comment'] : 'tidak ada catatan'; ?></span></p>
        <hr>
        <div class="detail-shipping">
            <h4 class="my-4 text-2"><b>Detail Info Pengiriman :</b></h4>
            <table width="600px">
                <tr>
                    <td width="100px">Kurir</td>
                    <td width="15px"> : </td>
                    <td width="250px" class="font-weight-bold"><span><?= $Order['courier_name'] ?></span></td>
                </tr>
                <tr>
                    <td>Tipe Jasa Kirim</td>
                    <td> : </td>
                    <td class="font-weight-bold"><span><?= $Order['shipping_courier_service'] ?></span></td>
                </tr>
                <tr>
                    <td>Biaya Pengiriman</td>
                    <td> : </td>
                    <td class="font-weight-bold"><span>Rp. <?= number_format($Order['shipping_cost']); ?></span></td>
                </tr>
                <tr>
                    <td>No. Resi</td>
                    <td> : </td>
                    <td class="font-weight-bold"><span><?= ($Order['shipping_receipt_no']) ? $Order['shipping_receipt_no'] : 'Nomor Resi Belum Diterbitkan' ?></span></td>
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
                    <h6><b>Rp. <?= number_format($Order['shipping_cost']); ?></b></h6>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4><b>Total Belanja</b></h4>
                </div>
                <div class="col-6 text-right">
                    <h4 class="text-primary"><b>Rp. <?= number_format($Order['shipping_cost'] + $Order['total']); ?></b></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>