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
    $('#manageRedeem').dataTable();
} );
</script>
<table id="manageRedeem" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Redeem Code</th>
            <th>Item IDs</th>
            <th>Credits</th>
            <th>Redeem Times - User</th>
            <th>Redeem Times - Total</th>
            <th>Expire Time (Unixtime)</th>
        </tr>
    </thead>
    <?php foreach($codes->result() as $row):?>
    <tbody>
        <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->code;?></td>
            <td><?php echo $row->itemids;?></td>
            <td><?php echo $row->credits;?></td>
            <td><?php echo $row->redeem_times_user;?></td>
            <td><?php echo $row->redeem_times_total;?></td>
            <td><?php echo $row->expire_time;?></td>
        </tr>
    </tbody>
    <?php endforeach;?>
</table>