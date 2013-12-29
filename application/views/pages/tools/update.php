<ul class="breadcrumb">
    <li><a href="dashboard.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Update Checker</li>
</ul>
<div class="page-header">
    <h1>Update Checker</h1>
</div>
<h3>Store Control Panel</h3>
<p>Your Version: <?php echo $webpanel_version_installed; ?></p>
<p>Current Stable Version: <strong><?php echo $webpanel_version_stable; ?></strong></p>
<p>Current Beta Version <?php echo $webpanel_version_beta; ?></p>
<p>Current Nightly Version <?php echo $webpanel_version_nightly; ?></p>
<p>Update Code: <?php echo $webpanel_version_data["return_code"]; ?></p>
<?php switch($webpanel_version_data["return_code"]):
    case "0": ?>
        <div class="alert alert-success"><strong>Congrats !</strong> You are running the latest version of the Webpanel!</div>
        <?php break;
    case "110": ?>
        <div class="alert alert-error"><strong>Oh No!</strong> The version of your webpanel doesnt match the latest stable version ! - <a href="http://stash.sourcedonates.com/plugins/servlet/archive/projects/STORE/repos/webpanel?at=<?php echo $webpanel_version_data["update_commit"]; ?>">Download</a> the latest version</div>
        <?php break;
    case "210": ?>
        <div class="alert alert-success"><strong>Congrats !</strong> You are running the latest <b>beta</b> version of the Webpanel!</div>
        <div class="alert alert-error">But there is a <strong>newer stable</strong> version available - <a href="http://stash.sourcedonates.com/plugins/servlet/archive/projects/STORE/repos/webpanel?at=<?php echo $webpanel_version_data["update_commit"]; ?>">Download</a> the latest version</div>
        <?php break;
    case "220": ?>
        <div class="alert alert-error"><strong>Oh No!</strong> The version of your webpanel doesnt match the latest beta version ! - <a href="http://stash.sourcedonates.com/plugins/servlet/archive/projects/STORE/repos/webpanel?at=<?php echo $webpanel_version_data["update_commit"]; ?>">Download</a> the latest version</a></div>
        <?php break;
    case "420": ?>
        <div class="alert alert-success"><strong>Congrats !</strong> You are running the latest <b>nightly</b> version of the Webpanel!</div>
        <div class="alert alert-error">But there is a <strong>newer beta</strong> version available - <a href="http://stash.sourcedonates.com/plugins/servlet/archive/projects/STORE/repos/webpanel?at=<?php echo $webpanel_version_data["update_commit"]; ?>">Download</a> the latest version</div>
        <?php break;
    case "440": ?>
        <div class="alert alert-error"><strong>Oh No!</strong> The version of your webpanel doesnt match the latest nightly version ! - <a href="http://stash.sourcedonates.com/plugins/servlet/archive/projects/STORE/repos/webpanel?at=<?php echo $webpanel_version_data["update_commit"]; ?>">Download</a> the latest version</div>
        <?php break;
    case "980": ?>
        <div class="alert alert-error"><strong>Oh No!</strong> There has been an error while finding our the installed version. Please create a support ticket and mention the Error Code 980</div>
        <?php break;
    case "900": ?>
        <div class="alert alert-error"><strong>Oh No!</strong> There has been an internal error. Please create a support ticket and mention the Error Code 900</div>
        <?php break;
    default: ?>
        <div class="alert alert-error"><strong>Oh No!</strong> There has been an internal error. Please create a support ticket and post a screenshot of this page</div>
<?php endswitch ?>
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