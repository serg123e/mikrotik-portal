<?php

require 'header.php';
include 'config.php';

$mac = $_SESSION["mac"];
$ip = $_SESSION["ip"];
$link_login = $_SESSION["link-login"];
$link_login_only = $_SESSION["link-login-only"];
$linkorig = "https://www.google.com";

$last_updated = date("Y-m-d H:i:s");

$username="guest";


if ($_SESSION["user_type"] == "new") {  
    $email = $_POST['email'];
    $stmt = mysqli_prepare($con,"INSERT INTO `$table_name` (email, mac, ip, last_updated) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$email, $mac, $ip, $last_updated);
    $stmt->execute();
}

mysqli_close($con);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>
      <?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="assets/styles/bulma.min.css"/>
    <link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/all.css"/>
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-16x16.png" sizes="16x16"/>
    <link rel="stylesheet" href="assets/styles/style.css"/>
</head>
<body>
<div class="page">

    <div class="head">
        <br>
        <figure id="logo">
            <img src="assets/images/acerko_logo_512x172_01_blue.png">
        </figure>
    </div>

    <div class="main">
        <seection class="section">
            <div class="container">
                <div id="margin_zero" class="content has-text-centered is-size-6">Por favor espere,</div>
                <div id="margin_zero" class="content has-text-centered is-size-6">está autorizando en la red</div>
            </div>
        </seection>
    </div>

</div>

<script type="text/javascript">
    function formAutoSubmit () {
        document.getElementById("login").submit();
    }
    window.onload = setTimeout(formAutoSubmit, 500);

</script>

<form id="login" method="POST" action="<?php echo $link_login_only; ?>">
    <input name="dst" type="hidden" value="<?php echo $linkorig; ?>" />
    <input name="username" type="hidden" value="<?php echo $username; ?>"/>
    <input name="password" type="hidden" value=""/>
</form>

</body>
</html>