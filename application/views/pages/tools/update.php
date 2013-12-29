<ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Update Checker</li>
</ul>
<div class="page-header">
    <h1>Update Checker</h1>
</div>
<h3>Store Control Panel</h3>
<!--
<?php if ($webpanel_version_match == "dev-version"): ?>
<div class="alert alert-error"><strong>Be Aware!</strong> You're currently using a development version of the webpanel. The Update checker does not work for dev versions.</div>
<?php elseif ($webpanel_version_match == "outofdate"): ?>
<div class="alert alert-error"><strong>Oh No!</strong> The version of your webpanel doesnt match official version !</div>
<?php elseif ($webpanel_version_match == "up2date"): ?>
<div class="alert alert-success"><strong>Congrats !</strong> You are running the latest version of the Webpanel!</div>
<?php endif; ?>
-->
<p>Your Version: <?php echo $webpanel_version_installed; ?></p>
<p>Current Stable Version: <strong><?php echo $webpanel_version_stable; ?></strong></p>
<p>Current Beta Version <?php echo $webpanel_version_beta; ?></p>
<p>Current Nightly Version <?php echo $webpanel_version_nightly; ?></p>
<p>Update Code: <?php echo $webpanel_version_data['return_code']?></p>
<!--
<h3>Store Plugin</h3>
<div class="alert alert-error"><strong>Oh No!</strong> One or more of your servers is running an old version!</div>
<p>The latest version of the Store Plugin is <strong>1.0.7-alpha</strong></p>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Status</th>
            <th>Server IP</th>
            <th>Store Plugin Version</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="muted">Offline</td>
            <td>216.246.109.90:27015</td>
            <td>Unknown</td>
        </tr>
        <tr>
            <td class="text-success">Online</td>
            <td>216.246.109.92:27015</td>
            <td><span class="label label-warning">Warning</span> <strong>1.0.5-alpha</strong></td>
        </tr>
        <tr>
            <td class="text-success">Online</td>
            <td>216.246.109.93:27015</td>
            <td>1.0.7-alpha</td>
        </tr>
    </tbody>
</table> -->