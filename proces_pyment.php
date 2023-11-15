<?php

require_once 'vendor/autoload.php';

try {
    MercadoPago\SDK::setAccessToken("TEST-5815584323800259-111015-b284fbb9b207b88c1260342d84b5d5d6-1377005579");
    $contents = json_decode(file_get_contents('php://input'), true);

    $payment = new MercadoPago\Payment();
    
    // Valores ficticios para la transacción
    $payment->transaction_amount = $contents['transaction_amount'];
    $payment->token = $contents['token'];
    $payment->installments = $contents['installments'];
    $payment->payment_method_id = $contents['payment_method_id'];
    $payment->issuer_id = $contents['issuer_id'];
    // Crea un objeto de pagador
    $payer = new MercadoPago\Payer();
    $payer->email = $contents['payer']['email'];
      $payer->identification = array(
        "type" => $contents['payer']['identification']['type'],
        "number" => $contents['payer']['identification']['number']
      );
    $payment->payer = $payer;

    // Guarda la transacción
    $payment->save();

    $response = array(
        'status' => $payment->status,
        'status_detail' => $payment->status_detail,
        'id' => $payment->id
    );

    echo json_encode($response);
}catch (Exception $e) {
  
    $errorResponse = array(
        'error' => true,
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()  // Añade la traza de la excepción para obtener más detalles
    );
    echo json_encode($errorResponse);
}
?>
