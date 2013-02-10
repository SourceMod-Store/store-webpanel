  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="users.html">Users</a> <span class="divider">/</span></li>
    <li class="active">Edit User</li>
  </ul>
  <div class="page-header">
    <h1>Edit "User 1"</h1>
  </div>
  <ul class="nav nav-tabs" id="userTabs">
    <li><a href="#info" data-toggle="tab">Info</a></li>
    <li><a href="#items" data-toggle="tab">Items</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane" id="info">
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label" for="userID">ID</label>
          <div class="controls">
            <input type="text" id="userID" disabled class="input-mini" value="731">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userSteamID">Steam ID</label>
          <div class="controls">
            <input type="text" id="userSteamID" class="input-medium" value="STEAM_0:1:8712329">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userName">User</label>
          <div class="controls">
            <input type="text" id="userName" value="User 1">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="userCredits">Credits</label>
          <div class="controls">
            <input type="text" id="userCredits" class="input-medium" value="67037">
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
    <div class="tab-pane" id="items">
      <form>
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
            <tr>
              <td width="5%">440</td>
              <td>Traffic Cone</td>
              <td>Hats</td>
              <td width="15%"><button class="btn btn-mini btn-danger pull-right" type="button"><i class="icon-remove icon-white"></i> Remove</button></td>
            </tr>
            <tr>
              <td width="5%">441</td>
              <td>Lady</td>
              <td>Titles</td>
              <td width="15%"><button class="btn btn-mini btn-danger pull-right" type="button"><i class="icon-remove icon-white"></i> Remove</button></td>
            </tr>
            <tr>
              <td width="5%">442</td>
              <td>Glasses</td>
              <td>Miscs</td>
              <td width="15%"><button class="btn btn-mini btn-danger pull-right" type="button"><i class="icon-remove icon-white"></i> Remove</button></td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>