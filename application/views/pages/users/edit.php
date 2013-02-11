  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="users.html">Users</a> <span class="divider">/</span></li>
    <li class="active">Edit User</li>
  </ul>
  <div class="page-header">
    <h1>Edit "<?=$user['name']?>"</h1>
  </div>
  <ul class="nav nav-tabs" id="userTabs">
    <li><a href="#info" data-toggle="tab">Info</a></li>
    <li><a href="#items" data-toggle="tab">Items</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane" id="info">
      <form class="form-horizontal" action="<?php echo base_url('index.php/users/process');?>" method="post">
        <input type="hidden" name="action" value="edit">
        <div class="control-group">
          <label class="control-label" for="userID">ID</label>
          <div class="controls">
            <input type="text" id="userID" disabled class="input-mini" value="<?=$user['id']?>">
            <input type="hidden" name="id" value="<?=$user['id']?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userSteamID">Auth</label>
          <div class="controls">
            <input type="text" id="userSteamID" class="input-medium" name="auth" value="<?=$user['auth']?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userName">User</label>
          <div class="controls">
            <input type="text" id="userName" name="name" value="<?=$user['name']?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userCredits">Credits</label>
          <div class="controls">
            <input type="text" id="userCredits" class="input-medium" name="credits" value="<?=$user['credits']?>">
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
    <div class="tab-pane" id="items">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th width="5%">ID</th>
              <th>Item Name</th>
              <th>Category</th>
              <th width="15%"></th>
            </tr>
          </thead>
          <tbody>
           <?php foreach($user_items as $item):?>
            <form action="<?php echo base_url('index.php/users/process')?>" method="post">
              <input type="hidden" name="action" value="remove_item">
              <input type="hidden" name="item_id" value="<?=$item['id']?>">
              <tr>
                <td width="5%"><?=$item['id']?></td>
                <td><?=$item['display_name']?></td>
                <td><?=$item['category_displayname']?></td>
                <td width="15%"><input type="submit" class="btn btn-mini btn-danger pull-right" value="Remove"></td>
              </tr>
            </form>
           <?php endforeach;?>
<!--            <tr>
              <td width="5%">442</td>
              <td>Glasses</td>
              <td>Miscs</td>
              <td width="15%"><button class="btn btn-mini btn-danger pull-right" type="button"><i class="icon-remove icon-white"></i> Remove</button></td>
            </tr>-->
          </tbody>
        </table>
    </div>
  </div>