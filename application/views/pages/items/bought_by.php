<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/items"); ?>">Items</a> <span class="divider">/</span></li>
    <li class="active">Bought By</li>
</ul>
<div class="page-header">
    <h1>Items</h1>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#boughtBy").tablesorter();
    }
    );
</script>
<table id="boughtBy" class="tablesorter table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>User Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($item_users as $item_user): ?>
            <tr>
                <td><?php echo $item_user['id']; ?></a></td>
                <td><a href="<?php echo base_url('index.php/users/edit') . '/' . $item_user['user_id']; ?>"><?php echo $item_user['user_id']; ?></a></td>
                <td><a href="<?php echo base_url('index.php/users/edit') . '/' . $item_user['user_id']; ?>"><?php echo $item_user['user_name']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">

</div>
