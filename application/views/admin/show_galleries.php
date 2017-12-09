<table class="notices_table" border="1">
    <tr>
        <th>ID</th>
        <th>כותרת</th>
        <th>כתובת URL אישית</th>
        <th>עריכה</th>
        <th>מחיקה</th>
    </tr>
    <?php foreach ($galleries as $gallery): ?>
    <tr>
        <td><?= $gallery['ID'] ?></td>
        <td><?= $gallery['title'] ?></td>
        <td><?= $gallery['machine_name'] ?></td>
        <td><a href="{base_url}admin/galleries/edit/<?= $gallery['ID'] ?>/{page}">עריכה</a></td>
        <td><a href="{base_url}admin/galleries/delete/<?= $gallery['ID'] ?>/{page}">מחיקה</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<form action="{base_url}admin/galleries/add" method="post" class="add_categories_form">
    <fieldset>
        <legend>הוספת גלריה</legend>
        <label for="title">כותרת: </label>
        <input type="text" name="title" value="<?= set_value('title') ?>" id="title" class="title_input form-control">
        <label for="machine_name">כתובת URL אישית: </label>
        <input type="text" name="machine_name" value="<?= set_value('machine_name') ?>" id="machine_name" class="machine_name_input form-control">
        <input type="submit" name="submit" value="הוספה" class="btn btn-success btn-add">
        <div class="alert alert-danger"><?= validation_errors(); ?></div>
    </fieldset>
</form>
<div class="pagination">
{pagination}
</div>