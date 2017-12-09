<form action="{base_url}admin/pages/add" method="post" class='contact_form'>
    כותרת:<input type='text' name='title' value="<?= set_value('title') ?>"><br><br>
    URL:<input type='text' name='machine_name' value="<?= set_value('machine_name') ?>"><br><br>
    <center>
        תוכן:<br><textarea name='content'><?= set_value('content') ?></textarea><br>
    </center>
    מילות מפתח:<input type='text' name='keywords' value="<?= set_value('keywords') ?>"><br><br>
    תיאור:<input type='text' name='description' value="<?= set_value('description') ?>"><br><br>
    <input type='submit' value='הוספה'>
</form><br>
<div class="{message_class}">{message}</div><br>
<a href="{base_url}admin/pages">חזרה לניהול דפים</a>
<script src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'content' );
CKEDITOR.config.allowedContent = true;
</script>