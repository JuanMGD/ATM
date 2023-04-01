<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./ATM.css">
    <title>ATM</title>
</head>
<body>
    <?php 
        require '../Bank.php';
        require '../ATM.php';
        use App\Bank;
        use App\ATM;
        
        $amount = $errorMessage = "";
        $atm;

        session_start();
        
        if (isset($_SESSION["pin"])) {
            $atmObj = new Bank($_SESSION["pin"]);
            $atmFunds = $atmObj->getAtmFunds();
            $atm = new ATM(new Bank($_SESSION["pin"]), $atmFunds); 
        } else {
            header("location:index.php");
        }
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["account"]) || floatval($_POST["account"]) <= 0)
                $errorMessage = "Account number is required";
            else {
                $account = test_input($_POST["account"]);
                $cuentaExiste = $atmObj->validateAccountNumber($account);

                if (!$cuentaExiste) 
                    $errorMessage = "Account not found";
                else {
                    $_SESSION["transferAccountNumber"] = $account;
                    header("location:transferenciaCantidad.php");
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
            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <p class="w-100 ml-1 info-txt mb-1 txt-center">Account number</p>
                <input type="text" id="input" class="hidden money" name="account" value="<?php echo $amount;?>">
                <div id="input-box" class="input-box ml-1 money"><?php echo $amount;?></div>
                <span id="err-msg" class=<?php if(!empty($errorMessage)) echo "error"; else echo "";?>>
                    <?php echo $errorMessage;?>
                </span>
            </form>        
        </div>
        <div class="credit-card-container" onload="animar()">
            <div class="frame"></div>
            <div class="cover-top"></div>
            <div class="upper slot active" id="upperSlot"></div>
            <div class="lower slot active" id="lowerSlot"></div>
            <img id="card" class="in" src="../assets/credit-card.webp" alt="">

            <div class="options">
                <button class="btn" onclick="accept()">Accept</button>
                <a href="./index.php" class="btn">Cancel</a>
            </div>
            <div class="keyboard">
                <button onclick="addNumber(1)">1</button>
                <button onclick="addNumber(2)">2</button>
                <button onclick="addNumber(3)">3</button>
                <button onclick="addNumber(4)">4</button>
                <button onclick="addNumber(5)">5</button>
                <button onclick="addNumber(6)">6</button>
                <button onclick="addNumber(7)">7</button>
                <button onclick="addNumber(8)">8</button>
                <button onclick="addNumber(9)">9</button>
                <button onclick="addNumber(0)">0</button>
                <button onclick="addNumber('.')">.</button>
                <button onclick="deleteNumber()">&#9003;</button>
            </div>
        </div>
    </main>

    <script src="./js/keyboard.js"></script>
</body>
</html>