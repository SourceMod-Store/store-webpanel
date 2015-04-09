  <ul class="breadcrumb">
    <li><a href="<?php echo base_url("/");?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Categories</li>
  </ul>
  <div class="page-header">
    <h1>Categories</h1>
  </div>
<script type="text/javascript">
$(document).ready(function() {
    $('#manageCategories').dataTable();
} );
</script>
  <table id="manageCategories" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Priority</th>
        <th>Category</th>
        <th>Description</th>
        <th>Plugin</th>
        <th>Item Count</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($query_categories as $cat): ?>
      <tr>
        <td><?php echo $cat['id']; ?></td>
        <td><?php echo $cat['priority']; ?></td>
        <td><a href="<?php echo base_url('index.php/categories/edit')."/".$cat['id']?>"><?php echo $cat['display_name']; ?></a></td>
        <td><?php echo $cat['web_description']; ?></td>
        <td><?php echo $cat['require_plugin']; ?></td>
        <td><?php echo $cat['count']; ?></td>
        <td>
            <form action="<?php echo base_url('index.php/categories/process')?>" method="post">
                <button class="btn btn-small btn-danger" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="category_id" value="<?php echo $cat['id']; ?>">
            </form> 
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
