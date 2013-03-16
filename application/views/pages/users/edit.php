<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url("/users"); ?>">Users</a> <span class="divider">/</span></li>
    <li class="active">Edit User</li>
</ul>
<div class="page-header">
    <h1>Edit "<?= $user['name'] ?>"</h1>
</div>
<ul class="nav nav-tabs" id="userTabs">
    <li><a href="#info" data-toggle="tab">Info</a></li>
    <li><a href="#items" data-toggle="tab">Items</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="info">
        <form class="form-horizontal" action="<?php echo base_url('index.php/users/process'); ?>" method="post">
            <input type="hidden" name="action" value="edit">
            <div class="control-group">
                <label class="control-label" for="userID">ID</label>
                <div class="controls">
                    <input type="text" id="userID" disabled class="input-mini" value="<?= $user['id'] ?>">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userName">UserName</label>
                <div class="controls">
                    <input type="text" id="userName" name="name" value="<?= $user['name'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userSteamID">Auth</label>
                <div class="controls">
                    <input type="text" id="userSteamID" class="input-medium" name="auth" value="<?= $user['auth'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="communityProfileUrl">Community URL</label>
                <div class="controls">
                    <a href="http://steamcommunity.com/profiles/<?= $user['community_url'] ?>" target="_blank">Steam Community Profile</a>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userSteamID">SteamID</label>
                <div class="controls">
                    <input type="text" id="userSteamID" disabled class="input-medium" name="steamid" value="<?= $user['steam_id'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="userCredits">Credits</label>
                <div class="controls">
                    <input type="text" id="userCredits" class="input-medium" name="credits" value="<?= $user['credits'] ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        <form action="<?php echo base_url('index.php/users/process'); ?>" method="post">
            <input type="hidden" name="action" value="remove_user">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <button class="btn btn-small btn-danger" type="submit"><i class="icon-remove icon-white"></i> Remove</button>
        </form>
    </div>
    <div class="tab-pane" id="items">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_items as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['display_name'] ?></td>
                        <td><?= $item['category_displayname'] ?></td>
                        <td><form action="<?php echo base_url('index.php/users/process') ?>" method="post">
                                <input type="hidden" name="action" value="remove_item">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="user_name" value="<?= $user['name'] ?>">
                                <input type="hidden" name="useritem_id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="item_name" value="<?= $item['display_name'] ?>"><button class="btn btn-mini btn-danger pull-right" type="submit"><i class="icon-remove icon-white"></i> Remove</button></form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
