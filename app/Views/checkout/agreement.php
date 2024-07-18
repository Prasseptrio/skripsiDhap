<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="section pt-2 bg-light-2 ">
    <div class="container d-flex justify-content-center">
        <div class="card-body col-8 bg-white rounded-lg p-3 ">
            <?= $this->include('common/alerts'); ?>
            <div class="card-title">
                <h3><b>Pembayaran Melalui Bank <?= ($SalesOrder['payment_method'] == 1) ? 'BCA' : 'Mandiri' ?></b></h3>
                <hr>
            </div>
            <div class="text-center">
                <h4 class="mb-2">Selesaikan Pembayaran Sebelum</h4>
                <h4 class="text-center"><strong id="waktu" class="text-4 text-danger"></strong></h4>
                <h3 class="mb-2">Batas Akhir Pembayaran</h3>
                <h3><b id="CLock"><?php $date = strtotime("+1 hours", $SalesOrder['created_at']);
                                    echo date(" d F Y, H:i", $date); ?></b></h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <h5>Nomor Rekening Tujuan</h5>
                    <h3 id="Rekening"><b>123456</b></h4>
                        <h5 class="mb-4">a/n <b>DHAPUNTA HYANG CAVALERA</b></h5>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h5>Total Pembayaran</h5>
                    <h3><b>Rp. <?= number_format($SalesOrder['total'] + $SalesOrder['cost_delivery']); ?></b></h4>
                        <button type="button" class="btn btn-light mt-3" data-toggle="modal" data-target="#exampleModal">
                            <h5 class="text-danger font-weight-bold"> Lihat Detail Pembelian</h5>
                        </button>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <a href="<?= base_url('cancelOrder?inv=' . base64_encode($invoice)); ?>" class="btn btn-outline-dark btn-3 font-weight-semibold">Batalkan Transaksi</a>
                <button type="button" class="btn btn-danger mt-2 btn-3 font-weight-semibold mb-2 buttonPayment" data-toggle="modal" data-target="#Approval">
                    <span>Saya Sudah Bayar</span>
                </button>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-5 font-weight-semibold text-center text-danger" id="exampleModalLabel">Detail Pembelian</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <h4><b>Alamat Pengiriman</b></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5><?= $SalesOrder['notes']; ?></h5>
                    </div>
                </div>
                <hr>
                <h4><b>Detail Menu Yang dibeli</b></h4>
                <div class=" table-responsive ">
                    <table class="table table-bordered shop-cart-table w-100 mt-2">
                        <thead class="bg-danger">
                            <tr>
                                <th class="product-name font-weight-bold pr-5">
                                    <center>Menu</center>
                                </th>
                                <th class="product-price font-weight-bold pr-5">
                                    <center>Harga</center>
                                </th>
                                <th class="product-quantity font-weight-bold">
                                    <center>Qty</center>
                                </th>
                                <th class="product-subtotal font-weight-bold">
                                    <center>Sub Total</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php foreach ($SalesOrderProduct as $product) : ?>
                                <tr class="text-center text-4 mt-2">
                                    <td class=""><?= $product['order_product_name']; ?></td>
                                    <td class="">Rp. <?= number_format($product['price']); ?></td>
                                    <td class="text-center"><?= $product['quantity']; ?> pcs</td>
                                    <td class="text-center">Rp. <?= number_format($product['total']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <h4 class="mt-2 text-2"><b>Catatan Pembelian :</b></h4>
                <p><span><?= $SalesOrder['notes']; ?></span></p>
                <hr>
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
                        <h4><b>Rp. <?= number_format($SalesOrder['total']); ?></b></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5>Total Biaya Pengiriman</h5>
                    </div>
                    <div class="col-6 text-right">
                        <h4><b>Rp. <?= number_format($SalesOrder['cost_delivery']); ?></b></h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger font-weight-semibold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Approval" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-4 text-color-danger font-weight-bold" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="close text-color-danger font-weight-bold" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('savePaymentProof'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row ">
                        <img src="assets/images/shippingPayment/contoh_bukti_pembayaran.jpg" class="img-thumbnail img-preview mx-auto d-block" height="75" width="250">
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <input type="file" id="FileButton" class="<?= ($validation->hasError('PaymentFile')) ? 'is-invalid' : ''; ?>  buttonFIle" name="PaymentFile" hidden onchange="previewImage()">
                            <div class="invalid-feedback">
                                <span> <?= $validation->getError('PaymentFile'); ?></span>
                            </div>
                            <label for="FileButton" class="btn LabelImage btn-danger font-weight-semibold btn-h-2 btn-v-3" id="ChooseBtn" style=" color:white; padding :0.5rem; border-radius : 0.3rem; cursor:pointer; margin-top:1rem;">Pilih File</label>
                            <p class="text-left mx-2 mt-2">Ukuran file gambar/foto maksimum hanya 1 mb, serta ektensi file yang diperbolehkan hanya : .JPG, .JPEG, .PNG</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="invoice" id="IDFromOrder" value="<?= $invoice; ?>">
                    <button type="submit" class="btn btn-outline-danger btn-h-2 btn-v-3 font-weight-bold">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>

<script>
    $(document).ready(function() {
        var endOfTime = new Date("<?= date("Y-m-d H:i:s", strtotime("+1 hours", $SalesOrder['created_at'])) ?>").getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = endOfTime - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            document.getElementById("waktu").innerHTML = minutes + " menit : " + seconds + " detik ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("waktu").innerHTML = "Waktu Pembayaran telah habis";
                const inv = $('#IDFromOrder').val();
                setTimeout("pageRedirect()", 1000);
            }
        }, 1000);
    });

    function pageRedirect() {
        window.location.replace("<?= base_url('cancelOrder?inv=' . $invoice); ?>");
    }
</script>
<?= $this->endSection(); ?>