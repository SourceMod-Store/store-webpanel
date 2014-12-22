<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Redeem System <span class="divider">/</span></li>
    <li class="active">Manage</li>
</ul>
<div class="page-header">
    <h3>Redeem System - Redeem Code Overview</h3>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#redeemManage').dataTable();
} );
</script>
<table id="redeemManage" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Redeem Code</th>
            <th>Item IDs</th>
            <th>Credits</th>
            <th>Redeem Times - User</th>
            <th>Redeem Times - Total</th>
            <th>Expire Time </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($codes as $code):?>
        <tr>
            <td><?php echo $code->id;?></td>
            <td><?php echo $code->code;?></td>
            <td><?php echo $code->itemids;?></td>
            <td><?php echo $code->credits;?></td>
            <td><?php echo $code->redeem_times_user;?></td>
            <td><?php echo $code->redeem_times_total;?></td>
            <td><?php echo $code->expire_time;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>