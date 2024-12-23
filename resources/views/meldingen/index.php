<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    $msg= "Je moet eerst inloggen!";
    header("Location: " . $base_url . "/resources/views/meldingen/login.php?msg=$msg");
    exit;
}
?>

<?php require_once __DIR__ . '/../../../config/config.php'; ?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>
        <?php
        require_once '../../../config/conn.php';
        $query = "select * from meldingen";
        $statement = $conn->prepare(($query));
        $statement->execute();
        $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table>
            <tr>
                <th>id</th>
                <th>Attractie</th>
                <th>Type</th>
                <th>capaciteit</th>
                <th>Melder</th>
                <th>Overige info</th>
                <th>Prioriteit</th>
                <th>Gemeld op</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach ($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['id'] ?></td>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['capaciteit'] ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><?php
                        if ($melding['prioriteit'] == 1) {
                            echo "Ja";
                        } else {
                            echo "Nee";
                        }
                        ?></td>
                    <td><?php echo $melding['gemeld_op'] ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id'] ?>">aanpassen</a></td>

                </tr>
            <?php endforeach; ?>
        </table>






    </div>

</body>

</html>