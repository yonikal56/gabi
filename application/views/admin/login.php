<form action="{base_url}admin/login" method="post" class='contact_form'>
    שם משתמש:<input type='text' name='username' value="<?= set_value('username') ?>"><br><br>
    סיסמא:<input type='text' name='password' value="<?= set_value('password') ?>"><br><br>
    <input type='submit' value='התחברות'>
</form><br>
<div class="{message_class}">{message}</div><br>