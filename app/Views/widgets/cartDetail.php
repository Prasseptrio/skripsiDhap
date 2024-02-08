<?php
$weight = 0;
foreach ($Cart as $cart) :
    $weight += $cart['weight'];
?>
    <tr class="cart-item">
        <td class="product-name"> <img src="<?= getenv('app.assetURL') . $cart['image']; ?>" class="img-fluid" width="67" alt="" /><?= $cart['name'] . ' ' . $cart['model']; ?></td>
        <td class="product-price text-center">Rp. <?= number_format($cart['price']); ?></td>
        <td class="product-quantity">
            <center>
                <input type="hidden" name="qty" id="QUANTITY<?= $cart['id']; ?>" value="<?= $cart['qty']; ?>">
                <?= $cart['qty']; ?>
            </center>
        </td>
        <td class="product-subtotal text-center">Rp. <?= number_format($cart['subtotal']); ?> <input type="hidden" name="weight" id="Weight" value="<?= $weight; ?>"></td>
    </tr>
<?php endforeach; ?>