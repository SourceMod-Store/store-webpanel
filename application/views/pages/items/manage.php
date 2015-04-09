<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Items</li>
</ul>
<div class="page-header">
    <h1>Items</h1>
</div>
<script>
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "num-html-pre": function (a) {
            var x = String(a).replace(/<[\s\S]*?>/g, "");
            return parseFloat(x);
        },
        "num-html-asc": function (a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
        "num-html-desc": function (a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#manageItems').dataTable({
            "aoColumns": [
                null,
                null,
                null,
                null,
                null,
                null,
                {"sType": "num-html"},
                null
            ]
        });
    });
</script>
</br>
<div class="clearfix">
    <table id="manageItems" class="floatleft table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Priority</th>
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
                    <td><?php echo $item['priority'] ?></td>
                    <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $item['id']; ?>"><?php echo $item['display_name'] ?></a></td>
                    <td><?php echo $item['type'] ?></td>
                    <td><?php echo $item['loadout_slot'] ?>
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
</div>
<!--<div class="pagination">
</div>-->
