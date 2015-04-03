<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/items"); ?>">Items</a> <span class="divider">/</span></li>
    <li class="active">Edit Item</li>
</ul>
<div class="page-header">
    <h1>Edit "<?php echo $item_info['display_name']; ?>" Item</h1>
</div>
<form class="form-horizontal" action="<?php echo base_url('index.php/items/process'); ?>" method="post">
    <input type="hidden" name="action" value="edit">
    <div class="control-group">
        <label class="control-label" for="itemID">ID</label>
        <div class="controls">
            <input type="text" id="itemID" class="input-mini" value="<?php echo $item_info['id']; ?>" disabled>
            <input type="hidden" name="id" value="<?php echo $item_info['id']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemPriority">Priority</label>
        <div class="controls">
            <input type="text" id="itemPriority" name="priority" value="<?php echo $item_info['priority']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemName">Name</label>
        <div class="controls">
            <input type="text" id="itemName" name="name" value="<?php echo $item_info['name']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemDisName">Display Name</label>
        <div class="controls">
            <input type="text" id="itemDisName" name="display_name" value="<?php echo $item_info['display_name']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemDesc">Description</label>
        <div class="controls">
            <textarea id="itemDesc" name="description" rows="3"><?php echo $item_info['description']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="catWebDesc">Web Description</label>
        <div class="controls">
            <textarea id="catWebDesc" name ="web_description" rows="3"><?php echo $item_info['web_description']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemType">Type</label>
        <div class="controls">
            <input type="text" id="itemType" name="type" value="<?php echo $item_info['type']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemLoadOut">Loadout Slot</label>
        <div class="controls">
            <input type="text" id="itemLoadOut" name="loadout_slot" value="<?php echo $item_info['loadout_slot']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemPrice">Price</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemPrice" name="price" value="<?php echo $item_info['price']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemCat">Category</label>
        <div class="controls">
            <select id="itemCat" name="category_id">
                <option>-- Select Category --<?php echo $item_info['category_id']; ?></option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php
                    if ($category['id'] == $item_info['category_id'])
                    {
                        echo "selected";
                    }
                    ?>><?php echo $category['display_name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemAttr">Attributes</label>
        <div class="controls">
            <textarea id="itemAttr" name="attrs" rows="10" class="input-xxlarge"><?php echo $item_info['attrs']; ?></textarea>
            <div id="editor"></div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemBuyable">Is Buyable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemBuyable" name="is_buyable" value="<?php echo $item_info['is_buyable']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemTradeable">Is Tradeable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemTradeable" name="is_tradeable" value="<?php echo $item_info['is_tradeable']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemRefundable">Is Refundable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemRefundable" name="is_refundable" value="<?php echo $item_info['is_refundable']; ?>">
        </div>
    </div>	
    <div class="control-group">
        <label class="control-label" for="itemExpiry">Expiry time (in seconds)</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemExpiry" name="expiry_time" value="<?php echo $item_info['expiry_time']; ?>">
        </div>
    </div>	
    <div class="control-group">
        <label class="control-label" for="itemFlags">Flags</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemFlags" name="flags" value="<?php echo $item_info['flags']; ?>">
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
<script src="<?php echo base_url("assets/js/ace/ace.js") ?>"></script> 
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/github");
    editor.getSession().setMode("ace/mode/json");
    var attrs = $('textarea[name="attrs"]').hide();
    editor.getSession().setValue(attrs.val());
    editor.getSession().on("change", function () {
        attrs.val(editor.getSession().getValue());
    });
</script>
<style type="text/css" media="screen">
    #editor { 
        width: 600px;
        height: 200px;
    }
</style>