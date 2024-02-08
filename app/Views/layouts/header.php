<header id="header">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column justify-content-start">
                    <div class="header-logo">
                        <a href="<?= base_url(); ?> ">
                            <img alt="Logo Karnevor" width="250" height="48" src="<?= base_url('assets/images/brand/karnevor_logo_side.png'); ?> ">
                        </a>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <form class="search-form d-none d-md-block" action="<?= base_url('search'); ?>" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" placeholder="Cari Menu..." aria-label="Cari Menu...">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="header-column justify-content-end">
                    <div class="mini-cart order-2 mr-2">
                        <div class="mini-cart-icon">
                            <img src="<?= base_url('assets/images/icons/cart-bag.svg') ?>" class="img-fluid" alt="" />
                            <span class="badge badge-danger rounded-circle"><?= ($TotalCart) ? $TotalCart : '0'; ?></span>
                        </div>
                        <div class="mini-cart-content">
                            <div class="inner-wrapper bg-light rounded ">
                                <?php if ($Cart) : ?>
                                    <div class="mini-cart-total auto">
                                        <?php krsort($Cart);
                                        foreach ($Cart as $cart) : ?>
                                            <div class="row mb-3">
                                                <div class="col-7">
                                                    <h2 class="text-color-default font-secondary text-1 mt-3 mb-0"><?= $cart['product_name'] . ' '; ?></h2>
                                                    <strong class="text-color-dark">
                                                        <span class="qty"><?= $cart['quantity']; ?> x</span>
                                                        <span class="product-price">Rp. <?= number_format($cart['price']); ?></span>
                                                    </strong>
                                                </div>
                                                <div class="col-5">
                                                    <div class="product-image">
                                                        <img src="<?= getenv('app.assetURL') . $cart['product_image']; ?>" class="img-fluid rounded" alt="<?= $cart['product_name'] . ' '; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="mini-cart-total">
                                        <div class="row">
                                            <div class="col">
                                                <strong class="text-color-dark">TOTAL:</strong>
                                            </div>
                                            <div class="col text-right">
                                                <strong class="total-value text-color-dark">Rp. <?= number_format($GrandTotal); ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mini-cart-actions">
                                        <div class="row">
                                            <div class="col pr-1">
                                                <a href="<?= base_url('cart'); ?>" class="btn btn-danger font-weight-bold rounded text-0">Lihat Keranjang Belanja</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    Oppss... Keranjang Belanja Kosong!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <div class="mini-cart order-2">
                            <div class="mini-cart-icon">
                                <button type="button" class="btn btn-outline-white inner-wrapper  font-weight-bold order-3 d-none d-sm-block text-dark mr-2 pt-1 text-2" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= ($customer['profile_image'] != null) ?   "assets/images/" . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>" class="img-fluid rounded-circle" alt="" style="width:25px; height:25px;">
                                    <small class="font-weight-bold"><?php $text = substr(session()->get('CustName'), 0, 15);
                                                                    $texCut = strrpos($text, ' ');
                                                                    echo substr(session()->get('CustName'), 0, $texCut);; ?></small>
                                </button>
                            </div>
                            <div class="mini-cart-content">
                                <div class="inner-wrapper bg-light rounded font-weight-bold">
                                    <a href="<?= base_url('profile'); ?>">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="<?= ($customer['profile_image'] != null) ?  "assets/images/"  . $customer['profile_image']  : base_url('assets/images/avatars/male.png'); ?>" class="img-fluid rounded" alt="" style="width: 50px; height:50px;">
                                            </div>
                                            <div class="col-8 mt-2">
                                                <p class="font-weight-bold text-wrap"><?= session()->get('CustName'); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                    <hr>
                                    <a class="dropdown-item" href="<?= base_url('profile'); ?>">Akun Saya</a>
                                    <a class="dropdown-item" href="<?= base_url('transaction'); ?>">Pesanan Saya</a>
                                    <a class="dropdown-item" href="<?= base_url('cart'); ?>">Keranjang Belanja</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url('logout'); ?>">Keluar</a>
                                </div>
                            </div>

                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('login'); ?> " class="btn btn-outline-danger  font-weight-bold order-3 d-none d-sm-block ml-2 mr-2 pt-1 text-1">Masuk</a>
                        <a href="<?= base_url('register'); ?> " class="btn btn-danger  font-weight-bold order-4 d-none d-sm-block mr-2 pt-1 text-1">Daftar</a>
                    <?php endif; ?>
                    <form class="search-form-mobile d-md-none" method="GET">
                        <div class="mobile-search-toggle"><i class="lnr lnr-magnifier"></i></div>
                        <div class="input-group">
                            <input type="text" name="s" placeholder="Cari Menu..." aria-label="Cari Menu...">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</header>