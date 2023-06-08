<?php

require 'header.php';
include 'config.php';

if ($_POST['link-login']) {
    $_SESSION["mac"] = $_POST['mac'];
    $_SESSION["mac-esc"] = $_POST['mac-esc'];
    $_SESSION["ip"] = $_POST['ip'];
    $_SESSION["link-login"] = $_POST['link-login'];
    $_SESSION["link-login-only"] = $_POST['link-login-only'];

    $_SESSION["user_type"] = "new";
    $error = $_POST['error'];
} else {
    http_response_code(403);
    die('Forbidden');
}

mysqli_report(MYSQLI_REPORT_OFF);

$con->query("CREATE TABLE IF NOT EXISTS `$table_name` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`email` varchar(45) NOT NULL,
`mac` varchar(45) NOT NULL,
`ip` varchar(45) NOT NULL,
`last_updated` DATETIME NOT NULL,
INDEX (`mac`),
PRIMARY KEY (`id`)
)");


# Checking DB to see if user exists or not.
$result = $con->query(sprintf("SELECT * FROM `%s` WHERE mac='%s'", 
                              $table_name, 
                              mysqli_real_escape_string($con, $_SESSION['mac']))); 

if ($error == "" && $result->num_rows >= 1) {
  $row = mysqli_fetch_array($result);
  $_SESSION["user_type"] = "repeat";
  header("Location: welcome.php");
}

?>
<!doctype html>
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
            <img src="assets/images/logo.png">
        </figure>
    </div>

    <div class="main">
        <section class="section"><?php if ($error != "") { ?>
            <div><?php echo $error; ?></div>
            <?php } ?>
            <div class="container">
                <div id="contact_form" class="content is-size-5 has-text-centered has-text-weight-bold">Entrar detalles
                </div>
                <form method="post" action="connect.php">
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="email" id="form_font" name="email" placeholder="Email" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="columns is-centered is-mobile">
                        <div class="policy">
                        <?php include 'policy.php'; ?>
                        <br>
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" required>
                                Estoy de acuerdo con los <a href="condiciones.php">Condiciones de uso</a>
                            </label>
                        </div>

                        </div>

                    </div>
                    <br>
                    <div class="buttons is-centered">
                        <button class="button is-link">Conectar</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
</html>