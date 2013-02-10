  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Edit Account</li>
  </ul>
  <div class="page-header">
    <h1>Edit Account</h1>
  </div>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="inputEmail">Email Address</label>
      <div class="controls">
        <input type="email" id="accountEmail" value="email@domain.com" required>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="inputPassword">Password</label>
      <div class="controls">
        <input type="password" id="accountPassword">
        <input type="password" id="accountPasswordVerify" placeholder="Verify Password">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>