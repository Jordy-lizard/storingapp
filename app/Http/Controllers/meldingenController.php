<?php

//Variabelen vullen
$action = $_POST['action'];
if($action == "create"){
    $attractie = $_POST['attractie'];
    if(empty($attractie))
    {
        $errors[]="Vul de attractie-naam in.";
    }
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    if (empty($type))
    {
        $errors[] = "Kies een type.";
    }

    $capaciteit = $_POST['capaciteit'];
    if(!is_numeric($capaciteit ))
    {
        $errors[]="Vul voor capaciteit een getal in.";
    }
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = 1;
    }
    else
    {
        $prioriteit = 0;
    }
    $melder = $_POST['melder'];
    if(empty($melder))
    {
        $errors[]="Vul alstublieft u naam in.";
    }
    $gemeld_op = $_POST['gemeld_op'];

    $overig = $_POST['overig'];
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }
    $action = $_POST['action'];
    

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
    VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

    //3. Prepare
    $statement = $conn->prepare($query);
    //4. Execute
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig
    ]);
    header("Location: ". $base_url . "/resources/views/meldingen/index.php?msg=Meldingopgeslagen"); 
}


if ($action == "update") {

    $id = $_POST['id'];
    $attractie = $_POST['attractie'];
    $type = $_POST['type'];
    $capaciteit = $_POST['capaciteit'];
    if (isset($_POST['prioriteit'])) {
        $prioriteit = 1;
    } else {
        $prioriteit = 0;
    }
    // ...............
    $melder = $_POST['melder'];
    $overig = $_POST['overig'];

    // echo $id . " , " . $attractie . " , " . $type . " , " . $capaciteit . " , " . $melder . " , " . $prioriteit . " , " . $overig;
    // die;

    require_once '../../../config/conn.php';
    $query = "UPDATE meldingen SET attractie = :attractie, type = :type, capaciteit = :capaciteit, prioriteit = :prioriteit, melder =:melder, overige_info = :overige_info WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":attractie" => $attractie,
        ":type" => $type,
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overig,
        ":id" => $id
    ]);

    // Stuur gebruiker terug naar overzicht
    // ..............
    header(header: "Location: " . $base_url . "/resources/views/meldingen/index.php?msg=Meldingopgeslagen");

}
if($action == "delete"){

    $id = $_POST['id'];

    // 1. Verbinding
    require_once '../../../config/conn.php';

    // 2. Query
    $query = "DELETE FROM meldingen WHERE id = :id";

    // 3. Prepare
    $statement = $conn->prepare($query);

    // 4. Execute
    $statement->execute([
        ":id" => $id
    ]);

    // Gebruiker terugsturen naar het overzicht
    header("Location: " . $base_url . "/resources/views/meldingen/index.php?msg=Meldingverwijderd");
}