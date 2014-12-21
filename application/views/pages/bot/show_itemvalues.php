<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Items</li>
</ul>
<div class="page-header">
    <h1>Items</h1>
</div>
<script>
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "num-html-pre": function(a) {
            var x = String(a).replace(/<[\s\S]*?>/g, "");
            return parseFloat(x);
        },
        "num-html-asc": function(a, b) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
        "num-html-desc": function(a, b) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#showItemvalues').dataTable();
    });
</script>
</br>
<div class="clearfix">
    <table id="showItemvalues" class="floatleft table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($itemvalues as $itemvalue): ?>
                <tr>
                    <td><a href="<?php echo base_url('index.php/items/edit') . '/' . $itemvalue['itemId']; ?>"><?php echo $itemvalue['itemId'] ?></a></td>
                    <td><?php echo $itemvalue['value'] ?></td>
                    <td>
                        <form class="float-left removeform" action="<?php echo base_url('index.php/bot/process_itemvalue') ?>" method="post">
                            <input type="hidden" name="itemvalue_id" value="<?php echo $itemvalue['itemId'] ?>">
                            <button class="btn btn-small btn-danger" name="action" value="remove" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
                        </form> 
                    </td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!--<div class="pagination">
</div>-->
