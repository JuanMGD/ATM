<!DOCTYPE html>
<html lang="en">
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
        $atmFunds = 5000;
        $atm;

        session_start();
        
        if (isset($_SESSION["pin"])) 
            $atm = new ATM(new Bank($_SESSION["pin"]), $atmFunds); 
        else
            header("location:index.php");
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["amount"]) || floatval($_POST["amount"]) <= 0)
                $errorMessage = "Amount is required";
            else {
                $amount = test_input($_POST["amount"]);
                $result = $atm->deposit($amount);

                if ($result != "Sucessful deposit") 
                    $errorMessage = $result;
                else 
                    header("location:success.php");
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <p class="w-100 ml-1 info-txt mb-1">Specify the amount</p>
                <input type="number" id="input" class="input ml-1 money" name="amount" value="<?php echo $amount;?>">
                <input class="boton ml-1" type="submit" name="submit" value="Accept">
                <span class=<?php if(!empty($errorMessage)) echo "error"; else echo "";?>>
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

    <script src="./js/keyboard.js"></script>
</body>
</html>