<?php
abstract class PaymentMethod {
   
    abstract public function processTransaction($amount);
}


class CreditCard extends PaymentMethod {
   
    public function processTransaction($amount) {
        echo "Processing a credit card payment of $" . number_format($amount, 2) . ".<br>";
    }
}


class CashOnDelivery extends PaymentMethod {
    
    public function processTransaction($amount) {
        echo "Processing a cash-on-delivery payment of $" . number_format($amount, 2) . ".<br>";
       
    }
}
?>
