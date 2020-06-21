<p>Welcome to the Administration, you are logged in as <?= $_SESSION['user']['name']?></p>
<?php //extract($data); ?>
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

<? while($page <= $num_pages) {
if ($page == $cur_page) {
    echo $page;
} else { ?>
    <a href="admin?page=<?=$page?>"><?=$page?></a>
<? }
$page++;
}?>

<?//  while ($page++ <= $num_pages): ?>
<!--    --><?// if ($page == $cur_page): ?>
<!--        <b>--><?//=$page?><!--</b>-->
<!--    --><?// else: ?>
<!--        <a href="admin?page=--><?//=$page?><!--">--><?//=$page?><!--</a>-->
<!--    --><?// endif ?>
<?// endwhile ?>

<?// for($page = 1; $page < $num_pages; $page++)
//{
//    if ($page == $cur_page)
//    { ?>
<!--        <b>--><?//=$page?><!--</b>-->
<!--    --><?//} else { ?>
<!--        <a href="admin?page=--><?//=$page?><!--">--><?//=$page?><!--</a>-->
<!--    --><?//}
//} ?>
