  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="items.html">Items</a> <span class="divider">/</span></li>
    <li class="active">Edit Item</li>
  </ul>
  <div class="page-header">
    <h1>Edit "<?=$item_info['display_name']?>" Item</h1>
  </div>
  <form class="form-horizontal" action="<?php echo base_url('index.php/items/process'); ?>" method="post">
    <input type="hidden" name="action" value="edit">
    <div class="control-group">
      <label class="control-label" for="itemID">ID</label>
      <div class="controls">
        <input type="text" id="itemID" class="input-mini" value="<?=$item_info['id']?>" disabled>
        <input type="hidden" name="id" value="<?=$item_info['id']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemName">Name</label>
      <div class="controls">
        <input type="text" id="itemName" name="name" value="<?=$item_info['name']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemDisName">Display Name</label>
      <div class="controls">
        <input type="text" id="itemDisName" name="display_name" value="<?=$item_info['display_name']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemDesc">Description</label>
      <div class="controls">
        <textarea id="itemDesc" name="description" rows="3"><?=$item_info['description']?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catWebDesc">Web Description</label>
      <div class="controls">
        <textarea id="catWebDesc" name ="web_description" rows="3"><?=$item_info['web_description']?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemType">Type</label>
      <div class="controls">
        <input type="text" id="itemType" name="type" value="<?=$item_info['type']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemLoadOut">Loadout Slot</label>
      <div class="controls">
        <input type="text" id="itemLoadOut" name="loadout_slot" value="<?=$item_info['loadout_slot']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemPrice">Price</label>
      <div class="controls">
        <input type="text" class="input-small" id="itemPrice" name="price" value="<?=$item_info['price']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemCat">Category</label>
      <div class="controls">
        <select id="itemCat">
          <option>-- Select Category --</option>
          <?php foreach($categories as $category):?>
          <option <?php if($category['require_plugin'] == $item_info['type']){echo "selected"; }?>><?=$category['display_name']?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemAttr">Attributes</label>
      <div class="controls">
        <textarea id="itemAttr" rows="10" name="attrs" class="input-xxlarge"><?=$item_info['attrs']?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemPrice">Is Buyable</label>
      <div class="controls">
        <input type="text" class="input-small" id="itemPrice" name="is_buyable" value="<?=$item_info['is_buyable']?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemPrice">Is Tradeable</label>
      <div class="controls">
        <input type="text" class="input-small" id="itemPrice" name="is_tradeable" value="<?=$item_info['is_tradeable']?>">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>