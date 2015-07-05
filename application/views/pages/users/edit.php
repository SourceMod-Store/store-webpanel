<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/users"); ?>">Users</a> <span class="divider">/</span></li>
    <li class="active">Edit User</li>
</ul>
<div class="page-header">
    <h1>Edit "<?php echo $user['name']; ?>"</h1>
</div>
<ul class="nav nav-tabs" id="userTabs">
    <li><a href="#info" data-toggle="tab">Info</a></li>
    <li><a href="#items" data-toggle="tab">Items</a></li>
    <li><a href="#add" data-toggle="tab">Add</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="info">
        <form class="form-horizontal" action="<?php echo base_url('index.php/users/process'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <div class="control-group">
                <label class="control-label" for="userID">ID</label>
                <div class="controls">
                    <input type="text" id="userID" disabled class="input-mini" value="<?php echo $user['id']; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userName">UserName</label>
                <div class="controls">
                    <input type="text" id="userName" name="name" value="<?php echo $user['name']; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userSteamID">Auth</label>
                <div class="controls">
                    <input type="text" id="userSteamID" class="input-medium" name="auth" value="<?php echo $user['auth']; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="communityProfileUrl">Community URL</label>
                <div class="controls">
                    <a href="http://steamcommunity.com/profiles/<?php echo $user['community_url']; ?>" target="_blank">Steam Community Profile</a>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userSteamID">SteamID</label>
                <div class="controls">
                    <?php echo $user['steam_id']; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userCredits">Credits</label>
                <div class="controls">
                    <input type="text" id="userCredits" class="input-medium" name="credits" value="<?php echo $user['credits']; ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" name="action" value="edit" class="btn btn-primary">Save Changes</button>
                <button type="submit" name="action" value="remove_user" class="btn btn-primary btn-danger"><i class="icon-remove icon-white"></i> Remove</button>
            </div>
        </form>
    </div>
    <div class="tab-pane" id="items">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th width="250"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_items as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['display_name']; ?></td>
                        <td><?php echo $item['category_displayname']; ?></td>
                        <td>
                            <form action="<?php echo base_url('index.php/users/process') ?>" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <input type="hidden" name="user_name" value="<?php echo $user['name']; ?>">
                                <input type="hidden" name="useritem_id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="item_name" value="<?php echo $item['display_name']; ?>">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                <input type="hidden" name="item_price" value="<?php echo $item['price']; ?>">
                                <button name="action" value="remove_item" class="btn btn-mini btn-danger pull-right" type="submit"><i class="icon-remove icon-white"></i> Remove</button>  
                                <button name="action" value="remove_refund_item" class="btn btn-mini btn-danger pull-right" type="submit"> <i class="icon-remove icon-white"></i> Remove+Refund</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="add">
       <form action="<?php echo base_url('index.php/users/process') ?>" method="post">
         <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
         <select name="item_id">
          <?php foreach ($items as $item): ?>
          <option value="<?php echo $item['id']; ?>"><?php echo $item['display_name']; ?></option>
          <?php endforeach; ?>
         </select>
         <button name="action" value="add_item" class="btn btn-primary" type="submit">Add</button>  
       </form>
    </div>
</div>
