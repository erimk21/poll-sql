<?php
include_once('db.php');
function generatePassword($length = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chars_length = strlen($chars);
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, $chars_length - 1)];
    }
    return $password;
}

$password = generatePassword(10);
echo "Willekeurig wachtwoord van 10 tekens: " . $password . "<br>";

function getBrowserName($user_agent) {
    $browser_patterns = array(
        'Firefox' => '/Firefox\/([0-9\.]+)/',
        'Chrome' => '/Chrome\/([0-9\.]+)/',
        'Safari' => '/Safari\/([0-9\.]+)/',
        'Edge' => '/Edge\/([0-9\.]+)/',
        'IE' => '/MSIE\s([0-9\.]+);/',
        'Opera' => '/Opera\/([0-9\.]+)/',
        'Netscape' => '/Netscape\/([0-9\.]+)/'
    );
    foreach ($browser_patterns as $name => $pattern) {
        if (preg_match($pattern, $user_agent, $matches)) {
            return $name;
        }
    }
    return 'Onbekend';
}

function getOperatingSystem($user_agent) {
    $os_patterns = array(
        'Windows 10' => '/Windows NT 10\.0/',
        'Windows 8.1' => '/Windows NT 6\.3/',
        'Windows 8' => '/Windows NT 6\.2/',
        'Windows 7' => '/Windows NT 6\.1/',
        'Windows Vista' => '/Windows NT 6\.0/',
        'Windows XP' => '/Windows NT 5\.1/',
        'macOS' => '/Macintosh/',
        'Linux' => '/Linux/',
        'iOS' => '/iPhone|iPad|iPod/',
        'Android' => '/Android/'
    );
    foreach ($os_patterns as $name => $pattern) {
        if (preg_match($pattern, $user_agent)) {
            return $name;
        }
    }
    return 'Onbekend';
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$browser = getBrowserName($user_agent);
$os = getOperatingSystem($user_agent);

echo "Browser: $browser <br>";
echo "Besturingssysteem: $os<br>";
echo "<br>";

function insert($conn, $browser, $os){
    $sql = "INSERT INTO verdiep (browser, os) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../User/signup.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $browser, $os);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
insert($conn, $browser, $os);

function countSql($conn, $style){
    $sqli = "SELECT * FROM verdiep WHERE browser = '$style' ";
    $result = mysqli_query($conn, $sqli);

    $aantal = mysqli_num_rows($result);
    echo $aantal;
}
function cijferSytm($conn){
    $sqli = "SELECT * FROM cijfersytm";
    $result = mysqli_query($conn, $sqli);
    while ($row = mysqli_fetch_assoc($result)){
        $naam = $row['leerling'];
        $cijfer = $row['cijfer'];

        $aantal = '
        <tr>
        <td>'.$naam.'</td>
        <td>'.$cijfer.'</td>
        </tr>
        ';
        echo $aantal;
    }
    echo "<br>";
}
?>
<table border="1" width="250">
  <tr>
    <th>Webbrowser</th>
    <th>bezoeken</th>
  </tr>
  <tr>
    <td>Chrome</td>
    <td><?php countSql($conn, "Chrome");?></td>
  </tr>
  <tr>
    <td>FireFox</td>
    <td><?php countSql($conn, "FireFox");?></td>
  </tr>
  <tr>
    <td>Internet Explorer</td>
    <td><?php countSql($conn, "InternetExplorer");?></td>
  </tr>
  <tr>
    <td>Linux</td>
    <td><?php countSql($conn, "Linux");?></td>
  </tr>
</table>

<table border="1" width="250">
    <tr>
    <th>Leerling</th>
    <th>Cijfer</th>
  </tr>
  <?php
    cijferSytm($conn);
  ?>
</table>
<br>
<?php
    $sqli2 = "SELECT cijfer FROM cijfersytm;";
    $result2 = mysqli_query($conn, $sqli2);
    $sqli3 = "SELECT * FROM cijfersytm ORDER BY cijfer DESC";
    $result3 = mysqli_query($conn, $sqli3);
    $sqli4 = "SELECT * FROM cijfersytm ORDER BY cijfer ASC";
    $result4 = mysqli_query($conn, $sqli4);
    $aantalcijfers = mysqli_num_rows($result2);
    $Cmath = 0;
    while ($row = mysqli_fetch_assoc($result2)){
        $gemmiddeldcijfer = $row['cijfer'];
        $Cmath = $Cmath + $gemmiddeldcijfer;
    }
    echo "het gemiddelde cijfer is een: ".$Cmath / $aantalcijfers."<br>";

    if ($row = mysqli_fetch_assoc($result3)){
        $laagstecijfer = $row['cijfer'];
        echo "het hoogste cijfer is een: ".$laagstecijfer."<br>";
    }

    if ($row = mysqli_fetch_assoc($result4)){
        $HOOGSTECIJFER = $row['cijfer'];
        echo "het laagste cijfer is een: ".$HOOGSTECIJFER."<br>";
    }

    $sqli5 = "SELECT * FROM optie WHERE Optie = 'yes';";
    $result5 = mysqli_query($conn, $sqli5);
    $sqli6 = "SELECT * FROM optie WHERE Optie = 'no';";
    $result6 = mysqli_query($conn, $sqli6);
    $sqli7 = "SELECT * FROM optie WHERE Optie = 'saai';";
    $result7 = mysqli_query($conn, $sqli7);
    $sqli8 = "SELECT * FROM optie WHERE Optie = 'geenstem';";
    $result8 = mysqli_query($conn, $sqli8);

    if ($row = mysqli_fetch_assoc($result5)){
        $yesstem = $row['stemmen'];
    }else{
        $yesstem = 0;
    }
    if ($row = mysqli_fetch_assoc($result6)){
        $nosstem = $row['stemmen'];
    }else{
        $nosstem = 0;
    }
    if ($row = mysqli_fetch_assoc($result7)){
        $saaistem = $row['stemmen'];
    }else{
        $saaistem = 0;
    }
    if ($row = mysqli_fetch_assoc($result8)){
        $geenstem = $row['stemmen'];
    }else{
        $geenstem = 0;
    }
    $totalstemmen = $yesstem + $nosstem + $saaistem = $geenstem;
?>
<br>
<table border="1" width="500">
  <tr>
    <th>Stelling van de maand: "Php is de leukste programmeertaal"</th>
  </tr>
  <tr>
    <th>Aantal uitgebrachte stemmen: <?php ?></th>
  </tr>
  </table>
  <table border="1" width="500">
  <tr>
    <th>inderdaad, PHP is het helemaal</th>
    <th><?php echo $yesstem ?></th>
    <th><?php echo $yesstem / $totalstemmen * 100 . "%"?></th>
  </tr>
  <tr>
    <th>PHP is de slechtste</th>
    <th><?php echo $nosstem ?></th>
    <th><?php echo $nosstem / $totalstemmen * 100 . "%"?></th>
  </tr>
  <tr>
    <th>PHP is saai</th>
    <th><?php echo $saaistem ?></th>
    <th><?php echo $saaistem / $totalstemmen * 100 . "%"?></th>
  </tr>
  <tr>
    <th>geen mening</th>
    <th><?php echo $geenstem ?></th>
    <th><?php echo $geenstem / $totalstemmen * 100 . "%"?></th>
  </tr>
</table>

