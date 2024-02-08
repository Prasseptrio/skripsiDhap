<?php foreach ($Orders as $order) : ?>
    <li class="list-group-item list-group-item-action rounded mb-2 isotope-item
                                <?php if ($order['order_status'] == '10') : ?>
                                    success
                                    <?php elseif ($order['order_status'] == '2'  || $order['order_status'] > '10' && $order['order_status'] < '12') : ?>
                                        canceled
                                        <?php else : ?>
                                            ongoing  
                                            <?php endif; ?>
                                            ">
        <a href="<?= base_url('transaction/detailTransaction?inv=' . base64_encode($order['order_id'])); ?>">
            <div class="d-flex w-100 justify-content-between">
                <p><b>Tanggal Belanja :</b>
                    <span>
                        <?= longdate_indo($order['transaction_date']) ?>
                    </span>
                    <?php if ($order['order_status'] == '10') : ?>
                        <span class="badge badge-success" style="color:SeaGreen ; background-color:SpringGreen;"><?= $order['order_status_name_sky']; ?></span>
                </p>
                <h5 class=" font-weight-bold text-right">AX- <?= '' . $order['invoice_no']; ?></h5>
            <?php elseif ($order['order_status'] == '2'  || $order['order_status'] > '10' && $order['order_status'] < '15') : ?>
                <span class="badge badge-danger" style="color:Maroon; background-color:Red;"><?= $order['order_status_name_sky']; ?></span>
                </p>
            <?php else : ?>
                <span class="badge badge-warning" style="color:GoldenRod ; background-color:LightGoldenRodYellow;"><?= $order['order_status_name_sky']; ?></span>
                </p>
                <?php if ($order['order_status'] == '8' || $order['order_status'] == '10') : ?>
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
            <a href="<?= base_url('transaction/detailTransaction?inv=' .  base64_encode($order['order_id'])); ?>" class="btn text-primary btn-h-2 btn-v-3 font-weight-semibold">
                <b>Detail Transaksi</b>
            </a>
            <?php if ($order['order_status'] == '10') : ?>
                <a href="<?= base_url('transaction/review?inv=' . base64_encode($order['order_id'])); ?>" class="btn btn-primary mx-2 btn-h-2 btn-v-3 font-weight-semibold">Beri ulasan</a>
            <?php elseif ($order['order_status'] > 7 && $order['order_status'] < 11) : ?>
                <a href="" class="btn btn-outline-primary mx-2 btn-h-2 btn-v-3 font-weight-semibold">Barang Diterima</a>
            <?php endif; ?>
        </div>
    </li>
<?php endforeach; ?>