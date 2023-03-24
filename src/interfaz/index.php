<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./ATM.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>ATM</title>
</head>
<body>
    <?php 
        require '../Bank.php';
        use App\Bank;
        session_start();
        
        $pin = $errorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["pin"])) 
                $errorMessage = "Pin is required";
            else {
                $pin = test_input($_POST["pin"]);
                $account = new Bank($pin);
        
                if (!$account->validatePin())
                    $errorMessage = "Wrong pin";
                else {
                    $_SESSION["pin"] = $pin;
                    header("location:operaciones.php?");
                }
            }
            
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    
    <main class="contenedor">
        <div class="info">
            <h1 class="w-100 txt-center title">WD3 Bank</h1>
            <h2 class="w-100 txt-center title">Welcome</h2>
            <p class="w-100 ml-1 info-txt">To begin using this ATM's services insert your pin</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="password" maxlength="4" id="input" class="input ml-1" name="pin" placeholder="Pin" value="<?php echo $pin;?>">
                <input class="boton ml-1" type="submit" name="submit" value="Accept"><br>
                <span class=<?php if(!empty($errorMessage)) echo "error"; else echo "";?>>
                    <?php echo $errorMessage;?>
                </span>
            </form>
        </div>
        <div class="credit-card-container" onload="animar()">
            <div class="frame"></div>
            <div class="cover-top"></div>
            <div class="upper slot" id="upperSlot"></div>
            <div class="lower slot" id="lowerSlot"></div>
            <img id="card" src="../assets/credit-card.webp" alt="">

            <div class="options">
                <button onclick="sumbit()">Aceptar</button>
                <button>Cancelar</button>
            </div>

            <div class="keyboard">
                <button onclick="addNumbers(1)">1</button>
                <button onclick="addNumbers(2)">2</button>
                <button onclick="addNumbers(3)">3</button>
                <button onclick="addNumbers(4)">4</button>
                <button onclick="addNumbers(5)">5</button>
                <button onclick="addNumbers(6)">6</button>
                <button onclick="addNumbers(7)">7</button>
                <button onclick="addNumbers(8)">8</button>
                <button onclick="addNumbers(9)">9</button>
                <button onclick="addNumbers(0)">0</button>
                <button onclick="addNumbers('.')">.</button>
                <button onclick="deleteNumber()">&#9003;</button>
            </div>
        </div>
    </main>

    <script src="./js/animacion.js"></script>
    <script src="./js/keyboard.js"></script>
</body>
</html>