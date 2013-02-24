  <ul class="breadcrumb">
    <li><a href="<?php echo base_url("/");?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Categories</li>
  </ul>
  <div class="page-header">
    <h1>Categories</h1>
  </div>
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#manageCategories").tablesorter(); 
    } 
); 
</script>
  <table id="manageCategories" class="tablesorter table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Description</th>
        <th>Plugin</th>
        <th>Item Count</th>
        <th width="10%">Action</th>
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
        <td>
            <form action="<?php echo base_url('index.php/categories/process')?>" method="post">
                <input type="image" src="<?php echo base_url('assets/img/remove.png');?>" alt="remove">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="category_id" value="<?=$cat['id']?>">
            </form> 
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>