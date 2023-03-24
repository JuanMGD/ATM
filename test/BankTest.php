<?php
namespace App\Test;

use App\Bank;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase {
    // TESTS WITH DATABASE
    public function testGetPin() {
        $account = new Bank("4987");
        $this->assertEquals("4987", $account->getPin());
    }

    public function testValidatePin() {
        $account = new Bank("4987");
        $this->assertTrue($account->validatePin());
    }

    public function testGetAccountBalance() {
        $account = new Bank("4987", 1000);
        $this->assertEquals(1000, $account->getAccountBalance());
    }

    public function testUpdateBalance() {
        $account = new Bank("4987");
        $account->updateBalance(1500);
        $this->assertEquals(1500, $account->getAccountBalance());
    }
 }


?>