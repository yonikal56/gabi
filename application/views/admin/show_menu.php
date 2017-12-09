<table class="notices_table" border="1">
    <tr>
        <th>ID</th>
        <th>כותרת</th>
        <th>ID משוייך</th>
        <th>סדר</th>
        <th>עריכה</th>
        <th>מחיקה</th>
        <th>למעלה</th>
        <th>למטה</th>
    </tr>
    <?php foreach($menu as $menu_item): ?>
    <tr>
        <td><?= $menu_item['ID'] ?></td>
        <td><?= $menu_item['title'] ?></td>
        <td><?= $menu_item['parent'] ?></td>
        <td><?= $menu_item['order'] ?></td>
        <td><a href="{base_url}admin/menu/edit/<?= $menu_item['ID'] ?>/{page}">עריכה</a></td>
        <td><a href="{base_url}admin/menu/delete/<?= $menu_item['ID'] ?>/{page}">מחיקה</a></td>
        <td><a href="{base_url}admin/menu/up/<?= $menu_item['ID'] ?>/{page}">למעלה</a></td>
        <td><a href="{base_url}admin/menu/down/<?= $menu_item['ID'] ?>/{page}">למטה</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<form action="{base_url}admin/menu/add" method="post" class="add_menu_form">
    <fieldset>
        <legend>הוספת תפריט</legend>
        <label for="title">כותרת: </label>
        <input type="text" name="title" value="<?= set_value('title') ?>" id="title" class="title_input form-control"><br><br>
        <label for="url">URL: </label>
        <input type="text" name="url" value="<?= set_value('url') ?>" id="url" class="url_input form-control"><br><br>
        <label for="internal" class="checkbox-inline">קישור חיצוני: </label>
        <input type="checkbox" name="internal" value="1" id="internal" class="internal_input"<?= set_checkbox('internal', '1') ?>><br><br>
        <label for="parent">תפריט משוייך: </label>
        <select name="parent" class="form-control">
            <option value="0">לא משוייך</option>
            <?php foreach($menu_names as $menu_name): ?>
            <option value="<?= $menu_name['ID'] ?>" <?= set_select('parent', $menu_name['ID']) ?>><?= $menu_name['title'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" name="submit" value="הוספה" class="btn btn-success btn-add">
        <div class="alert alert-danger"><?= validation_errors(); ?></div>
    </fieldset>
</form>
<div class="pagination">
{pagination}
</div>
<div class="clr" style="margin-bottom: 100px;"></div>