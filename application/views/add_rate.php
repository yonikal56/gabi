<main id="clientfeedbacks">
    <form method="post" action="" class="addrate-form">
        <fieldset>
            <legend>הוסף חות דעת</legend>
            <hr>
            <label for="fullname">שם פרטי מלא</label>
            <input type="text" name="fullname" id="fullname">
            <!-- RATING START -->
            <label for="rating">דרג את העבודה</label>
            <span class="ratenum">1</span>
            <input type="range" name="rating" id="rating" min="2" max="10" step="1" value="10">
            <span class="ratenum">5</span>
            <div class="myscore">הציון שלי הוא <span>5</span></div>
            <!-- RATING END -->
            <label for="ratebody">חוות הדעת</label>
            <textarea name="ratebody" id="ratebody"></textarea>
            <div id="submit-button"><input type="submit" name="submit" value="הוסף חוות דעת"></div>
            <div class="errors">
                
            </div>
            <div id="submit-button"><button class="return_to_rates">חזרה לחוות הדעת</button></div>
        </fieldset>
    </form>
</main>