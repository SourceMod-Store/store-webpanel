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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($codes as $code):?>
        <tr>
            <td><a href="<?php echo base_url('index.php/redeem/edit_code') . '/' . $code->id; ?>"><?php echo $code->id;?></a></td>
            <td><a href="<?php echo base_url('index.php/redeem/edit_code') . '/' . $code->id; ?>"><?php echo $code->code;?></a></td>
            <td><?php echo $code->itemids;?></td>
            <td><?php echo $code->credits;?></td>
            <td><?php echo $code->redeem_times_user;?></td>
            <td><?php echo $code->redeem_times_total;?></td>
            <td><?php echo $code->expire_time;?></td>
            <td>
                <form class="float-left removeform" action="<?php echo base_url('index.php/redeem/process') ?>" method="post">
                <input type="hidden" name="code_id" value="<?php echo $code->id ?>">
                <button class="btn btn-small btn-danger" name="action" value="removecode" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
                </form> 
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>