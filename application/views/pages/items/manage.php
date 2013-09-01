<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Items</li>
</ul>
<div class="page-header">
    <h1>Items</h1>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#manageItems').dataTable();
} );
</script>
<table id="manageItems" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Loadout Slot</th>
            <th>Price</th>
            <th>Times Bought</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $item['id']; ?>"><?php echo $item['id'] ?></a></td>
                <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $item['id']; ?>"><?php echo $item['display_name'] ?></a></td>
                <td><?php echo $item['type'] ?></td>
                <td><?php echo $item['loadout_slot']?>
                <td><?php echo $item['price'] ?></td>
                <td><a href="<?php echo base_url('index.php/items/bought_by') . '/' . $item['id']; ?>"><?php echo $item['amount'] ?></td>
                <td>
                    <form class="float-left removeform" action="<?php echo base_url('index.php/items/process') ?>" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $item['id'] ?>">
                        <button class="btn btn-small btn-danger" name="action" value="remove" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
                        <button class="btn btn-small btn-danger" name="action" value="remove_refund" type="submit"><i class="icon-remove icon-white"></i> Remove + Refund</button>
                        
                    </form> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!--<div class="pagination">
</div>-->
