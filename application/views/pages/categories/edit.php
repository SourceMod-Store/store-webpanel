<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/");?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/categories");?>">Categories</a> <span class="divider">/</span></li>
    <li class="active">Edit Category</li>
  </ul>
  <div class="page-header">
    <h1>Edit "Hats" Category</h1>
  </div>
<form class="form-horizontal" action="<?php echo base_url('index.php/categories/process')?>" method="post">
    <input type="hidden" name="action" value="edit">
    <div class="control-group">
      <label class="control-label" for="catID">ID</label>
      <div class="controls">
        <input type="text" disabled class="input-mini" id="catID" name="id" value="<?php echo $category["id"]; ?>">
        <input type="hidden" name="id" value="<?php echo $category["id"]; ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catPriority">Priority</label>
      <div class="controls">
        <input type="text" class="input-mini" id="catPriority" name="priority" value="<?php echo $category["priority"]; ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catName">Display Name</label>
      <div class="controls">
        <input type="text" id="catName" name="display_name" value="<?php echo $category["display_name"]; ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catDesc">Description</label>
      <div class="controls">
        <textarea id="catDesc" rows="3" name="description"><?php echo $category["description"]; ?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catPlugin">Required Plugin</label>
      <div class="controls">
        <input type="text" id="catPlugin" name="require_plugin" value="<?php echo $category["require_plugin"]; ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catWebDesc">Web Description</label>
      <div class="controls">
        <textarea id="catWebDesc" name="web_description" rows="3"><?php echo $category["web_description"]; ?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catColor">Web Color</label>
      <div class="controls">
        <input type="text" class="input-small" id="catColor" name="web_color" value="<?php echo $category["web_color"]; ?>">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>