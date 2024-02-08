<?php
foreach ($Cart as $cart) :

?>
    <tr class="cart-item">
        <td class="img"><img src="<?= getenv('app.assetURL') . $cart['image']; ?>" class="img-fluid" width="67" style="max_height:200px" alt="" /></td>
        <td><?= $cart['name'] ?></td>
        <td class="product-price text-center">Rp. <?= number_format($cart['price']); ?> </td>
        <td class="product-quantity">
            <center>
                <input type="hidden" name="qty" id="QUANTITY<?= $cart['id']; ?>" value="<?= $cart['qty']; ?>">
                <?= $cart['qty']; ?>
            </center>
        </td>
        <input type="hidden" name="productID" id="productID" value="<?= $cart['id']; ?>">
        <td class="product-subtotal text-center">Rp. <?= number_format($cart['subtotal']); ?> </td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan=3> <span class="cart-total-label" style="float: right"><b>Subtotal </b></span></td>
    <td colspan=4 class="font-weight-bold">
        <h5 class="text-right"><input type="hidden" name="grandTotal" id="grndTotal" value="<?= $total; ?>"> <b>Rp. <?= number_format($total); ?></b></h5>
    </td>
</tr>