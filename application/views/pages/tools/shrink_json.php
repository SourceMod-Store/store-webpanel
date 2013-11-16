<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Json Shrinker</li>
</ul>
<div class="page-header">
    <h3>Json Shrinker</h3>
</div>
<div>
    <form  action="<?php echo base_url('index.php/tools/json_shrink_process'); ?>" method="post">
        <p>Press this button to shrink all attrs in your database</p>
        <div class="controls">	
            <br />
            <button type="submit" class="btn btn-primary">Shrink JSON</button>
        </div>
    </form>
</div>