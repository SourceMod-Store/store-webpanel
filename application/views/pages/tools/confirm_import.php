<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Confirm Import</li>
</ul>
<div class="page-header">
    <h3>Confirm Import</h3>
</div>
<?php if (isset($errors)): ?>
    <div>
        <h4>File Error:</h4>
        <p><i><?php echo $errors; ?></i></p>

        <form action="<?php echo base_url('index.php/tools/impex'); ?>" enctype="multipart/form-data" method="get">
            <p>Click on the Return Button to return to the Import / Export page</p>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-danger">Return</button>
                </div>
            </div>
        </form>
    </div>
<?php else: ?>
    <p><strong>Please confirm that you want to import the json file.</strong> As always you should perform a full MySQL database backup regularly to ensure data safety.</p>
    <div>
        <h4>Summary</h4>
        <p>All Items of the following type are going to be deleted: <?php echo $json_type; ?></p>
        <p><?php if($effected_item_count > 0 ) echo "<strong>"; ?>The category contains <?php echo $effected_item_count; ?> item(s)<?php if($effected_item_count > 0 ) echo "</strong>"; ?></p>
        <p>The following categories will be created: <?php echo $json_categories; ?></p>
        <form action="<?php echo base_url('index.php/tools/import'); ?>" enctype="multipart/form-data" method="post">
            <div class="control-group">
                <div class="controls">
                    <input type="hidden" name="json" value="<?php echo urlencode($json_string); ?>">
                    <button type="submit" class="btn btn-danger">Continue with the Import</button>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

