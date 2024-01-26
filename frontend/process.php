<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["createUser"])) {
        // Crear Usuario //
        $postData = array(
            'nombres' => $_POST['createNombres'],
            'email' => $_POST['createEmail'],
            'username' => $_POST['createUsername'],
            'password' => $_POST['createPassword'],
            'cuenta' => $_POST['createCuenta'],
            'saldo' => $_POST['createSaldo']
        );

        $ch = curl_init("http://backend:5000/create_user");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    } elseif (isset($_POST["updateUser"])) {
        // Process the update user form submission
        $postData = array(
            'nombres' => $_POST['updateNombres'],
            'email' => $_POST['updateEmail'],
            /* 'username' => $_POST['updateUsername'],
            'password' => $_POST['updatePassword'], */
            /* 'cuenta' => $_POST['updateCuenta'],
            'saldo' => $_POST['updateSaldo'] */
            // Add other fields as needed
        );

        $ch = curl_init("http://backend:5000/update_user/" . $_POST['updateUserId']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    } elseif (isset($_POST["deleteUser"])) {
        // Process the delete user form submission
        $ch = curl_init("http://backend:5000/delete_user/" . $_POST['deleteUserId']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    } elseif (isset($_POST["deposit"])) {
        // Process the deposit form submission
        $postData = array(
            'username' => $_POST['depositUsername'],
            'amount' => (float)$_POST['depositAmount']
        );

        $ch = curl_init("http://backend:5000/deposit");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    }   elseif (isset($_POST["transferBalance"])) {
        // Procesar la transferencia de saldo
        $transferAmount = (float)$_POST['transferAmount'];
        $feeAmount = $transferAmount * 0.02;

        // Datos para la transferencia
        $postData = array(
            'remitente_username' => $_POST['transferRemitente'],
            'beneficiario_username' => $_POST['transferBeneficiario'],
            'amount' => $transferAmount  // Enviar la cantidad sin incluir la tarifa
        );

        $ch = curl_init("http://backend:5000/transfer_balance");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        // Verificar la respuesta y mostrar la alerta
        if ($response === '{"message":"Transferencia exitosa"}') {
            // Si la transferencia es exitosa, mostrar la alerta con el monto a debitar
            echo '<script>alert("El total a debitarse será: ' . ($transferAmount + $feeAmount) . '");</script>';
        } else {
            // Si hay un error, mostrar la respuesta del servidor
            echo $response;
        }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["getUser"])) {
        // Process the get user form submission
        $ch = curl_init("http://backend:5000/get_user/" . $_GET['getUserId']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    } elseif (isset($_GET["listUsers"])) {
        // Process the list users form submission
       
        $ch = curl_init("http://backend:5000/list_users");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);

echo $response;

    }
}
}
?>
