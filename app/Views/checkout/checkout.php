<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="section pt-2 bg-light-2">
   <div class="container">
      <div class="row pb-4 mb-3">
         <div class="col-md-7 mb-4 mb-md-0 ">
            <div class="card-body p-3 bg-white rounded-lg">
               <h3 class="text-4 font-weight-bold">Alamat Pengiriman </h3>
               <hr>
               <h4 class="text-3 mb-3"><b><?= $customerAddress['customer_fullname']; ?>
                  </b> <span class="badge badge-secondary">Utama</span>
                  <button type="button" class="btn btn-rounded btn-1 btn-primary mb-2 btn-h-2 btn-v-3 font-weight-semibold" style="float: right;" data-toggle="modal" data-target="#changeAddress">Ubah Alamat</button>
               </h4>
               <h5 class="text-3 "><?= $customerAddress['customer_address']; ?></h5>
               <h5 class="text-3 "><?= $customerAddress['customer_subdistrict']; ?>, <?= $customerAddress['customer_city']; ?>, <?= $customerAddress['customer_province']; ?> <br> <?= $customerAddress['customer_postcode']; ?></h5>
               <hr class="">
               <div class="shop-cart">
                  <h3 class="font-weight-bold text-5 text-left">Produk Dipesan</h3>
                  <div class="table-responsive ">
                     <table class="shop-cart-table w-100 mb-3">
                        <thead>
                           <tr>
                              <th class="product-name pr-5" colspan="2" style="color: grey;">
                                 <center>Produk</center>
                              </th>
                              <th class="product-price pr-5" style="color: grey;">
                                 <center>Harga</center>
                              </th>
                              <th class="product-quantity " style="color: grey;">
                                 <center>Qty</center>
                              </th>
                              <th class="product-subtotal" style="color: grey;">
                                 <center>Total</center>
                              </th>
                           </tr>
                        </thead>
                        <tbody id="detailCart">
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class=" col-md-5 ">
            <div id="courierInput">
               <div class=" card-body p-3 mb-5 bg-white rounded-lg">
                  <h4 class="font-weight-bold text-4 mt-4 mb-3">Metode Pengiriman</h4>
                  <div class=" mb-3">
                     <select class="form-control bg-primary text-color-light border-0 rounded-lg font-weight-bold text-center " name="inputCouriers" id="inputCourier" required data-destination="<?= $customerAddress['customer_subdistrict_id']; ?>">
                        <option value="" class="bg-white text-dark">-- Pilihan Kurir --</option>
                        <?php foreach ($Courier as $courier) : ?>
                           <option value="<?= $courier['courier_code']; ?>" class="bg-white text-dark"><?= $courier['courier_name']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div id="serviceInput" hidden>
                     <h4 class="font-weight-bold text-4 mt-4  mb-3"> Layanan Pengiriman</h4>
                     <div id="loader" class="justify-content-center" hidden></div>
                     <div class=" mb-3" id="form-select" hidden>
                        <select class="form-control bg-primary text-color-light border-0 rounded-lg font-weight-bold text-center " id="inputServices" required>
                           <option value="">-- Pilihan Layanan --</option>
                        </select>
                     </div>
                  </div>
                  <form action="<?= base_url('saveSales'); ?>" method="post" enctype="multipart/form-data">
                     <div class="form-row row mb-3">
                        <div class="form-group col">
                           <label class="text-color-dark font-weight-bold" for="shipping_notes">Berikan Catatan:</label>
                           <textarea class="form-control line-height-1 bg-light-5" name="shipping_notes" id="Notes" rows="7"></textarea>
                        </div>
                     </div>
                     <div class="table-responsive mb-2 ">
                        <table class="cart-totals w-100 ">
                           <thead>
                           </thead>
                           <tbody class="border-top-0">
                              <tr>
                                 <td></td>
                                 <td>
                                    <span class="cart-total-label" style="float: right">Biaya Pengiriman</span>
                                 </td>
                                 <td>
                                    <span class="cart-total-value" style="float: right" id="CostDelivery">Pilih Pengiriman</span>
                                 </td>
                              </tr>
                              <tr class="border-bottom-0">
                                 <td></td>
                                 <td>
                                    <span class="cart-total-label text-4 text-primary " style="float: right">Total Tagihan</span>
                                 </td>
                                 <td>
                                    <span class="cart-total-value text-4 text-primary" style="float: right" id="grandTotaL">Rp <?= number_format($Total); ?></span>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="col-md-12  text-center mt-4">
                        <input type="hidden" name="inputService" id="Services">
                        <input type="hidden" name="inputWeight" id="Wght">
                        <input type="hidden" name="inputCourier" id="Couriers">
                        <input type="hidden" name="customerID" id="customerID" value="<?= session()->get('CID'); ?>">
                        <button type="submit" class="btn btn-outline btn-primary my-2 btn-5 font-weight-semibold btnPaymentMethod" hidden>
                           <span class="text-4">Lanjut Pembayaran</span>
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
</section>

