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
        require '../ATM.php';
        use App\Bank;
        use App\ATM;

        $pin = $errorMessage = "";
        $atmFunds = 5000;
        $atm;

        session_start();
        
        if (isset($_SESSION["pin"])) 
            $atm = new ATM(new Bank($_SESSION["pin"]), 5000); 
        else
            header("location:index.php");
        

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
                    header("location:retiro.php?");
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
            <h2 class="w-100 txt-center title">Select an operation</h2>
            <div class="operations">
                <a href="./retiro.php" class="boton ml-1">Withdraw</a>
                <a href="./deposito.php" class="boton ml-1">Deposit</a>
            </div>
        </div>
        <div class="credit-card-container" onload="animar()">
            <div class="frame"></div>
            <div class="cover-top"></div>
            <div class="upper slot active" id="upperSlot"></div>
            <div class="lower slot active" id="lowerSlot"></div>
            <img id="card" class="in" src="../assets/credit-card.webp" alt="">

            <div class="options">
                <button class="btn" onclick="sumbit()">Accept</button>
                <!-- <button class="btn">Cancelar</button> -->
                <a href="./index.php" class="btn">Cancel</a>
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
</body>
</html>