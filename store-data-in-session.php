<?php
session_start();
// store details in db as per you need 
$id = $_POST['id'];
$payer = $_POST['payer'];
$intent = $_POST['intent'];
$status = $_POST['status'];
$currency = $_POST['currency'];
$amount = $_POST['amount'];
$data = json_decode($_POST['data'], true);

$_SESSION['paypal_data'] = [
    'id' => $id,
    'payer' => $payer,
    'intent' => $intent,
    'status' => $status,
    'currency' => $currency,
    'amount' => $amount,
    'data' => $data
];
echo json_encode(['success' => true]);