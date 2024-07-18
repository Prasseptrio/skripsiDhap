<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>
<ul class="nav nav-tabs nav-tabs-default" id="tabDefault" role="tablist" style="background-color: #dfcccc;">
    <li class="nav-item">
        <a class="nav-link active" id="default-profile-tab" data-toggle="tab" href="#default-profile" role="tab" aria-controls="default-profile" aria-expanded="true">Profil</a>
    </li>
</ul>
<div class="tab-content" id="tabDefaultContent" style="background-color: #dfcccc;">
    <div class="tab-pane fade show active" id="default-profile" role="tabpanel" aria-labelledby="default-profile-tab">
        <div class="row">
            <div class="col-5 mx-2">
                <div class="card rounded mt-2 ">
                    <img src="<?= ($customer['profile_image'] != null) ? "assets/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>" class="img-fluid rounded mx-auto d-block mt-3" alt="" style="width: 250px; height: 250px;">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger border-light my-3 btn-3 font-weight-semibold mb-2 buttonPayment" data-toggle="modal" data-target="#Approval">
                            <span>Ubah Foto Profile</span>
                        </button>
                    </div>
                </div>
                <a href="<?= base_url('profile/changePassword'); ?>">
                    <button type="button" class="btn btn-outline-danger ml-2 my-3 btn-h-2 btn-v-3 border-light text-light font-weight-bold mx-auto d-block btn-block"> <i class="fas fa-lock"></i> Ubah Kata Sandi</button>
                </a>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-danger btn-rounded border-light text-light btn-sm mt-3 mb-3 btn-h-2 btn-v-3 font-weight-bold d-flex float-right" data-toggle="modal" data-target="#editProfileModal">
                    Ubah data profile &nbsp; <i class="fas fa-edit"></i>
                </button>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td class="font-weight-bold">Nama Lengkap</td>
                            <td><?= $customer['customer_fullname']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Email</td>
                            <td><?= $customer['customer_email']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Nomor HP/Telepon</td>
                            <td><?= ($customer['customer_whatsapp']) ? $customer['customer_whatsapp'] : '- <br> <i class="text-muted"> Nomor telepon belum lengkap</i>'; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Address -->
<div class="modal fade" id="Approval" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dfcccc;">
                <h5 class="modal-title text-color-light" id="exampleModalLabel">Ubah Foto Profile</h5>
                <button type="button" class="close text-color-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('profile/changeProfilePicture'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row ">
                        <img src="<?= ($customer['profile_image'] != null) ?  getenv('app.assetURL') . "/images/" . $customer['profile_image'] : base_url('assets/images/avatars/male.png'); ?>" class="img-thumbnail img-preview mx-auto d-block" height="75" width="250">
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <input type="file" id="FileButton" class="<?= ($validation->hasError('profilePicture')) ? 'is-invalid' : ''; ?>  buttonFIle" name="profilePicture" hidden onchange="previewImage()">
                            <div class="invalid-feedback">
                                <span> <?= $validation->getError('profilePicture'); ?></span>
                            </div>
                            <label for="FileButton" class="btn LabelImage btn-danger font-weight-semibold mx-auto d-block btn-block" id="ChooseBtn" style=" color:white; padding :0.5rem; border-radius : 0.3rem; cursor:pointer; margin-top:1rem;">Pilih File</label>
                            <p class="text-left mx-2 mt-2">Ukuran file gambar/foto maksimum hanya 1 mb, serta ektensi file yang diperbolehkan hanya : .JPG, .JPEG, .PNG</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="OldProfilePicture" id="OldProfilePicture" value="<?= $customer['profile_image']; ?>">
                    <button type="submit" class="btn btn-danger btn-h-2 btn-v-3 font-weight-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>