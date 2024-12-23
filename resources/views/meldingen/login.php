<?php
session_start();
if(isset($_SESSION['user_id']))
{
    $msg= "Je bent al ingelogd.";
    header("Location: " . $base_url . "/index.php?msg=$msg");
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once '../../views/components/head.php'; ?>
</head>

<body>
    <?php require_once '../../views/components/header.php'; ?>
    <div class="container home">
    <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/loginController.php" method="POST">
    <div class="form-group">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="submit" value="Login">
</form>
    </div>  
</body>

</html>
