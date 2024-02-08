<h3 class="text-center "><b>Ringkasan Belanja</b></h3>
<hr>
<div class="row mt-4">
    <div class="col-7">
        <span class="text-3 text-dark"><b>Jumlah barang</b></span>
    </div>
    <div class="col-5 text-right">
        <span class="text-3 text-dark"><?= $total_items; ?> Barang</span>
    </div>
</div>
<div class="row mt-3">
    <div class="col-5">
        <span class="text-3 text-dark"><b>Total Harga</b></span>
    </div>
    <div class="col-7 text-right">
        <span class="text-3 text-dark"><b> Rp. <?= number_format($subtotal); ?></b></span>
    </div>
</div>
<?php foreach ($cart as $item) : ?>
    <input type="hidden" name="rowid" id="RowID" value="<?= $item['rowid']; ?>">
<?php endforeach; ?>
<?php if ($cart == null) : ?>
    <button class="btn btn-primary mt-4 btn-block font-weight-semibold btn-h-2 btn-4 h-100 BtnCheck1" type="submit" style="background-color: #f1f3f7; border-color:#6c6c6e; color:#78797b ;" value="1"><span class="text-4">Checkout</span></button>
<?php else : ?>
    <a href="<?= base_url('checkout'); ?>" class="btn btn-danger border-light mt-4 font-weight-semibold btn-h-2 btn-4 h-100 btn-block" type="submit"><span class="text-4">Checkout</span></a>
<?php endif; ?>