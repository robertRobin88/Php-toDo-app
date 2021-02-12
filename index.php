<?php 
addtext();
$error;
        function addtext() {
        if(isset($_POST["zadanie"])){
            if(empty($_POST["zadanie"])){
                
                // global $error;
                GLOBAL $error; 
                $error =  "Musisz wypełnić pole";
                
            } else{
                $conn = mysqli_connect("localhost", "root", "", "todoapp") or die("bład połaczneia");
                $textWrite = $_POST["zadanie"];
                $addTextToSql = "INSERT INTO zadanie (zadanie) VALUES ('$textWrite')";
                $saveText = mysqli_query($conn, $addTextToSql);
                header('location: index.php');
            }
        } 
    }
    deleText();
    function deleText() {
        
        if(isset($_POST["deleteButton"])){
            $id = $_POST["deleteButton"];
            // $servername = "localhost";
            // $pass = "";
            // $username = "root";

            // try {
            //     $conn = new PDO("mysql:host=$servername;dbname=todoapp", $username, $pass);
            //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //     echo "Connection successfull";
            // } catch(PDOException $e) {
            //     echo "Nie połaczono " . $e->getMessage();
            // }

            $conn = mysqli_connect("localhost", "root", "", "todoapp") or die("bład połaczneia");
            $deleteFunction = "DELETE FROM zadanie WHERE zadanie .id = '$id'";
            $sqlZad = mysqli_query($conn, $deleteFunction);
            mysqli_close($conn);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toDO app php</title>
    <style>
    .divZad{
        display: flex;
        border: 1px solid black;
        margin-bottom: 5px;
        
    }
    body {
        text-align: center;
    }
    .displayList{
        display: inline-block;
    }
    h2{
        width: 700px;
    }
    .dodanieZadania{
        margin-bottom: 30px;
    }
    button.deleteBut{
        background-color: crimson;
        font-size: 1rem;
        border: 1px solid crimson;
        margin: 10px;
        border-radius: 10px;
    }
    button{
        background-color: lightblue;
        font-size: 1rem;
        border: 1px solid lightblue;
        margin: 10px;
        border-radius: 10px;
        padding: 25px;
    }
    input{
        width: 475px;
        padding: 20px;
        font-size: 1.5rem;
    }
    </style>
</head>
<body>
    <h1>Lista zadań do zrobienie</h1>
    <div class="dodanieZadania">
    <?php 
            if(isset($error)){
                echo "<h5>";
                echo $error;
                echo "</h5>";
            }
        ?>
    <form action="index.php" method="POST">
        <h3>Dodaj nowe zadanie:  <input type="text" name="zadanie" id="zadanie">
        <button type="submit">Dodaj</h3></button>
       
    </form>
    
    </div>
    <?php
    echo "<form action=\"index.php\" method=\"POST\" class=\"displayList\">";
    todoApp();
    echo "</form>";
    ?>
</body>
</html>

<?php 
   

   
function todoApp(){
    $conn = mysqli_connect("localhost", "root", "", "todoapp") or die("bład połaczneia");
    $query = "SELECT * FROM zadanie";
    //wysłanie zapytania 
    $res = mysqli_query($conn, $query);
    $ile = mysqli_num_rows($res);
    if($ile == 0){
        echo "Brak zadań do wykonania";
    } else{
        while($row = mysqli_fetch_row($res)){
            
            echo '<div class="divZad">';
            echo "<h2>".$row[1]."</h2><button class=\"deleteBut\"name=\"deleteButton\" type=\"submit\" value=\"$row[0]\">USUŃ</button>";
            echo "</div>";
           
        }
    }
    mysqli_close($conn);

}

$arrayFruit = ["banana", "apple", "lemon"];

    foreach($arrayFruit as $fruit){
        echo $fruit."<br>" ;
    }

?>