<?php if (isset($alert) && is_array($alert) && isset($alert['tipo']) && isset($alert['mensaje'])) : ?>
<div class="alert alert-<?php echo htmlspecialchars($alert['tipo'], ENT_QUOTES, 'UTF-8'); ?>" role="alert">
    <?php echo htmlspecialchars($alert['mensaje'], ENT_QUOTES, 'UTF-8'); ?>
</div>
<?php endif; ?>
