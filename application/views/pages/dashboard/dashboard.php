<h1>Dashboard</h1>
  <div class="alert alert-info"><strong>Welcome to your Store Control Panel!</strong><br />
    This makes it easy to manage your community's store system.  Report any and all issues by clicking on the "Report a Bug" Button on the right side of this page</div>
  <div class="row">
    <div class="span6">
      <h2>Most popular items</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($top_items as $item):?>
          <tr>
            <td><a href="<?php echo base_url('index.php/items/edit')."/".$item["item_id"]?>"><?=$item['display_name']?></a></td>
            <td><?=$item['anzahl']?></td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
    <div class="span6">
      <h2>Richest Users</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>User</th>
            <th>Credits</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($top_users as $user):?>
          <tr>
              <td><a href="<?php echo base_url('index.php/users/edit')."/".$user["id"]?>"><?=$user['name']?></a></td>
            <td><?=$user['credits']?></td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
