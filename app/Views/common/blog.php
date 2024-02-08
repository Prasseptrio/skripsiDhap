<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="page-header mb-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 text-left">
                <span class="tob-sub-title text-color-primary d-block">OUR BLOG</span>
                <h1 class="font-weight-bold">INFORMASI UPDATE TENTANG INDUSTRI TERKINI</h1>
                <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb justify-content-start justify-content-md-end">
                    <li><a href="#">Home</a></li>
                    <li class="active">Blog</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <?php foreach ($Blog as $blog) : ?>
                <div class="col-sm-6 col-lg-6 mb-4 pb-2">
                    <a href="<?= base_url('blog/' . $blog['post_slug']); ?> ">

                        <div class="card card-style-5 bg-light-5 rounded border-0 p-3" data-plugin-image-background data-plugin-options="{'imageUrl': '<?= getenv('app.assetURL') . $blog['post_header_image'] ?>'}">
                            <div class="card-body p-4">
                                <h3 class="font-weight-bold text-4 mb-1"><?= $blog['post_title']; ?></h3>
                                <p>
                                    <i class="far fa-clock mt-1 text-color-primary"></i>
                                    <time class="font-tertiary text-1" datetime="2020-01-14"> <?php $prdate = new DateTime($blog['post_date']);
                                                                                                echo $prdate->format('d M Y') ?></time>
                                </p>
                                <p style="color: blue;"><b>Selengkapnya -></b></p>
                                <p><?= substr($blog['post_content'], 0, 10); ?></p>
                                <p class="text-color-dark font-weight-semibold mb-0">
                                    <img src="<?= base_url('assets/images/avatars/female.png'); ?>" class="img-thumbnail-small rounded-circle d-inline-block mr-2" width="25" height="25" alt="" />
                                    by <?= $blog['post_author']; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <hr class="mt-5 mb-4">
        <!-- <div class="row align-items-center justify-content-between">
            <div class="col-auto mb-3 mb-sm-0">
                <span>Showing 1-9 of 60 results</span>
            </div>
            <div class="col-auto">
                <nav aria-label="Page navigation example">
                    <ul class="pagination mb-0">
                        <li class="page-item">
                            <a class="page-link prev" href="#" aria-label="Previous">
                                <span><i class="fas fa-angle-left" aria-label="Previous"></i></span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">...</li>
                        <li class="page-item"><a class="page-link" href="#">15</a></li>
                        <li class="page-item">
                            <a class="page-link next" href="#" aria-label="Next">
                                <span><i class="fas fa-angle-right" aria-label="Next"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> -->
    </div>
</section>
<?= $this->endSection(); ?>