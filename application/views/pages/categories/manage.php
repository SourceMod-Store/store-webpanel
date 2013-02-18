  <ul class="breadcrumb">
    <li><a href="<?php echo base_url("/");?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Categories</li>
  </ul>
  <div class="page-header">
    <h1>Categories</h1>
  </div>
  <table id="manageCategories" class="tablesorter table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Description</th>
        <th>Plugin</th>
        <th>Item Count</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($query_categories as $cat): ?>
      <tr>
        <td><?=$cat['id']?></td>
        <td><a href="<?php echo base_url('index.php/categories/edit')."/".$cat['id']?>"><?=$cat['display_name']?></a></td>
        <td><?=$cat['web_description']?></td>
        <td><?=$cat['require_plugin']?></td>
        <td><?=$cat['count']?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>