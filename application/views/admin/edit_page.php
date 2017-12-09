{page}
<form action="{base_url}admin/pages/edit/{ID}" method="post" class='contact_form'>
    כותרת:<input type='title' name='title' value="<?= set_value('title', '{title}') ?>"><br><br>
    URL:<input type='machine_name' name='machine_name' value="<?= set_value('machine_name', '{machine_name}') ?>"><br><br>
    <center>
        תוכן:<br><textarea name='content'><?= set_value('content', '{content}') ?></textarea><br><br>
    </center>
    מילות מפתח:<input type="text" name="keywords" value="<?= set_value('keywords', '{keywords}') ?>"><br><br>
    תיאור:<br><textarea name="description"><?= set_value('description', '{description}') ?></textarea><br><br>
    <input type="hidden" name="id" value="{ID}">
    <input type='submit' value='עריכה'>
</form><br>
<div class="{message_class}">{message}</div><br>
<a href="{base_url}admin/pages">חזרה לניהול דפים</a>
<script src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'content' );
CKEDITOR.config.allowedContent = true;
</script>
{/page}