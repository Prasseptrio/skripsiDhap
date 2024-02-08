<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div role="main" class="main">
   <div class="container ">
      <div class="header-cart my-4">
         <h2 class="font-weight-bold">Keranjang Belanja</h2>
      </div>
      <?= $this->include('common/alerts'); ?>
      <div class="row pb-4 mx-4">
         <div class="col card-body p-3 bg-white rounded-lg ">
            <?php if ($Cart) : ?>
               <div class="row">
                  <div class="col-8 mb-2 ">
                     <?php krsort($Cart);
                     foreach ($Cart as $cart) : ?>
                        <div class="input-button">
                           <input class="form-check-input checkitemBox mr-2" type="checkbox" id="CheckBox<?= $cart['product_id']; ?>" data-id="<?= $cart['product_id']; ?>" data-name="<?= $cart['product_name']; ?>" data-price="<?= $cart['price']; ?>" data-sku="<?= $cart['product_sku']; ?>" data-image="<?= $cart['product_image']; ?>" data-customer="<?= $customer['customer_id']; ?>">
                        </div>
                        <div class="detail-cart mb-3">
                           <div class="row justify-content-center">
                              <div class="col-3">
                                 <a href="<?= base_url($cart['product_id']); ?>">
                                    <img src="<?= getenv('app.assetURL') . ($cart['product_image']); ?>" class="img-fluid mx-2" width="100" style="max-height: 200px;" alt="<?= $cart['product_name']  ?>" />
                                 </a>
                              </div>
                              <div class="col-8 mt-2">
                                 <br>
                                 <br>
                                 <br>
                                 <a href="<?= base_url($cart['product_id']); ?>">
                                    <span class="text-3"><b><?= $cart['product_name']; ?></b></span><br>
                                    <span class="text-4"> <b>Rp. <?= number_format($cart['price']); ?></b></span>
                                 </a>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-5 d-flex justify-content-end">
                                 <div class="quantity">
                                    <input type="button" value="-" class="minus QunatitY rounded" id="Minus<?= $cart['product_id']; ?>" <?= ($cart['quantity'] <= 1) ? 'disabled' : ''; ?> data-id="<?= $cart['product_id']; ?>" data-price="<?= $cart['price']; ?>" data-sku="<?= $cart['product_sku']; ?>">
                                    <input type="number" step="1" min="1" name="quantity" value="<?= $cart['quantity'] ?>" id="qtY<?= $cart['product_id']; ?>" title="Qty" class="qty inputQuantity" size="2" data-sku="<?= $cart['product_sku']; ?>" data-id="<?= $cart['product_id']; ?>" data-price="<?= $cart['price']; ?>">
                                    <input type="button" value="+" class="plus PLUS rounded" data-id="<?= $cart['product_id']; ?>" data-price="<?= $cart['price']; ?>" data-sku="<?= $cart['product_sku']; ?>">
                                 </div>
                              </div>
                              <div class="col-5 text-right">
                                 <h4 class="d-inline"><b>Total :</b></h4> <span class="text-5 mt-2" id="SubTOtal<?= $cart['product_id']; ?>">Rp. <?= number_format($cart['price'] * $cart['quantity']); ?></span>
                              </div>
                              <div class="col-2 text-right">
                                 <form action="<?= base_url('cart/deleteProductCart'); ?>" method="post" class="d-inline">
                                    <input type="hidden" name="productID" id="productID" value="<?= $cart['product_id']; ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-light btn-rounded justify-content-center align-items-center delete-product"><i class="lnr lnr-trash text-dark text-5"></i></button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <hr style="border-top: 3px solid #f2f2f2;">
                     <?php endforeach; ?>
                  </div>
                  <div class="col-4">
                     <div class="ml-3 align-items-center py-5" id="DetailTotal">
                        <h3 class="text-center"><b>Ringkasan Belanja</b></h3>
                        <hr>
                        <div class="row mt-4">
                           <div class="col-7">
                              <span class="text-3 text-dark"><b>Jumlah Menu</b></span>
                           </div>
                           <div class="col-5 text-right">
                              <span class="text-3">0 Menu</span>
                           </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-5">
                              <span class="text-3 text-dark"><b>Total Harga</b></span>
                           </div>
                           <div class="col-7 text-right">
                              <span class="text-3"><b> Rp. 0</b></span>
                           </div>
                        </div>
                        <button class="btn btn-danger  mt-4 btn-block font-weight-semibold btn-h-2 btn-4 h-100 BtnCheck" style="background-color: #f1f3f7; border-color:#f1f3f7; color:#78797b ;" type="submit"><span class="text-4">Checkout</span></button>
                     </div>
                  </div>
               </div>
            <?php else : ?>
               <div class="card bg-light-5 border-2">
                  <div class="card-body">
                     <div class="row">
                        <div class="col text-center">
                           <span>Keranjang Masih Kosong, Yuk Segera Belanja....</span>
                        </div>
                     </div>
                  </div>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('javascript'); ?>
