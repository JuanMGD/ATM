<?php
namespace App;

use mysqli;

class Bank {
    private $pin = "";
    
    function __construct($pin, $accountBalance=null) {
        $this->pin = $pin;
        if ($this->validatePin() && $accountBalance != null) {
            $this->updateBalance($accountBalance);
        }
    }

    // Authorize
    public function getPin() {
        return $this->pin;
    }

    // Check account balance
    public function getAccountBalance() {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT balance FROM account where pin = '{$this->pin}';"));
        $con->close();
        return $result['balance'] ?? 0;
        // return $this->accounts[$this->pin] ?? 0;
    }

    public function validatePin(/* $pin */) {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT pin FROM account where pin = '{$this->pin}';"));
        $con->close();
        return $result && $result != null;
    }

    public function updateBalance($balance) {
        $con = new mysqli("localhost", "root", "", "bank");
        $con->query("UPDATE account SET balance={$balance} where pin = '{$this->pin}';");
        $con->close();
    }

    public function getAtmFunds() {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT funds FROM atmfunds where pin = '{$this->pin}';"));
        $con->close();
        return $result['funds'] ?? 0;
    }

    public function validateAccountNumber($accountNumber) {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT accountNumber FROM account where accountNumber = '{$accountNumber}';"));
        $con->close();
        return $result && $result != null;
    }

    public function transferFunds($accountNumber, $amount) {
        $con = new mysqli("localhost", "root", "", "bank");
        $con->query("UPDATE account SET balance = balance - {$amount} where pin = '{$this->pin}';");
        $con->query("UPDATE account SET balance = balance + {$amount} where accountNumber = '{$accountNumber}';");
        $con->close();
    }
 }
 
?>