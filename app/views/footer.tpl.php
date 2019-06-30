<div class="content">
    <?php foreach ($view as $item): ?>
        <a>
            <?php print $item['name']; ?>
            <?php print $item['number']; ?>
        </a>
    <?php endforeach; ?> 
</div>
