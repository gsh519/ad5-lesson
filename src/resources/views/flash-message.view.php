<?php
/** @var array<string, string> $flash */
global $flash;
?>

<!-- フラッシュメッセージ表示 -->
<?php if (isset($flash['success'])) : ?>
    <p class="text-green mb-2"><?php echo $flash['success']; ?></p>
<?php elseif (isset($flash['error'])) : ?>
    <p class="text-red mb-2"><?php echo $flash['error']; ?></p>
<?php endif; ?>
