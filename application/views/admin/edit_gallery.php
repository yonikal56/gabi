<form action="{base_url}admin/galleries/edit/<?= $gallery['ID'] ?>/{page}" method="post" class="add_categories_form">
    <fieldset>
        <legend>עריכת גלריה</legend>
        <label for="title">כותרת: </label>
        <input type="text" name="title" value="<?= set_value('title', $gallery['title']) ?>" id="title" class="title_input form-control"><br><br>
        <label for="machine_name">כתובת URL אישית: </label>
        <input type="text" name="machine_name" value="<?= set_value('machine_name', $gallery['machine_name']) ?>" id="machine_name" class="machine_name_input form-control"><br><br>
        <label for="images[]">תמונות: </label>
        <?php foreach($gallery['images'] as $image): ?>
        <div class="gallery_image_div">
            <input type="text" name="images_sources[]" id="images" value="<?= $image['source']; ?>" class="images_input form-control">
            <input type="text" name="images_title[]" id="images" value="<?= $image['title']; ?>" class="images_input form-control">
            <input type="text" name="images_content[]" id="images" value="<?= $image['content']; ?>" class="images_input form-control">
            <span>
                <button class="btn btn-danger remove_gallery_image">x</button>
                <button class="btn btn-success add_gallery_image">+</button>
            </span>
            <div class="clearfix"></div>
        </div>
        <?php endforeach; ?><br><br>
        <input type="submit" name="submit" value="עריכה" class="btn btn-danger btn-add">
        <div class="alert alert-danger"><?= validation_errors(); ?></div>
    </fieldset>
</form>