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
    <header>
        <div></div>
        <div></div>
    </header>
    <!-- <main class="contenedor center">
        <div class="txt-center">
            <h1 class="w-100 txt-center title mb-1">Successful operation</h1>
            <br>
            <a href="./index.php" class="boton ml-1">Finish</a>
        </div>
    </main> -->
    <main class="contenedor">
        <div class="info">
            <!-- <h1 class="w-100 txt-center title">WD3 Bank</h1>
            <h2 class="w-100 txt-center title">Select an operation</h2> -->
            <div class="txt-center m-auto">
                <h1 class="w-100 txt-center title mb-1">Successful operation</h1>
                <br>
                <a href="./index.php" class="boton ml-1">Finish</a>
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