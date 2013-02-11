<ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="categories.html">Categories</a> <span class="divider">/</span></li>
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
        <input type="text" disabled class="input-mini" id="catID" name="id" value="<?=$category["id"]?>">
        <input type="hidden" name="id" value="<?=$category["id"]?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catName">Display Name</label>
      <div class="controls">
        <input type="text" id="catName" name="display_name" value="<?=$category["display_name"]?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catDesc">Description</label>
      <div class="controls">
        <textarea id="catDesc" rows="3" name="description"><?=$category["description"]?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catPlugin">Required Plugin</label>
      <div class="controls">
        <input type="text" id="catPlugin" name="require_plugin" value="<?=$category["require_plugin"]?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catWebDesc">Web Description</label>
      <div class="controls">
        <textarea id="catWebDesc" name="web_description" rows="3"><?=$category["web_description"]?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catColor">Web Color</label>
      <div class="controls">
        <input type="text" class="input-small" id="catColor" name="web_color" value="<?=$category["web_color"]?>">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>