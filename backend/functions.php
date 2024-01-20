<?php

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'login':
            $result = login($_POST['username'], $_POST['password']);
            echo $result;
            
			if ($result === 'OK') {
                session_start();
                $_SESSION['user'] = $_POST['username'];
            }
            break;

        case 'getBalance':
            echo json_encode(getBalance($_POST['msisdn']));
            break;

        default:
            echo 'Invalid action';
            break;
    }
}


function getBalance($msisdn) {
    $url = 'http://34.125.2.150:8080/balance?msisdn=' . urlencode($msisdn);

    // cURL ile istek yapma
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    // Hata kontrolü
    if (curl_errno($ch)) {
        return false; // Hata oluştu
    }

    curl_close($ch);

    // JSON dönüşünü çözümleme
    $data = json_decode($response, true);

    return $data;
}

function login($msisdn, $password) {
    $url = 'http://34.125.2.150:8080/login?msisdn=' . urlencode($msisdn) . '&password=' . urlencode($password);

    // cURL ile istek yapma
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    // Hata kontrolü
    if (curl_errno($ch)) {
        return 'NOK'; // Hata oluştu
    }

    curl_close($ch);

    // Başarılı ise "OK" döndür, aksi takdirde "NOK"
    return ($response === 'OK') ? 'OK' : 'NOK';
}



?>
