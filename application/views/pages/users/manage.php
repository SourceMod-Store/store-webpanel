<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Users</li>
</ul>
<div class="page-header">
    <h1>Users</h1>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#manageUsers').dataTable();
} );
</script>
<table id="manageUsers" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Auth</th>
            <th>Credits</th>
            <th>Item Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><a href="<?php echo base_url('index.php/users/edit') . '/' . $user['id'] ?>"><?= $user['name'] ?></a></td>
                <td><?= $user['auth'] ?></td>
                <td><?= $user['credits'] ?></td>
                <td><?= $user['num_items'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="pagination">
    <!--    <ul>
          <li><a href="#">Prev</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">Next</a></li>
        </ul>-->
</div>