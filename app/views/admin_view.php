<p>Welcome to the Administration, you are logged in as <?= $username ?></p>
<h1>Users list</h1>
<table>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td>
                <h2><?= $user['name'] ?></h2>
                <?= $user['email'] ?>
                    <br />
                    <a href="admin/edit/<?= $user['user_id']?>"> Edit</a>
                    <a href="admin/remove/<?= $user['user_id'] ?>">Remove</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>


<br>
Страницы:
<?=$num_pages ?>

<?php  while ($page++ < $num_pages): ?>
    <?php if ($page == $cur_page): ?>
        <b><?=$page?></b>
    <?php else: ?>
        <a href="admin?page=<?=$page?>"><?=$page?></a>
    <?php endif; ?>
<?php endwhile; ?>




