<p>Posted Data:</p>
<!--</br>
<?php //print_r($post);?>
</br>-->
<?php if ($post['action'] == 'edit'): ?>
    <p>ID: <?= $post['id'] ?></p>
    <p>Auth: <?= $post['auth'] ?></p>
    <p>Name: <?= $post['name'] ?></p>
    <p>Credits: <?= $post['credits'] ?></p>
    <form action="<?php echo base_url('index.php/users'); ?>" method="post">
        <p><input type="submit" value="back to overview"></p>
    </form>
<?php elseif ($post['action'] == 'remove_item'): ?>
    <p>UserItem ID: <?= $post['useritem_id'] ?></p>
    <p>User ID: <?= $post['user_id'] ?></p>
    <p>User Name: <?= $post['user_name'] ?></p>
    <p>Item Name: <?= $post['item_name'] ?></p>
    <p>
    <form action="<?php echo base_url('index.php/users'); ?>" method="post">
        <input type="submit" value="back to overview">
    </form>
    <form action="<?php echo base_url('index.php/users/edit') . '/' . $post['user_id']; ?>" method="post">
        <input type="submit" value="back to User">
    </form>
    </p>
<?php elseif ($post['action'] == 'remove_item'): ?>
    <p>User ID: <?= $post['user_id'] ?></p>
    <p>Item ID: <?= $post['item_id'] ?></p>
    <p>
    <form action="<?php echo base_url('index.php/users'); ?>" method="post">
        <input type="submit" value="back to overview">
    </form>
    <form action="<?php echo base_url('index.php/users/edit') . '/' . $post['user_id']; ?>" method="post">
        <input type="submit" value="back to User">
    </form>
    </p>
<?php endif; ?>