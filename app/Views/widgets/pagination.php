<button class="btn btn-outline-primary font-weight-bold btn-h-2 btn-v-3 text-" <?= ($page == 1) ? '' : 'hidden' ?> id="Anything" value="<?= $page; ?>">Lihat Lainnya</button>
<?php
if ($keyword != null) : $kywrd = '?q=' . $keyword  . '&p=';
else : $kywrd = '?&p=';
endif ?>
<ul class="pagination" hidden>
    <li class="page-item " <?= ($page == 1) ? 'hidden' : ''; ?>>
        <a class="page-link" href="<?= base_url($source) .  $kywrd . 1; ?>" aria-label="Previous">
            First
        </a>
    </li>
    <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
        <a class="page-link" href="<?= base_url($source) .  $kywrd . ($page - 1); ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
    </li>
    <?php for ($i = $startNumber; $i <= $endNumber; $i++) : ?>
        <?php if ($page == $i) : ?>
            <li class="page-item active">
                <span class="page-link">
                    <?= $i; ?>
                    <span class="sr-only">(current)</span>
                </span>
            </li>
        <?php else : ?>
            <li class="page-item"><a class="page-link" href="<?= base_url($source) .  $kywrd . $i; ?>"><?= $i; ?></a></li>
        <?php endif ?>
    <?php endfor; ?>
    <?php
    $countPage = $totalPage - 2;
    if ($page <  $countPage) : ?>
        <li class="page-item ">
            <span class="page-link">
                ...
            </span>
        </li>
        <li class="page- item"><a class="page-link" href="<?= base_url($source) .  $kywrd . $totalPage; ?>"><?= $totalPage; ?></a></li>
    <?php endif ?>
    <li class="page-item <?= ($totalPage == $page) ? 'disabled' : ''; ?>">
        <a class="page-link" href="<?= base_url($source) .  $kywrd . ($page + 1); ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
        </a>
    </li>
    <li class="page-item " <?= ($page == $totalPage) ? 'hidden' : ''; ?>>
        <a class="page-link" href="<?= base_url($source) .  $kywrd . $totalPage; ?>" aria-label="Previous">
            Lastest
        </a>
    </li>
</ul>

<?= $this->section('javascript'); ?>
<script>
    const page = $('#Anything').val();
    if (page == 1) {
        $('#Anything').click(function() {
            window.location.replace("<?= base_url($source) .  $kywrd . 2; ?>");
        });
    } else {
        $('#Anything').attr('hidden', true);
        $('.pagination').removeAttr('hidden');
    }
</script>
<?= $this->endSection(); ?>