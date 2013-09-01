<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Import/Export System</li>
</ul>
<div class="page-header">
    <h3>Import/Export System</h3>
</div>
<div>
    <form  action="<?php echo base_url('index.php/tools/check_process'); ?>" method="post">
        <p>Press this button to validate all the json attrs in your db.</p>
        <div class="controls">	
            <p><input type="checkbox" name="show_correct" value="true" >Show Correct attrs</p>
            <br />
            <button type="submit" class="btn btn-primary">Check JSON</button>
        </div>
    </form>
</div>