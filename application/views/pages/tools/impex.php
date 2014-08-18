  <ul class="breadcrumb">
    <li><a href="<?php echo base_url("/");?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Import/Export System</li>
  </ul>
  <div class="page-header">
    <h3>Import/Export System</h3>
  </div>
  <p><strong>This is not a backup system.</strong> As always you should perform a full MySQL database backup regularly to ensure data safety.</p>
  <div>
    <h4>Import Store Items</h4>
    <form action="<?php echo base_url('index.php/tools/confirm_import'); ?>" enctype="multipart/form-data" method="post">
		<p>Each JSON file you upload contains items of one type. <strong>All of the items that you currently have under that type name will be deleted.</strong></p>
      <div class="control-group">
        <div class="controls">
          <input id="importFile" type="file" name="importFile">
          <br />
          <button type="submit" class="btn btn-danger">Import</button>
        </div>
      </div>
    </form>
  </div>
  <div>
    <h4>Export Store Items</h4>
	<form  action="<?php echo base_url('index.php/tools/export'); ?>" method="post">
		<p>This is for plugin developers that want to package items with their plugins.</p>
		<label class="control-label" for="itemType">Item type</label>
		<div class="controls">
		  <input id="itemType" type="text" name="itemType">
		  <br />	
		  <button type="submit" class="btn btn-primary">Export</button>
		</div>
	</form>
  </div>

