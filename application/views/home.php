<!-- Center Image -->
<section class="centerblock" id="clientfeedbacks">
    <div>
        <hgroup>
            <h2>חוות דעת של לקוחות</h2>
            <h3>היית לקוח? <a href="#" class="add_rate">הוסף חוות דעת</a></h3>
        </hgroup>
    </div>
</section>
<main>
<section class="feedba">
    <?php foreach ($rates as $rate_item): ?>
    <article class="clientfeedback">
        <h3 class="bubble"><?= $rate_item['nick'] ?></h3>
        <div>
            <p><?= $rate_item['comment'] ?></p>
        </div>
        <div class="rating" style="background-position: <?= -200 + 40*$rate_item['rate'] ?>px;"></div>
    </article>
    <?php endforeach; ?>
</section>
<div class="clr"></div>
</main>