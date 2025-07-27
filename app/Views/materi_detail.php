<h4>Komentar</h4>

<form method="post" action="/komentar/kirimKomentar">
    <input type="hidden" name="materi_id" value="<?= esc($materi['id']) ?>">
    <textarea name="isi" class="form-control mb-2" placeholder="Tulis komentar..." required></textarea>
    <button class="btn btn-primary btn-sm">Kirim</button>
</form>

<hr>

<?php
function tampilkanKomentar($komentar, $parent_id = null, $level = 0)
{
    foreach ($komentar as $k) {
        if ($k['parent_id'] == $parent_id) {
            echo '<div style="margin-left:' . (25 * $level) . 'px" class="border-start ps-3 mb-3">';
            echo '<strong>' . esc($k['username']) . '</strong> <small class="text-muted">' . esc($k['created_at']) . '</small><br>';
            echo '<p>' . esc($k['isi']) . '</p>';

            // Form reply
            echo '<form method="post" action="/komentar/kirimKomentar" class="mb-2">';
            echo '<input type="hidden" name="materi_id" value="' . esc($k['materi_id']) . '">';
            echo '<input type="hidden" name="parent_id" value="' . esc($k['id']) . '">';
            echo '<textarea name="isi" class="form-control form-control-sm mb-1" placeholder="Balas komentar..." required></textarea>';
            echo '<button class="btn btn-outline-secondary btn-sm">Balas</button>';
            echo '</form>';

            echo '</div>';

            tampilkanKomentar($komentar, $k['id'], $level + 1);
        }
    }
}
?>

<?php if (!empty($komentar)): ?>
    <?php tampilkanKomentar($komentar); ?>
<?php else: ?>
    <p class="text-muted">Belum ada komentar.</p>
<?php endif; ?>
