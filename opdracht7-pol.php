<h1>Stelling van de maand: "php is de leukste programmeertaal!"</h1>
<form method="POST">
  <input type="radio" name="optie" value="1">
  <label for="rood">inderdaad,PHP is het helemaal</label><br>
  <input type="radio" name="optie" value="2">
  <label for="blauw">PHP is leuk, maar niet leukste</label><br>
  <input type="radio" name="optie" value="3">
  <label for="groen">PHP is saai</label><br>
  <input type="radio" name="optie" value="4">
  <label for="geen">geen mening</label><br><br>
  <input type="submit" value="verzenden">
</form>

<?php
// Verbinding maken met de database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "poll";
$conn = mysqli_connect($host, $user, $password, $dbname);

// Controleren op fouten bij het maken van verbinding
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

// Controleren of de poll is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $optie = $_POST["optie"];
    if($optie == "1"){
        $sql = "UPDATE pol SET stem1 = stem1 + 1";
    }
    elseif ($optie == "2"){
        $sql = "UPDATE pol SET stem2 = stem2 + 1";
    }
    elseif ($optie == "3"){
     $sql = "UPDATE pol SET stem3 = stem3 + 1";
    } 
     elseif ($optie == "4"){
        $sql = "UPDATE pol SET stem4 = stem4 + 1";
    }

    mysqli_query($conn, $sql);
}

$sql = "SELECT stem1, stem2, stem3, stem4 FROM pol";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    echo "<h2>Poll Results</h2>";
echo "<table>";
echo "<tr><th>Choice</th><th>Count</th></tr>";

if ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>1</td><td>" . $row["stem1"] . "</td></tr>";
    echo "<tr><td>2</td><td>" . $row["stem2"] . "</td></tr>";
    echo "<tr><td>3</td><td>" . $row["stem3"] . "</td></tr>";
    echo "<tr><td>4</td><td>" . $row["stem4"] . "</td></tr>";
    echo "</table>";
} else {
    echo "No results found.";
}

}
// De verbinding sluiten
mysqli_close($conn);
?>
