<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog Pagina</title>
</head>
<body>
    <form action="inlog.php" method="post">
        <label>Username</label>
            <input type="text" name="username"><br>
        <label>Password</label>
            <input type="password" name="password"><br>
        <input type="submit" name="inloggen" value="Inloggen">
    </form>
        <?php
        
        try {
            $db = new PDO("mysql:host=localhost;dbname=fietsenmaker", "root", "");
            if (isset($_POST["inloggen"])) {
                $username = filter_input(INPUT_POST, "username", FILTER_UNSAFE_RAW);
                $password = $_POST['password'];
                $query = $db->prepare("SELECT * FROM gebruikers WHERE username = :user");
                $query->bindParam("user", $username);
                $query->execute();
                if($query->rowCount() == 1){
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($password, $result["password"])) {
                        echo "Juiste gegevens";
                    } else {
                        echo "Onjuiste gegevens";
                    }
                } else {
                    echo "Onjuiste gegevens";
                }
                echo "<br>";
            }
        }   catch(PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
        
        ?>
        <br><br>
</body>
</html>