<p>Posted Data:</p>
<!--</br>
<?php // print_r($post);?>
</br>-->
<?php if($post['action'] == 'edit'): ?>
<p>ID: <?=$post['id']?></p>
<p>Name: <?=$post['name']?></p>
<p>Display Name: <?=$post['display_name']?></p>
<p>Description: <?=$post['description']?></p>
<p>Web Description: <?=$post['web_description']?></p>
<p>Type: <?=$post['type']?></p>
<p>Loadout Slot: <?=$post['loadout_slot']?></p>
<p>Price: <?=$post['price']?></p>
<p>Attrs: <?=$post['attrs']?></p>
<p>Is Buyable: <?=$post['is_buyable']?></p>
<p>Is Tradeable: <?=$post['is_tradeable']?></p>
<p>Expiry: <?=$post['expiry_time']?></p>
<p>Flags: <?=$post['flags']?></p>
<form action="<?php echo base_url('index.php/items');?>" method="post">
    <p><input type="submit" value="back to overview"></p>
</form>
<?php elseif($post['action'] == 'add'): ?>
<p>Name: <?=$post['name']?></p>
<p>Display Name: <?=$post['display_name']?></p>
<p>Description: <?=$post['description']?></p>
<p>Web Description: <?=$post['web_description']?></p>
<p>Type: <?=$post['type']?></p>
<p>Loadout Slot: <?=$post['loadout_slot']?></p>
<p>Price: <?=$post['price']?></p>
<p>Attrs: <?=$post['attrs']?></p>
<p>Is Buyable: <?=$post['is_buyable']?></p>
<p>Is Tradeable: <?=$post['is_tradeable']?></p>
<p>Expiry: <?=$post['expiry_time']?></p>
<p>Flags: <?=$post['flags']?></p>
<p>
<form action="<?php echo base_url('index.php/items');?>" method="post">
    <input type="submit" value="back to overview">
</form>
<form action="<?php echo base_url('index.php/items/add');?>" method="post">
    <input type="submit" value="add another item">
</form>
</p>
<?php endif; ?>