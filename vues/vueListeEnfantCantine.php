<h1>Tous les services</h1>
<div class="">
    <?php foreach ($services as $service) : ?>
        <div>
            <h3><?php echo htmlspecialchars($service['serviceName']); ?></h3>
            <p>Communes : <?php echo implode(', ', $service['communes']); ?></p>
        </div>
    <?php endforeach; ?>
</div>