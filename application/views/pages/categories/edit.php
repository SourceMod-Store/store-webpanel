<ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="categories.html">Categories</a> <span class="divider">/</span></li>
    <li class="active">Edit Category</li>
  </ul>
  <div class="page-header">
    <h1>Edit "Hats" Category</h1>
  </div>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="catID">ID</label>
      <div class="controls">
        <input type="text" disabled class="input-mini" id="catID" value="10">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catName">Display Name</label>
      <div class="controls">
        <input type="text" id="catName" value="Hats">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catDesc">Description</label>
      <div class="controls">
        <textarea id="catDesc" rows="3">Cosmetic hats that appear on your head.</textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catPlugin">Required Plugin</label>
      <div class="controls">
        <input type="text" id="catPlugin" value="equipment">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catWebDesc">Web Description</label>
      <div class="controls">
        <textarea id="catWebDesc" rows="3"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catColor">Web Color</label>
      <div class="controls">
        <input type="text" class="input-small" id="catColor" value="476291">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>