 <ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li><a href="categories.html">Categories</a> <span class="divider">/</span></li>
    <li class="active">Add New Category</li>
  </ul>
  <div class="page-header">
    <h1>Add New Category</h1>
  </div>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="catName">Display Name</label>
      <div class="controls">
        <input type="text" id="catName">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catDesc">Description</label>
      <div class="controls">
        <textarea id="catDesc" rows="3"></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="catPlugin">Required Plugin</label>
      <div class="controls">
        <input type="text" id="catPlugin">
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
        <input type="text" id="catColor" class="input-small">
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </form>