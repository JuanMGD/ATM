<?php
namespace App;

class ATM {
    private $amountInAtm = 0;
    private $bankAccount;
    
    
    function __construct($account, $amountInAtm) {
        $this->bankAccount = $account;
        $this->amountInAtm = $amountInAtm;
    }

    public function withdraw($amount){
        // Validate pin is valid
        if (!$this->bankAccount->validatePin()) 
            return "Wrong pin";

        // Validate current account has enough funds
        $balance = $this->bankAccount->getAccountBalance();
        if ($balance < $amount) {
            return "Insufficient funds in account";
        }

        // Validate if the ATM has funds
        if ($this->amountInAtm == 0)
            return "ATM is out of money";

        // Validate the ATM has sufficient funds 
        if ($this->amountInAtm < $amount)
            return "Insufficient funds in ATM";
        
        // Validate amount being a multiple of 100
        if (fmod(floatval($amount), 100) != 0)
            return "Amount must be a multiple of 100";

        $newBalance = $balance - $amount;
        $this->bankAccount->updateBalance($newBalance);
        return "Sucessful withdraw";
    }

    public function deposit($amount){
        // Validate pin is valid
        if (!$this->bankAccount->validatePin()) 
            return "Wrong pin";

        $balance = $this->bankAccount->getAccountBalance();

        // Validate amount being a multiple of 100
        if (fmod(floatval($amount), 100) != 0)
            return "Amount must be a multiple of 100";

        $newBalance = $balance + $amount;
        $this->bankAccount->updateBalance($newBalance);
        return "Sucessful deposit";
    }

    public function transfer($accountNumber, $amount){
        // Validate pin is valid
        if (!$this->bankAccount->validatePin()) 
            return "Wrong pin";

        // Validate account exists
        if (!$this->bankAccount->validateAccountNumber($accountNumber))
            return "Account not found";

        // Validate current account has enough funds
        $balance = $this->bankAccount->getAccountBalance();
        if ($balance < $amount) {
            return "Insufficient funds in account";
        }

        // Validate amount being a miltiple of 100
        if (fmod(floatval($amount), 100) != 0)
            return "Amount must be a multiple of 100";

        $this->bankAccount->transferFunds($accountNumber, $amount);
        return "Sucessful transfer";
    }
 }

?>