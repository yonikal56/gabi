<?php foreach ($rates as $rate_item): ?>
<article class="clientfeedback">
    <h3 class="bubble"><?= $rate_item['nick'] ?></h3>
    <div>
        <p><?= $rate_item['comment'] ?></p>
    </div>
    <div class="rating" style="background-position: <?= -200 + 40*$rate_item['rate'] ?>px;"></div>
</article>
<?php endforeach; ?>