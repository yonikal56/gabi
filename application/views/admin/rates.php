<table border="1">
    <tr>
        <th>כינוי</th>
        <th>תגובה</th>
        <th>זמן</th>
        <th>דירוג</th>
        <th>מחיקה</th>
    </tr>
    <?php foreach($rates as $rate): ?>
        <tr>
            <td><?= $rate['nickname'] ?></td>
            <td><?= $rate['comment'] ?></td>
            <td><?= date('d/m/Y G:i', $rate['nickname']) ?></td>
            <td><?= $rate['rate'] ?></td>
            <td><a href="{base_url}admin/rates/delete/{ID}">מחיקה</a></td>
        </tr>
    <?php endforeach; ?>
</table>