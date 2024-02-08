<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?= base_url(); ?> ">Home</a></li>
                    <li class="active">Pages</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="font-weight-bold"><?= $information['information_name']; ?></h1>

            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <aside class="sidebar col-md-4 col-lg-3 order-2 order-md-1">
            <div class="accordion accordion-default accordion-toggle accordion-style-1" data-plugin-sticky data-plugin-options="{'offset_top': 100}" role="tablist">
                <div class="card">
                    <div class="card-header accordion-header" role="tab" id="pages">
                        <h3 class="text-3 mb-0">
                            <a href="#" data-toggle="collapse" data-target="#togglePages" aria-expanded="false" aria-controls="togglePages">INFORMASI UMUM</a>
                        </h3>
                    </div>
                    <div id="togglePages" class="accordion-body collapse show" aria-labelledby="pages">
                        <div class="card-body">
                            <ul class="list list-unstyled">
                                <?php foreach ($InformationBottom as $infoBottom) : ?>
                                    <li lass="mb-3"><a data-hash data-hash-offset="100" class="font-weight-semibold" href="<?= base_url('p/' . $infoBottom['information_slug']); ?> "> <i class="fas fa-angle-right ml-1 mr-1 pr-2"></i> <?= $infoBottom['information_name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </aside>
        <div class="col-md-8 col-lg-9 order-1 order-md-2 mb-5 mb-md-0">
            <?= html_entity_decode($information['information_description']); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>