<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/items"); ?>">Items</a> <span class="divider">/</span></li>
    <li class="active">Add Item</li>
</ul>
<div class="page-header">
    <h1>Add New Item</h1>
</div>
<form class="form-horizontal" action="<?php echo base_url('index.php/items/process'); ?>" method="post">
    <input type="hidden" name="action" value="add">
    <div class="control-group">
        <label class="control-label" for="itemPriority">Priority</label>
        <div class="controls">
            <input type="text" id="itemPriority" name="priority">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemName">Name</label>
        <div class="controls">
            <input type="text" id="itemName" name="name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemDisName">Display Name</label>
        <div class="controls">
            <input type="text" id="itemDisName" name="display_name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemDesc">Description</label>
        <div class="controls">
            <textarea id="itemDesc" name="description" rows="3"></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="catWebDesc">Web Description</label>
        <div class="controls">
            <textarea id="catWebDesc" name ="web_description" rows="3"></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemType">Type</label>
        <div class="controls">
            <input type="text" id="itemType" name="type" value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemLoadOut">Loadout Slot</label>
        <div class="controls">
            <input type="text" id="itemLoadOut" name="loadout_slot" value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemPrice">Price</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemPrice" name="price" value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemCat">Category</label>
        <div class="controls">
            <select id="itemCat" name="category_id">
                <option>-- Select Category --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['display_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemAttr">Attributes</label>
        <div class="controls">
            <textarea id="itemAttr" rows="10" name="attrs" class="input-xxlarge"></textarea>
            <div id="editor"></div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemBuyable">Is Buyable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemBuyable" name="is_buyable" value="1">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemTradeable">Is Tradeable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemTradeable" name="is_tradeable" value="1">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemRefundable">Is Refundable</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemRefundable" name="is_refundable" value="1">
        </div>
    </div>  
    <div class="control-group">
        <label class="control-label" for="itemExpiry">Expiry time (in seconds)</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemExpiry" name="expiry_time">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="itemFlags">Flags</label>
        <div class="controls">
            <input type="text" class="input-small" id="itemFlags" name="flags">
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
        height: 120px;
    }
</style>