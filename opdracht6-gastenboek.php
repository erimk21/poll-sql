<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog Pagina</title>
</head>
<body>
    <form action="opdracht6-gastenboek.php" method="post">
        <label>naam</label><br>
            <input type="text" name="name"><br>
        <label>bericht</label><br>
        <textarea name="comment" rows="5" cols="25"></textarea><br>
        <input type="submit" name="opslaan" value="opslaan">
    </form>


<?php
$db = new PDO("mysql:host=localhost;dbname=gastenboek", "root" , "");
$query = $db->prepare("SELECT * FROM berichten");
$query->execute();
$result = $query->fetchALL(PDO::FETCH_ASSOC);

if(isset($_POST['opslaan'])) {
    $naam = filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW);
    $berichten = filter_input(INPUT_POST, "comment", FILTER_UNSAFE_RAW);
    $datumtijd = date('Y-m-d H:i:s');

    $query = $db->prepare("INSERT INTO berichten (naam, berichten, datumtijd) VALUES (:naam, :berichten, :datumtijd)");
    
    $query->bindParam("naam", $naam);
    $query->bindParam("berichten", $berichten);
    $query->bindParam("datumtijd", $datumtijd);
    if($query->execute()) {
        echo "Bericht opgeslagen!";
        echo "<br>";
    }
}   else{
    echo "niet opgeslagen";
}
ovb($result);
connectdb();

function connectdb(){
    





try {
    $db = new PDO("mysql:host=localhost;dbname=gastenboek", "root", "");
    $query = $db->prepare("SELECT * FROM berichten");
    $query->execute();
    $result = $query->fetchALL(PDO::FETCH_ASSOC);
    // global $result;
    // $result = $query->fetchAll();
    return $result;
}
catch (PDOException $e) {
    die ("error!: " . $e->getMessage()) ;
}
}
function ovb($result) {
    $result;
    foreach ($result as $row) {
        echo "<br>";
        echo $row['naam'] . "-" . $row['datumtijd'] . "<br>";
        echo $row['berichten'] . "<br><br>";
    }
}


?>