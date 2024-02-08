<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<section class="section pt-2">
    <div class="container d-flex justify-content-center">
        <div class="card card-body col-8 rounded-lg p-3" id="body" style="background-color: #dfcccc;">
            <?= $this->include('common/alerts'); ?>
            <form action="<?= base_url('profile/sentOtp'); ?>" method="post">
                <div class="change-password">
                    <h3 class="text-6 text-center font-weight-semibold mb-4">Ubah Kata Sandi</h3>
                    <div class="row d-flex justify-content-left">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="text-color-dark" for="inputPasswordNow">Kata Sandi Saat Ini :</label>
                                <input type="password" class="form-control  border-grey rounded" name="inputPasswordNow" id="oldPassword" required>
                                <small id="textOldPass" class="form-text text-danger" hidden>Password yang dimasukkan salah!</small>
                                <div class="invalid-feedback">
                                    <span> <?= $validation->getError('inputPasswordNow'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-left">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-color-dark" for="inputPassword">Kata Sandi Baru :</label>
                                <input type="password" class="form-control  border-grey rounded>" name="inputPassword" id="newPassword" required>
                                <small id="pass" class="form-text text-dark">Password yang dimasukkan minimal 6 karakter.</small>
                                <small id="textPassOld" class="form-text text-danger" hidden>Password yang dimasukkan tidak sama dengan password lama.</small>
                                <div class="invalid-feedback">
                                    <span> <?= $validation->getError('inputPassword'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-color-dark" for="inputRetypePassword">Ulangi Kata Sandi Baru :</label>
                                <input type="password" class="form-control  border-grey rounded" name="inputRetypePassword" id="RetypePassword" aria-label="Ulangi Password" required>
                                <small id="textPass" class="form-text text-danger" hidden>Password yang dimasukkan tidak sama.</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center" id="btn-submit">
                        <input type="hidden" name="Email" id="emailCust" value="<?= $customer['customer_email']; ?>">
                        <input type="hidden" name="customerID" id="CustomerID" value="<?= $customer['customer_id']; ?>">
                        <button type="submit" class="btn btn-danger my-3 btn-3 font-weight-semibold" id="btnRegister" disabled>Simpan Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script>
    $('document').ready(function() {
        $('#oldPassword').change(function() {
            let email = $('#emailCust').val();
            let oldpass = $(this).val();
            $.ajax({
                url: "<?= base_url('profile/checkPassword'); ?>",
                method: "POST",
                type: 'JSON',
                data: {
                    password: oldpass,
                    email: email
                },
                success: function(result) {
                    if (result == 0) {
                        $('#textOldPass').removeAttr('hidden');
                    } else {
                        $('#textOldPass').attr('hidden', true);
                    }
                }
            });
        });
        $('#newPassword').keyup(function() {
            let oldpass = $('#oldPassword').val();
            let newpass = $(this).val();
            if (oldpass == newpass) {
                $('#pass').attr('hidden', true);
                $('#textPassOld').removeAttr('hidden');
            } else {
                $('#pass').removeAttr('hidden');
                $('#textPassOld').attr('hidden', true);
            }
        });
        $('#RetypePassword').keyup(function() {
            let pass = $('#newPassword').val();
            let retype = $(this).val();
            if (pass != retype) {
                $('#textPass').removeAttr('hidden');
                $('#btnRegister').attr('disabled', true);
            } else {
                $('#textPass').attr('hidden', true);
                $('#btnRegister').removeAttr('disabled');
            }
        });
    });
</script>
<?= $this->endSection(); ?>