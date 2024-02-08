<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?= $this->include('common/alerts'); ?>
<section class="section pt-2 bg-light-2">
   <div class="container">
      <div class="row pb-4 mb-3">
         <div class="col-md-7 mb-4 mb-md-0 ">
            <div class="card-body p-3 bg-white rounded-lg">
               <hr class="">
               <div class="shop-cart">
                  <h3 class="font-weight-bold text-5 text-left">Menu yang Dipesan</h3>
                  <div class="table-responsive ">
                     <table class="shop-cart-table w-100 mb-3">
                        <thead>
                           <tr>
                              <th class="product-name pr-5" colspan="2" style="color: grey;">
                                 <center>Menu</center>
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
               <form action=" <?= base_url('saveSales'); ?>" method="post" enctype="multipart/form-data">
                  <div class=" card-body p-3 mb-5 bg-white rounded-lg">
                     <h4 class="font-weight-bold text-4 mt-4 mb-3">Metode layanan</h4>
                     <div class=" mb-3">
                        <select class="form-control bg-danger text-color-light border-0 rounded-lg font-weight-bold text-center " name="inputServices" id="inputServices" required>
                           <option value="" class="bg-white text-dark">-- Pilihan Layanan --</option>
                           <option value="1" class="bg-white text-dark">Self Pickup</option>
                           <option value="2" class="bg-white text-dark">Delivery</option>
                        </select>
                     </div>
                     <div id="serviceSelfPickup" hidden>
                        <h4 class="font-weight-bold text-4 mt-4  mb-3"> Tanggal Pengambilan</h4>
                        <input type="date" class="form-control bg-danger text-light font-weight-bold datePickup" name="datePickup" value="<?= date('Y-m-d'); ?>">
                     </div>
                     <div id="serviceDelivery" hidden>
                        <h4 class="font-weight-bold text-4 mt-4  mb-3"> Tanggal Pengantaran</h4>
                        <input type="date" class="form-control bg-danger text-light font-weight-bold datePickup" name="datePickup" value="<?= date('Y-m-d'); ?>">
                     </div><br>
                     <div class="form-row row mb-3">
                        <div class="form-group col">
                           <label class="text-color-dark font-weight-bold" for="shipping_notes">Berikan Catatan:</label>
                           <textarea class="form-control line-height-1 bg-light-5" name="shipping_notes" id="Notes" rows="7" placeholder="---Sertakan alamat lengkap jika memilih layanan Delivery---" required></textarea>
                        </div>
                     </div>
                     <div class="table-responsive mb-2 ">
                        <table class="cart-totals w-100 ">
                           <thead>
                           </thead>
                           <tbody class="border-top-0">
                              <tr id="CostDelivery" hidden>
                                 <input type="hidden" name="CostDelivery" id="DeliveryCost" value="20000">
                                 <td></td>
                                 <td>
                                    <span class="cart-total-label" style="float: right">Biaya Pengiriman</span>
                                 </td>
                                 <td>
                                    <span class="cart-total-value" style="float: right">Rp. 20.000,00</span>
                                 </td>
                              </tr>
                              <tr class="border-bottom-0">
                                 <td></td>
                                 <td>
                                    <span class="cart-total-label text-4 text-dark " style="float: right">Total Tagihan</span>
                                 </td>
                                 <td>
                                    <span class="cart-total-value text-4 text-danger" style="float: right" id="grandTotaL">Rp <?= number_format($Total); ?></span>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="col-md-12  text-center mt-4">
                        <input type="hidden" name="inputService" id="Services">
                        <input type="hidden" name="grandTotal" id="GT">
                        <input type="hidden" name="customerID" id="customerID" value="<?= session()->get('CID'); ?>">
                        <button type="submit" class="btn btn-outline btn-danger my-2 btn-3 font-weight-semibold btnPaymentMethod" hidden>
                           <span class="text-4 ">Lanjut Pembayaran</span>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
   $(document).ready(function() {
      // // Load shopping cart
      $('#detailCart').load("<?= base_url('cart/loadCart'); ?>");

      $("#inputServices").change(function() {
         $('.datePickup').prop("required", true);;
         if ($(this).val() == 2) {
            let cost = $('#DeliveryCost').val();
            $('.btnPaymentMethod').attr('hidden', false);
            $('#CostDelivery').attr('hidden', false);
            $('#serviceDelivery').attr('hidden', false);
            $('#serviceSelfPickup').attr('hidden', true);
            let total = $('#grndTotal').val();
            let subtotal = parseInt(total)
            let deliveryCost = parseInt(cost)
            let hitung = subtotal + deliveryCost;
            let numberformat = new Intl.NumberFormat('in-ID', {
               style: 'currency',
               currency: 'IDR'
            }).format(hitung);
            $('#grandTotaL').html(numberformat);
            $('#GT').val(hitung);
            $('#Services').val($(this).val());
         } else {
            $('.btnPaymentMethod').attr('hidden', false);
            $('#serviceSelfPickup').attr('hidden', false);
            $('#CostDelivery').attr('hidden', true);
            $('#serviceDelivery').attr('hidden', true);
            let total = $('#grndTotal').val();
            let numberformat = new Intl.NumberFormat('in-ID', {
               style: 'currency',
               currency: 'IDR'
            }).format(total);
            $('#grandTotaL').html(numberformat);
            $('#GT').val(total);
            $('#Services').val($(this).val());
         }
      });
   });
</script>
<?= $this->endSection(); ?>