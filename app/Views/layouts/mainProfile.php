<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="container mt-3">
    <div class="row ">
        <aside class="sidebar col-md-3 col-lg-3 order-2 order-md-1 ">
            <div class="card mb-5 rounded shadow-sm">
                <div class="card-body pt-4">
                    <div class="image-frame">
                        <img src="<?= ($customer['profile_image'] != null) ?   "assets/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>" class="img-fluid rounded-circle mx-auto d-block" alt="" style="width: 125px; height: 125px;">
                    </div>
                    <div class="text-center mb-3 ">
                        <h3 class="text-3 mt-3 font-weight-bold"><?= $customer['customer_fullname']; ?></h3>
                    </div>
                    <hr>
                    <a href="<?= base_url('profile'); ?>" class="btn btn-block text-2 font-weight-semibold text-left <?= ($Rescource == 'profile') ? 'btn-rounded btn-outline-light' : ''; ?>" <?= ($Rescource == 'profile') ? ' style="pointer-events: none"' : ''; ?>>Profile</a>
                    <hr>
                    <a href="<?= base_url('transaction'); ?>" class="btn btn-block text-2 font-weight-semibold text-left <?= ($Rescource == 'transaction') ? 'btn-rounded btn-outline-light' : ''; ?>">Daftar Transaksi</a>
                    <hr>
                    <a href=" <?= base_url('wishlist'); ?>" class="btn btn-block text-2 font-weight-semibold text-left">Wishlist</a>
                    <hr>
                    <a href=" <?= base_url('cart'); ?>" class="btn btn-block text-2 font-weight-semibold text-left">Keranjang Belanja</a>
                </div>
            </div>
        </aside>
        <div class="col-md-9 col-lg-9 order-1 order-md-2 card card-body p-0 rounded">
            <?= $this->include('common/alerts'); ?>
            <?= $this->renderSection('contentProfile'); ?>
        </div>
    </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dfcccc;">
                <h5 class="modal-title">Ubah Biodata Diri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('profile/updateProfile'); ?>" method="post">
                <input type="hidden" name="customerID" value="<?= $customer['customer_id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-sm border-grey rounded" name="inputName" id="inputName" aria-describedby="helpId" value="<?= $customer['customer_fullname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Alamat Email</label>
                        <input type="text" class="form-control form-control-sm border-grey rounded" name="inputEmail" id="inputEmail" aria-describedby="helpId" value="<?= $customer['customer_email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputTelephone">Nomor HP/Telepon</label>
                        <input type="text" class="form-control form-control-sm border-grey rounded" name="inputTelephone" id="inputTelephone" aria-describedby="helpId" value="<?= $customer['customer_whatsapp']; ?>">
                    </div>

                </div>
                <div class="modal-footer" style="background-color: #dfcccc;">
                    <button type="button" class="btn btn-light border-grey" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ubah Data Diri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $('document').ready(function() {
        $("#inputProvince").on('change', function() {
            $("#inputCity").html("<option value=''> -- Pilih Kabupaten / Kota --</option>");
            var provinceID = $(this).val();
            $.ajax({
                url: "<?= base_url('getCity') ?>",
                type: 'GET',
                data: {
                    'provinceID': provinceID,
                },
                dataType: 'json',
                beforeSend: function() {
                    // Show image container
                    $('#loader').attr('hidden', false)
                    $('#FormCity').attr('hidden', true)
                },
                success: function(data) {
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#inputCity").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]['type'] + ' ' + results[i]['city_name']
                        }));
                    }
                },
                complete: function(data) {
                    $('#FormCity').attr('hidden', false)
                    // Hide image container
                    $('#loader').attr('hidden', true)
                }
            });
        });
        $("#inputCity").on('change', function() {
            $("#inputSubdistrict").html("<option value=''> -- Pilih Kecamatan --</option>");
            var cityID = $(this).val();
            $.ajax({
                url: "<?= base_url('getSubdistrict') ?>",
                type: 'GET',
                data: {
                    'cityID': cityID,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loader1').attr('hidden', false)
                    $('#FormSubdistrict').attr('hidden', true)
                },
                success: function(data) {
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#inputSubdistrict").append($('<option>', {
                            value: results[i]["subdistrict_id"],
                            text: results[i]['subdistrict_name']
                        }));
                    }
                },
                complete: function(data) {
                    $('#FormSubdistrict').attr('hidden', false)
                    // Hide image container
                    $('#loader1').attr('hidden', true)
                }
            });
        });
        $("#inputProvinceUpdate").on('change', function() {
            $("#inputCityUpdate").html("<option value=''> -- Pilih Kabupaten / Kota --</option>");
            var provinceID = $(this).val();
            $.ajax({
                url: "<?= base_url('getCity') ?>",
                type: 'GET',
                data: {
                    'provinceID': provinceID,
                },
                dataType: 'json',

                success: function(data) {
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#inputCityUpdate").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]['type'] + ' ' + results[i]['city_name']
                        }));
                    }
                }
            });
        });
        $("#inputCityUpdate").on('change', function() {
            $("#inputSubdistrictUpdate").html("<option value=''> -- Pilih Kecamatan --</option>");
            var cityID = $(this).val();
            $.ajax({
                url: "<?= base_url('getSubdistrict') ?>",
                type: 'GET',
                data: {
                    'cityID': cityID,
                },
                dataType: 'json',
                success: function(data) {
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#inputSubdistrictUpdate").append($('<option>', {
                            value: results[i]["subdistrict_id"],
                            text: results[i]['subdistrict_name']
                        }));
                    }

                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>