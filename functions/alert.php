<?php 

function getAlert($message, $type = "error", $link = false) {
?>

<div class="alert <?php echo $type ?>">
    <?php echo $message ?>
    <?php if ($link): ?>
        <a href="index.php">Retour à l'accueil</a>
    <?php endif; ?>
</div>

<?php 
}
