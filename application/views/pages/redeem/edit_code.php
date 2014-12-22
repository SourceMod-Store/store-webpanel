<ul class="breadcrumb">
    <li><a href="<?php echo base_url("/"); ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Redeem System <span class="divider">/</span></li>
    <li class="active">Edit a Code</li>
</ul>
<div class="page-header">
    <h3>Redeem System</h3>
</div>
<div>
    <h4>Edit a existing code</h4>
    <form action="<?php echo base_url('index.php/redeem/process'); ?>" method="post">
        <input type="hidden" name="action" value="editcode">
        <input type="hidden" name="id" value="<?php echo $code->id;?>">
        <div class="control-group">
            <label class="control-label" for="redeemCode">Redeem Code</label>
            <div class="controls">
                <input type="text" id="redeemCode" name="code" value="<?php echo $code->code;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemItems">Item IDs</label>
            <div class="controls">
                <input type="text" id="redeemItems" name="items" value="<?php echo $code->itemids;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemCredits">Credits</label>
            <div class="controls">
                <input type="text" id="redeemCredits" name="credits" value="<?php echo $code->credits;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemTimesUser">Redeem Times - User</label>
            <div class="controls">
                <input type="text" id="redeemTimesUser" name="timesUser" value="<?php echo $code->redeem_times_user;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemTimesTotal">Redeem Times - Total</label>
            <div class="controls">
                <input type="text" id="redeemTimesTotal" name="timesTotal" value="<?php echo $code->redeem_times_total;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="redeemExpire">Expire Date</label>
            <div class="controls">
                <input type="text" id="redeemExpire" name="expire" value="<?php echo $code->expire_time;?>">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>