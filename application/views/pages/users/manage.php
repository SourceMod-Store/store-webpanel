<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Users</li>
</ul>
<div class="page-header">
    <h1>Users</h1>
</div>
<div class="row">
    <div class="span6">
        <div class="pagination scp-pagination">
            <!--        <ul>
                      <li><a href="#">Prev</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">Next</a></li>
                    </ul>-->
        </div>
    </div>
    <div class="span6">
        <form class="form-search pull-right" action ="<?php echo base_url("index.php/users"); ?>" method="get">
            <div class="input-append">
                <input type="text" class="span2 search-query" name="s" value="<?= $search ?>">
                <button type="submit" class="btn">Search</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#manageUsers").tablesorter(); 
    } 
); 
</script>
<table id="manageUsers" class="tablesorter table table-bordered table-striped table-hover">
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