<table border="1">
    <tr>
        <th>כותרת</th>
        <th>URL</th>
        <th>עריכה</th>
        <th>מחיקה</th>
    </tr>
    {pages}
        <tr>
            <td>{title}</td>
            <td>{machine_name}</td>
            <td><a href="{base_url}admin/pages/edit/{ID}">עריכה</a></td>
            <td><a href="{base_url}admin/pages/delete/{ID}">מחיקה</a></td>
        </tr>
    {/pages}
</table>
<a href="{base_url}admin/pages/add">הוספת דף</a>