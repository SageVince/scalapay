<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['wallet'])) {
        echo "Error: No wallet signed in.";
        exit;
    }

    $wallet = $_SESSION['wallet'];
    $address = $_POST['address'];
    $amount = $_POST['amount'];
    $payment_id = $_POST['payment_id'];

    // Create the transaction
    $transaction = $wallet->createTransaction($address, $payment_id, $amount, 4, PendingTransaction::Priority_Low);

    if ($transaction->status() != PendingTransaction::Status_Ok) {
        echo "Error: " . $transaction->errorString();
        exit;
    }

    // Commit the transaction
    if (!$transaction->commit()) {
        echo "Error: " . $transaction->errorString();
        exit;
    }

    echo "Transaction committed successfully.";
}
?>
