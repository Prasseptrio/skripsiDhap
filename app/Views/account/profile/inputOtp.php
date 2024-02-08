<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<section class="section pt-2">
    <div class="container d-flex justify-content-center">
        <div class="card card-body col-8 bg-white rounded-lg p-3">
            <?= $this->include('common/alerts'); ?>
            <form action="<?= base_url('profile/save'); ?>" method="post">
                <h3 class="text-6 text-center font-weight-semibold mb-4">Masukan Kode Otp</h3>
                <div class=" text-center my-4">
                    <label class="text-color-dark my-3" for="num">Masukan Kode OTP yang sudah di kirim ke email anda.</label><br>
                    <input type="text" class="num" name="1" maxlength="1" required>
                    <input type="text" class="num" name="2" maxlength="1" required>
                    <input type="text" class="num" name="3" maxlength="1" required>
                    <span class="splitter">&ndash;</span>
                    <input type="text" class="num" name="4" maxlength="1" required>
                    <input type="text" class="num" name="5" maxlength="1" required>
                    <input type="text" class="num" name="6" maxlength="1" required>
                </div>
                <div class="text-center" id="btn-submit">
                    <button type="submit" class="btn btn-primary my-3 btn-3 font-weight-semibold" id="btnRegister">Simpan Password</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
<?= $this->section('javascript'); ?>
<script>
    const nums = document.querySelectorAll('.num')
    const form = document.querySelector('form')

    nums.forEach((num, index) => {
        num.dataset.id = index

        num.addEventListener('keyup', () => {
            if (num.value.length == 1) {
                if (nums[nums.length - 1].value.length == 1) form
                nums[parseInt(num.dataset.id) + 1].focus()
            }
        })
    })
</script>
<?= $this->endSection(); ?>