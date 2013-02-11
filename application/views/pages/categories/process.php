<p>Posted Data:</p>
<?php if($post['action'] == 'edit'): ?>
<p>ID: <?=$post['id']?></p>
<p>Display Name: <?=$post['display_name']?></p>
<p>Description: <?=$post['description']?></p>
<p>Require Plugin: <?=$post['require_plugin']?></p>
<p>Web Description: <?=$post['web_description']?></p>
<p>Web Color: <?=$post['web_color']?></p>
<form action="<?php echo base_url('index.php/categories');?>" method="post">
    <p><input type="submit" value="back to overview"></p>
</form>
<?php elseif($post['action'] == 'add'): ?>
<p>Display Name: <?=$post['display_name']?></p>
<p>Description: <?=$post['description']?></p>
<p>Require Plugin: <?=$post['require_plugin']?></p>
<p>Web Description: <?=$post['web_description']?></p>
<p>Web Color: <?=$post['web_color']?></p>
<p>
<form action="<?php echo base_url('index.php/categories');?>" method="post">
    <input type="submit" value="back to overview">
</form>
<form action="<?php echo base_url('index.php/categories/add');?>" method="post">
    <input type="submit" value="add another category">
</form>
</p>
<?php endif; ?>