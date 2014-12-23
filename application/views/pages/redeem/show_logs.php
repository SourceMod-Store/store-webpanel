<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Redeem System <span class="divider">/</span></li>
    <li class="active">Show Logs</li>
</ul>
<div class="page-header">
    <h3>Redeem System - Redeem Code Overview</h3>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#redeemLogs').dataTable();
} );
</script>
<table id="redeemLogs" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Redeem Code</th>
            <th>Auth</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($logs as $log):?>
        <tr>
            <td><?php echo $log->id;?></td>
            <td><?php echo $log->code;?></td>
            <td><?php echo $log->auth;?></td>
            <td><?php echo $log->time;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>