<div class="modal fade" id="changeAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h5 class="modal-title text-color-light font-weight-bold" id="exampleModalLabel">Pilih Alamat</h5>
            <button type="button" class="close text-color-light" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="<?= base_url('profile/changeCustomerMainAddress'); ?>" method="post">
            <div class="modal-body">
               <?php foreach ($Address as $address) : ?>
                  <div class="form-check my-3 ">
                     <input class="form-check-input" type="radio" name="AddressID" value="<?= $address['address_id']; ?>" id="AddressID<?= $address['address_id']; ?>" <?= ($address['address_id'] == $customer['address_id']) ? 'checked' : ''; ?>>
                     <label class="form-check-label list-group" for="AddressID<?= $address['address_id']; ?>">
                        <li class="list-group-item list-group-item-action rounded list-group-item <?= ($address['address_id'] == $customer['address_id']) ? 'list-group-item-primary' : ''; ?>">
                           <h4 class="text-3 mb-3"><b><?= $address['customer_fullname']; ?> </h4>
                           <h5 class=" text-3 text-wrap"><?= $address['customer_address']; ?> <br> <?= $address['customer_subdistrict']; ?>, <?= $address['customer_city']; ?> , <?= $address['customer_province']; ?> <br><?= $address['customer_postcode']; ?></h5>
                           <?php if ($address['address_id'] == $customer['address_id']) : ?>
                              </b> <span class="badge badge-secondary ml-1">Utama</span>
                           <?php endif ?>
                        </li>
                     </label>
                  </div>
                  <input type="hidden" name="customerID" id="CustomerID" value="<?= $customer['customer_id']; ?>">
               <?php endforeach; ?>
               <div class="modal-footer">
                  <input type="hidden" name="param" value="1">
                  <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
   $(document).ready(function() {
      // // Load shopping cart
      $('#detailCart').load("<?= base_url('cart/loadCart'); ?>");

      $('#inputCourier').change(function() {
         let courier = $(this).val();
         let origin = '5507';
         let destination = $(this).data("destination");
         let product_sku = $('#productID').val();
         var weight = $('#Weight').val();
         let qty = $('#QUANTITY' + product_sku).val();
         $.ajax({
            url: "<?= base_url('service'); ?>",
            method: "GET",
            type: 'JSON',
            data: {
               origin: origin,
               destination: destination,
               weight: weight,
               courier: courier
            },
            beforeSend: function() {
               // Show image container
               $('#serviceInput').attr('hidden', false)
               $('#loader').attr('hidden', false)
               $('#form-select').attr('hidden', true)
            },
            success: function(data) {
               var rajaongkir = data["rajaongkir"]["results"]["0"]["costs"];
               $("#inputServices").html("<option value='' class='bg-white text-dark'>-- Pilihan Layanan --</option>");
               if (rajaongkir.length != 0) {
                  for (var i = 0; i < rajaongkir.length; i++) {
                     var cost = rajaongkir[i]['cost'];
                     $("#inputServices").append($('<option>', {
                        class: "bg-white text-dark",
                        value: rajaongkir[i]["service"] + '|' + cost["0"]["value"] + '|' + rajaongkir[i]['description'],
                        text: rajaongkir[i]['service'] + '\n' + '-' + ' ' + rajaongkir[i]['description'] + ' ' + '(' + 'estimasi' + ' ' + cost["0"]["etd"] + ' ' + 'hari' + ')'
                     }));
                  }
                  $('#Couriers').val(courier);
               } else {
                  $("#inputServices").html($('<option>', {
                     class: "bg-white text-dark",
                     value: '',
                     text: "Layanan Pengiriman Belum Tersedia"
                  }));
               }
            },
            complete: function(data) {
               $('#form-select').attr('hidden', false)
               // Hide image container
               $('#loader').attr('hidden', true)
            }
         });
      });
      $("#inputServices").change(function() {
         $('.btnPaymentMethod').attr('hidden', false)
         let value = $('#inputServices').val();
         let splitVal = value.split("|");
         let cost = splitVal[1];
         let format = new Intl.NumberFormat('in-ID', {
            style: 'currency',
            currency: 'IDR'
         }).format(cost)
         let splitNumber = format.split(",");
         let number = splitNumber[0];
         let total = $('#grndTotal').val();
         let subtotal = parseInt(total)
         let deliveryCost = parseInt(cost)
         let hitung = subtotal + deliveryCost;
         let numberformat = new Intl.NumberFormat('in-ID', {
            style: 'currency',
            currency: 'IDR'
         }).format(hitung);
         let NumberSplit = numberformat.split(",");
         let grandTotal = NumberSplit[0];
         let product_sku = $('#productID').val();
         var berat = $('#Weight').val();
         let qty = $('#QUANTITY' + product_sku).val();
         let weight = berat * qty;
         $("#Wght").val(weight)
         $("#CostDelivery").html(number)
         $('#grandTotaL').html(grandTotal);
         $("#CD").html(number)
         $('#GT').html(grandTotal);
         $('#Services').val(value);
      });
   });
</script>
<?= $this->endSection(); ?>