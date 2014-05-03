<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Users</li>
</ul>
<div class="page-header">
    <h1>Users</h1>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#manageUsers').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "aoColumns": [
                null,
                null,
                null,
                null,
                {"bSortable": false }
            ],
            "sAjaxSource": "<?php echo base_url('/'); ?>index.php/users/server_process"
        });
    });
</script>
<table id="manageUsers" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Auth</th>
            <th>Name</th>
            <th>Credits</th>
            <th>User Items</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="5" class="dataTables_empty">Loading data from server</td>
        </tr>
    </tbody>
</table>
<div class="pagination">
    <!--    <ul>
          <li><a href="#">Prev</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">Next</a></li>
        </ul>-->
</div>