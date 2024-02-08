<?= $this->extend('layouts/mainProfile'); ?>
<?= $this->section('contentProfile'); ?>
<ul class="nav nav-tabs nav-tabs-default" id="tabDefault" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="default-profile-tab" data-toggle="tab" href="#default-profile" role="tab" aria-controls="default-profile" aria-expanded="true">Profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="address-tab" data-toggle="tab" href="#addressTab" role="tab" aria-controls="addressTab"><input type="file" hidden class="custom-file-input" id="customFile"> Daftar Alamat</a>
    </li>
</ul>
<div class="tab-content" id="tabDefaultContent">
    <div class="tab-pane fade show active" id="default-profile" role="tabpanel" aria-labelledby="default-profile-tab">
        <div class="row">
            <div class="col-5 mx-2">
                <div class="card rounded mt-2 ">
                    <img src="<?= ($customer['profile_image'] != null) ? getenv('app.assetURL') . "/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>" class="img-fluid rounded mx-auto d-block mt-3" alt="" style="width: 250px; height: 250px;">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary my-3 btn-3 font-weight-semibold mb-2 buttonPayment" data-toggle="modal" data-target="#Approval">
                            <span>Ubah Foto Profile</span>
                        </button>
                    </div>
                </div>
                <a href="<?= base_url('profile/changePassword'); ?>">
                    <button type="button" class="btn btn-outline-primary ml-2 my-3 btn-h-2 btn-v-3 font-weight-bold mx-auto d-block btn-block"> <i class="fas fa-lock"></i> Ubah Kata Sandi</button>
                </a>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-primary btn-rounded btn-sm mt-3 mb-3 btn-h-2 btn-v-3 font-weight-bold d-flex float-right" data-toggle="modal" data-target="#editProfileModal">
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
                            <td class="font-weight-bold">Telepon</td>
                            <td><?= ($customer['customer_telephone']) ? $customer['customer_telephone'] : '- <br> <i class="text-muted"> Nomor telepon belum lengkap</i>'; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold" width="30%">Alamat Utama</td>
                            <td>
                                <?php if ($customer['address_id'] == 0) : ?>
                                    <i class="text-muted"> Alamat belum lengkap</i>
                                    <a class="btn btn-link text-color-primary font-weight-bold text-decoration-none" data-toggle="modal" data-target="#adressModal">
                                        Tambah Alamat Utama
                                    </a>
                                <?php elseif ($customerAddress) : ?>
                                    <?= $customerAddress['customer_address'] . ', Kec./Kel. ' . $customerAddress['customer_subdistrict'] . ', ' . $customerAddress['customer_city'] . ', ' . $customerAddress['customer_province']; ?>
                                <?php else : ?>
                                    <i class="text-muted"> Alamat belum lengkap</i>
                                    <a class="btn btn-link text-color-primary font-weight-bold text-decoration-none" data-toggle="modal" data-target="#adressModal">
                                        Tambah Alamat Utama
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="addressTab" role="tabpanel" aria-labelledby="address-tab">
        <div class="text-right p-3">
            <button type="button" class="btn btn-primary btn-h-2 btn-v-3 font-weight-bold" data-toggle="modal" data-target="#adressModal">
                <?= ($customer['address_id']) ? 'Tambah Alamat' : 'Tambah Alamat Utama'; ?>
            </button>
        </div>
        <ul class="list-group px-2 ">
            <?php foreach ($Address as $address) : ?>
                <li class="list-group-item <?= ($address['address_id'] == $customer['address_id']) ? 'list-group-item-primary' : ''; ?>">
                    <h3 class="font-weight-bold <?= ($address['address_id'] == $customer['address_id']) ? 'text-primary' : ''; ?> text-4"> <?= $address['customer_fullname'] . '  - ' . $address['customer_company']; ?> <?= ($address['address_id'] == $customer['address_id']) ? '<span class="badge badge-light text-primary">Utama</span>' : ''; ?></h3>
                    <p class="text-color-dark mb-4">
                        <?= $address['customer_address'] . ', Kec./Kel. ' . $address['customer_subdistrict'] . ', ' . $address['customer_city'] . ', ' . $address['customer_province']; ?>
                    </p>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <form action="<?= base_url('profile/changeCustomerMainAddress'); ?>" method="post">
                            <input type="hidden" name="AddressID" id="AddressID" value="<?= $address['address_id']; ?>">
                            <input type="hidden" name="customerID" id="CustomerID" value="<?= $customer['customer_id']; ?>">
                            <button type="submit" class="btn btn-link font-weight-bold btn-sm text-success" <?= ($address['address_id'] == $customer['address_id']) ? 'hidden' : ''; ?>>Utama</button>
                        </form>
                        <button type="button" class="btn btn-link font-weight-bold btn-sm text-primary" data-toggle="modal" data-target="#updateAddress<?= $address['address_id']; ?>">Ubah </button>
                        <form action="<?= base_url('profile/deleteAddress'); ?>" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="AddressID" id="AddressID" value="<?= $address['address_id']; ?>">
                            <input type="hidden" name="CustomerID" id="CustomerID" value="<?= $customer['customer_id']; ?>">
                            <button type="submit" class="btn btn-link font-weight-bold btn-sm text-danger">Hapus </button>
                        </form>
                    </div>
                </li>
                <div class="modal fade" id="updateAddress<?= $address['address_id']; ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-color-light" id="exampleModalLabel">Ubah Alamat</h5>
                                <button type="button" class="close text-color-light" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('profile/updateAddress'); ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="AddressID" id="AddressID" value="<?= $address['address_id']; ?>">
                                    <input type="hidden" name="CustomerID" id="CustomerID" value="<?= $customer['customer_id']; ?>">
                                    <div class="form-group">
                                        <label class="text-color-dark" for="">Nama Penerima</label>
                                        <input type="text" class="form-control border-grey rounded" name="inputReceipent" id="inputReceipent" aria-describedby="helpId" placeholder="Tulis Nama Penerima" value="<?= $customer['customer_fullname']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-color-dark" for="inputProvince">Provinsi</label>
                                        <select class="form-control border-grey rounded" name="inputProvince" id="inputProvinceUpdate" required>
                                            <option value="<?= $address['customer_province_id']; ?>"><?= $address['customer_province']; ?></option>
                                            <?php foreach ($Province as $province) : ?>
                                                <option value="<?= $province['province_id']; ?>">
                                                    <?= $province['province']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-color-dark" for="inputCity">Kabupaten / Kota</label>
                                        <select class="form-control border-grey rounded" name="inputCity" id="inputCityUpdate" required>
                                            <option value="<?= $address['customer_city_id']; ?>"><?= $address['customer_city']; ?></option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-color-dark" for="inputSubdistrict">Kecamatan</label>
                                                <select class="form-control border-grey rounded" name="inputSubdistrict" id="inputSubdistrictUpdate" required>
                                                    <option value="<?= $address['customer_subdistrict_id']; ?>"><?= $address['customer_subdistrict']; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="text-color-dark" for="inputPostalcode">Kodepos</label>
                                                <input type="text" class="form-control border-grey rounded" name="inputPostalcode" id="inputPostalcode" placeholder="5 digit Kodepos" value="<?= $address['customer_postcode']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-color-dark" for="inputAddress">Alamat</label>
                                        <input type="text" class="form-control border-grey rounded" min-longth="5" name="inputAddress" id="inputAddress" placeholder="Tulis nama jalan,  nomor rumah, nomor kompleks, nama gedung" value="<?= $address['customer_address']; ?>" required>
                                        <small id="helpId" class="form-text text-muted">Minimal 5 karakter</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-color-dark" for="inputCompany">Nama Perusahaan</label>
                                        <input type="text" class="form-control border-grey rounded" min-longth="5" name="inputCompany" id="inputCompany" placeholder="" value="<?= $address['customer_company']; ?>">
                                        <small id="helpId" class="form-text text-muted">Tulis nama perusahaan jika dikirim ke kantor / perusahaan</small>
                                    </div>
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-lg btn-light border-grey btn-h-2 btn-v-3 font-weight-bold" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-lg btn-primary btn-h-2 btn-v-3 font-weight-bold">Simpan Ubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- Modal Address -->
<div class="modal fade" id="adressModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary">Tambah Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('profile/addCustomerAddress'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="customerID" value="<?= $customer['customer_id']; ?>">
                    <div class="form-group">
                        <label class="text-color-dark" for="">Nama Penerima</label>
                        <input type="text" class="form-control border-grey rounded" name="inputReceipent" id="inputReceipent" aria-describedby="helpId" placeholder="Tulis Nama Penerima" value="<?= $customer['customer_fullname']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="text-color-dark" for="inputProvince">Provinsi</label>
                        <select class="form-control border-grey rounded" name="inputProvince" id="inputProvince" required>
                            <option value="">-- Pilih Provinsi --</option>
                            <?php foreach ($Province as $province) : ?>
                                <option value="<?= $province['province_id']; ?>">
                                    <?= $province['province']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="loader" class="justify-content-center" hidden></div>
                    <div class="form-group" id="FormCity" hidden>
                        <label class="text-color-dark" for="inputCity">Kabupaten / Kota</label>
                        <select class="form-control border-grey rounded" name="inputCity" id="inputCity" required>
                            <option value="">-- Pilih Kabupaten / Kota --</option>
                        </select>
                    </div>
                    <div id="loader1" class="justify-content-center" hidden></div>
                    <div class="row" id="FormSubdistrict" hidden>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-color-dark" for="inputSubdistrict">Kecamatan</label>
                                <select class="form-control border-grey rounded" name="inputSubdistrict" id="inputSubdistrict" required>
                                    <option value="">-- Pilih Kacamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-color-dark" for="inputPostalcode">Kodepos</label>
                                <input type="text" class="form-control border-grey rounded" name="inputPostalcode" id="inputPostalcode" placeholder="5 digit Kodepos" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-color-dark" for="inputAddress">Alamat</label>
                        <input type="text" class="form-control border-grey rounded" min-longth="5" name="inputAddress" id="inputAddress" placeholder="Tulis nama jalan,  nomor rumah, nomor kompleks, nama gedung" required>
                        <small id="helpId" class="form-text text-muted">Minimal 5 karakter</small>
                    </div>
                    <div class="form-group">
                        <label class="text-color-dark" for="inputCompany">Nama Perusahaan</label>
                        <input type="text" class="form-control border-grey rounded" min-longth="5" name="inputCompany" id="inputCompany" placeholder="">
                        <small id="helpId" class="form-text text-muted">Tulis nama perusahaan jika dikirim ke kantor / perusahaan</small>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-lg btn-light border-grey btn-h-2 btn-v-3 font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-lg btn-primary btn-h-2 btn-v-3 font-weight-bold">Tambah Alamat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Approval" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
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
                            <label for="FileButton" class="btn LabelImage btn-primary font-weight-semibold mx-auto d-block btn-block" id="ChooseBtn" style=" color:white; padding :0.5rem; border-radius : 0.3rem; cursor:pointer; margin-top:1rem;">Pilih File</label>
                            <p class="text-left mx-2 mt-2">Ukuran file gambar/foto maksimum hanya 1 mb, serta ektensi file yang diperbolehkan hanya : .JPG, .JPEG, .PNG</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="OldProfilePicture" id="OldProfilePicture" value="<?= $customer['profile_image']; ?>">
                    <button type="submit" class="btn btn-primary btn-h-2 btn-v-3 font-weight-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>