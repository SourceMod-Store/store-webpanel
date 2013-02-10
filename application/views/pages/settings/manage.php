  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Settings</li>
  </ul>
  <div class="page-header">
    <h1>Settings</h1>
  </div>
  <form class="form-horizontal">
    <ul class="nav nav-tabs" id="userTabs">
      <li><a href="#database" data-toggle="tab">Database Settings</a></li>
      <li><a href="#other" data-toggle="tab">Other Things</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="database">
        <div class="control-group">
          <label class="control-label" for="storeHost">Host</label>
          <div class="controls">
            <input type="text" id="storeHost" value="localhost">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="storeDB">Database</label>
          <div class="controls">
            <input type="text" id="storeDB" value="store_store">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="storeUser">Database User</label>
          <div class="controls">
            <input type="text" id="storeUser" value="store_user">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="storePass">Database Password</label>
          <div class="controls">
            <input type="password" id="storePass" value="password">
          </div>
        </div>
      </div>
      <div class="tab-pane" id="other">
        <p>Add whatever tabs you need to for the settings page.</p>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>