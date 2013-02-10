  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="items.html">Items</a> <span class="divider">/</span></li>
    <li class="active">Edit Item</li>
  </ul>
  <div class="page-header">
    <h1>Edit "Traffic Cone" Item</h1>
  </div>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="itemID">ID</label>
      <div class="controls">
        <input type="text" id="itemID" class="input-mini" value="150" disabled>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemName">Name</label>
      <div class="controls">
        <input type="text" id="itemName" value="trafficcone">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemDisName">Display Name</label>
      <div class="controls">
        <input type="text" id="itemDisName" value="Traffic Cone">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemDesc">Description</label>
      <div class="controls">
        <textarea id="itemDesc" rows="3"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catWebDesc">Web Description</label>
      <div class="controls">
        <textarea id="catWebDesc" rows="3"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemType">Type</label>
      <div class="controls">
        <input type="text" id="itemType" value="equipment">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemLoadOut">Loadout Slot</label>
      <div class="controls">
        <input type="text" id="itemLoadOut" value="hats">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemPrice">Price</label>
      <div class="controls">
        <input type="text" class="input-small" id="itemPrice" value="650">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemCat">Category</label>
      <div class="controls">
        <select id="itemCat">
          <option>-- Select Category --</option>
          <option selected>Hats</option>
          <option>Miscs</option>
          <option>Titles</option>
          <option>Trails</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemAttr">Attributes</label>
      <div class="controls">
        <textarea id="itemAttr" rows="10" class="input-xxlarge">{ "model": "models/props_junk/trafficcone001a.mdl", "position": [0.0, -1.0, 20.0], "angles": [0.0, 0.0, 0.0], "attachment": "forward" }</textarea>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>