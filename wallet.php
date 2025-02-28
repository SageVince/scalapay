<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wallet_path = $_POST['wallet_path'];
    $wallet_password = $_POST['wallet_password'];

    // Open the wallet
    $wallet = new Wallet($wallet_path, $wallet_password, "English", Wallet::MAINNET);

    if ($wallet->status() != Wallet::Status_Ok) {
        echo "Error: " . $wallet->errorString();
        exit;
    }

    $_SESSION['wallet'] = $wallet;
    echo "Wallet signed in successfully.";
}
?>
