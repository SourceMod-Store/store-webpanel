  <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="items.html">Items</a> <span class="divider">/</span></li>
    <li class="active">Add New Item</li>
  </ul>
  <div class="page-header">
    <h1>Add New Item</h1>
  </div>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="itemName">Name</label>
      <div class="controls">
        <input type="text" id="itemName">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemDisName">Display Name</label>
      <div class="controls">
        <input type="text" id="itemDisName">
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
        <input type="text" id="itemType">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemLoadOut">Loadout Slot</label>
      <div class="controls">
        <input type="text" id="itemLoadOut">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemPrice">Price</label>
      <div class="controls">
        <input type="text" id="itemPrice" class="input-small">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemCat">Category</label>
      <div class="controls">
        <select id="itemCat">
          <option selected>-- Select Category --</option>
          <option>Hats</option>
          <option>Miscs</option>
          <option>Titles</option>
          <option>Trails</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="itemAttr">Attributes</label>
      <div class="controls">
        <textarea id="itemAttr" rows="10" class="input-xxlarge"></textarea>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </form>