<script>
   $(document).ready(function() {
      $('.QunatitY').click(function() {
         const product_id = $(this).data("id");
         let price = $(this).data("price");
         let quantity = $('#qtY' + product_id).val();
         let total = price * quantity;
         let numberformat = new Intl.NumberFormat('in-ID', {
            style: 'currency',
            currency: 'IDR'
         }).format(total);
         let splitNumber = numberformat.split(",");
         let grandTotal = splitNumber[0];
         $('#SubTOtal' + product_id).html(grandTotal)
         $('#Subtotal' + product_id).html(grandTotal)
         if (quantity <= 1) {
            $('#Minus' + product_id).attr("disabled", true)
         }
         if ($('#CheckBox' + product_id).prop("checked") == true) {
            let qty = $('#qtY' + product_id).val();
            let harga = $(this).data("price");
            $.ajax({
               url: "<?= base_url('cart/updateFormWishlist'); ?>",
               method: "POST",
               type: 'JSON',
               data: {
                  id: product_id,
                  qty: qty,
                  price: harga,
               },
               success: function(result) {
                  $('#DetailTotal').html(result);
               }
            });
         }
      });
      $('.PLUS').click(function() {
         const product_id = $(this).data("id");
         let price = $(this).data("price");
         let quantity = $('#qtY' + product_id).val();
         let total = price * quantity;
         let numberformat = new Intl.NumberFormat('in-ID', {
            style: 'currency',
            currency: 'IDR'
         }).format(total);
         let splitNumber = numberformat.split(",");
         let grandTotal = splitNumber[0];
         $('#SubTOtal' + product_id).html(grandTotal)
         $('#Subtotal' + product_id).html(grandTotal)
         if (quantity >= 1) {
            $('#Minus' + product_id).attr("disabled", false)
         }
         if ($('#CheckBox' + product_id).prop("checked") == true) {
            let id = product_id;
            let qty = $('#qtY' + product_id).val();
            let harga = $(this).data("price");
            $.ajax({
               url: "<?= base_url('cart/updateFormWishlist'); ?>",
               method: "POST",
               type: 'JSON',
               data: {
                  id: product_id,
                  qty: qty,
                  price: harga,
               },
               success: function(result) {
                  $('#DetailTotal').html(result);
               }
            });
         }
      })

      $('.checkitemBox').click(function() {
         const product_id = $(this).data("id");
         if ($(this).prop("checked") == true) {
            const cust = $(this).data("customer");
            const price = $(this).data("price");
            const image = $(this).data("image");
            let quantity = $('#qtY' + product_id).val();
            let name = $(this).data("name");
            $.ajax({
               url: "<?= base_url('cart/insertFormWishlist'); ?>",
               method: "POST",
               type: 'JSON',
               data: {
                  id: product_id,
                  name: name,
                  qty: quantity,
                  price: price,
                  customer: cust,
                  image: image,
               },
               success: function(result) {
                  const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',
                     showConfirmButton: false,
                     timer: 1500,
                     timerProgressBar: true,
                     didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                     }
                  })

                  Toast.fire({
                     icon: 'success',
                     title: 'Berhasil Dipilih'
                  })
                  $('#DetailTotal').html(result);
               }
            });
         } else {
            let row_id = $('#RowID').val();
            const product_sku = $(this).data("sku");

            $.ajax({
               url: "<?= base_url('cart/removeFormWishlist'); ?>",
               method: "POST",
               type: 'JSON',
               data: {
                  rowid: row_id,
                  sku: product_sku
               },
               success: function(result) {
                  $('#DetailTotal').html(result);
                  $('.BtnCheck1').click(function() {
                     const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                           toast.addEventListener('mouseenter', Swal.stopTimer)
                           toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                     })

                     Toast.fire({
                        icon: 'error',
                        title: 'Silahkan Pilih Menu'
                     })
                  })
               }
            });
         }
      })

      //Update Quantity By Product
      $('.inputQuantity').change(function() {
         let row_id = $('#RowID').val();
         let quantity = $(this).val();
         const product_id = $(this).data("id");
         let price = $(this).data("price");
         let total = price * quantity;
         let numberformat = new Intl.NumberFormat('in-ID', {
            style: 'currency',
            currency: 'IDR'
         }).format(total);
         let splitNumber = numberformat.split(",");
         let grandTotal = splitNumber[0];
         $('#SubTOtal' + product_id).html(grandTotal)
         $('#Subtotal' + product_id).html(grandTotal)
         if (quantity <= 1) {
            $('#Minus' + product_id).attr("disabled", true)
         }
         $.ajax({
            url: "<?= base_url('cart/updateFormWishlist'); ?>",
            method: "POST",
            type: 'JSON',
            data: {
               sku: product_sku,
               qty: quantity,
               price: price,
            },
            success: function(result) {
               $('#DetailTotal').html(result);
            }
         });
      });
      $('.BtnCheck').click(function() {
         const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         })
         Toast.fire({
            icon: 'error',
            title: 'Silahkan Pilih Menu'
         })
      })
   });
</script>
<?= $this->endSection(); ?>