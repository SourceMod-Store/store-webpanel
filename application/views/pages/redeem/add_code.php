<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Redeem System <span class="divider">/</span></li>
    <li class="active">Add Code</li>
</ul>
<div class="page-header">
    <h3>Redeem System</h3>
</div>
<div>
    <h4>Create a redeem code</h4>
    <form action="<?php echo base_url('index.php/redeem/process'); ?>" method="post">
        <p>Create a redeem code with the following form</p>
        <input type="hidden" name="action" value="createcode">
        <div class="control-group">
            <label class="control-label" for="redeemCode">Redeem Code</label>
            <div class="controls">
                <input type="text" id="redeemCode" name="code">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemItems">Item IDs</label>
            <div class="controls">
                <input type="text" id="redeemItems" name="items">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemCredits">Credits</label>
            <div class="controls">
                <input type="text" id="redeemCredits" name="credits">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemTimesUser">Redeem Times - User</label>
            <div class="controls">
                <input type="text" id="redeemTimesUser" name="timesUser">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemTimesTotal">Redeem Times - Total</label>
            <div class="controls">
                <input type="text" id="redeemTimesTotal" name="timesTotal">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemExpire">Expire Date</label>
            <div class="controls">
                <input type="text" id="redeemExpire" name="expire">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>