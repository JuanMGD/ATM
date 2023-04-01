<!DOCTYPE html>
<html lang="es">
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

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            unset($_SESSION['pin']);
        }

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
            <p class="w-100 ml-1 info-txt txt-center">To begin using this ATM's services insert your pin</p>
            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="password" maxlength="4" id="input" class=" hidden" name="pin" placeholder="...." value="<?php echo $pin;?>">
                <div id="input-box" class="input-box ml-1"><?php echo str_repeat("*", strlen($pin)) . str_repeat(".", 4 - strlen($pin));?></div>
                <span id="err-msg" class=<?php if(!empty($errorMessage)) echo "error"; else echo "";?>>
                    <?php echo $errorMessage;?>
                </span>
            </form>
        </div>
        <div class="credit-card-container" onload="animar()">
            <div class="frame"></div>
            <div class="cover-top"></div>
            <div class="upper slot <?php if($_SERVER["REQUEST_METHOD"] == "POST") echo 'active'?>" id="upperSlot"></div>
            <div class="lower slot <?php if($_SERVER["REQUEST_METHOD"] == "POST") echo 'active'?>" id="lowerSlot"></div>
            <img id="card" class="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo 'in' ?>" src="../assets/card.svg" alt="">

            <div class="options">
                <button class="btn" onclick="accept()">Accept</button>
                <a href="./index.php" class="btn">Cancel</a>
            </div>

            <div class="keyboard">
                <button onclick="addPinNumber(1)">1</button>
                <button onclick="addPinNumber(2)">2</button>
                <button onclick="addPinNumber(3)">3</button>
                <button onclick="addPinNumber(4)">4</button>
                <button onclick="addPinNumber(5)">5</button>
                <button onclick="addPinNumber(6)">6</button>
                <button onclick="addPinNumber(7)">7</button>
                <button onclick="addPinNumber(8)">8</button>
                <button onclick="addPinNumber(9)">9</button>
                <button onclick="addPinNumber(0)">0</button>
                <button>.</button>
                <button onclick="deletePinNumber()">&#9003;</button>
            </div>
        </div>
    </main>

    <script src="./js/animacion.js"></script>
    <script src="./js/keyboard.js"></script>
</body>
</html>