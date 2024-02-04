<?php
// Ação para processar a submissão do formulário
add_action('wp_ajax_subscribe_newsletter', 'subscribe_newsletter');
add_action('wp_ajax_nopriv_subscribe_newsletter', 'subscribe_newsletter');

// Endpoint para formulário
function subscribe_newsletter() {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $consent = isset($_POST['consent']) ? $_POST['consent'] : '';

    $array_return = [];

    // Validar no backend os valores email e consent
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $array_return['success'] = false;
        $array_return['message'] = 'E-mail inválido';

        echo json_encode($array_return);
        wp_die();
    }

    if ($consent != 'on') {
        $array_return['success'] = false;
        $array_return['message'] = 'Consentimento obrigatório';

        echo json_encode($array_return);
        wp_die();
    }

    // Aqui, e-mail está válido e conset está aceito. Não é necessária validações adicionais
    // Submete requests para marketing cloud
    $send_response = send_marketing_cloud($email, $consent);

    if ($send_response['success'] == false) {
        $array_return['message'] = 'Falha ao registrar e-mail!';
        $array_return['send_response'] = $send_response;
    }
    else {
        $array_return['message'] = 'Sucesso ao registrar e-mail!';
        $array_return['send_response'] = $send_response;
    }

    echo json_encode($array_return);
    wp_die();
}


// Submissão de 2 requests para mkt cloud:
function send_marketing_cloud($email, $consent) {

    $response = [];

    // Dados adicionais, se necessário
    $body = [
        [
            "keys" => [
                "email" => $email                               // Para testes, usar teste-24-7@email.com, para não sujar base de produção
            ],
            "values" => [
                "Aceite_de_Emails_e_SMS" =>  "1",               // Como consent está validado anteriormente, já forçamos "1"
                "Aceite_de_Privacidade" =>  "1",                // Como consent está validado anteriormente, já forçamos "1"
                "Link_da_LP" => $_SERVER['HTTP_REFERER'],       // URL do site
                "Origem" =>  "HOTSITE-SUMMIT-23",               // Não utilizado
                // "Valor_1" =>  "",                            // Não utilizado
                // "Valor_2" =>  "",                            // Não utilizado
                // "Valor_3" =>  "",                            // Não utilizado
                // "Valor_4" =>  "",                            // Não utilizado
                // "Valor_5" =>  "",                            // Não utilizado
                // "Gclid" =>  "hsdiqdnboqndjqndjkqndjklqndlqd" // Não utilizado
            ]
        ]
    ];

    $credentials = [
        "grant_type" => MARKETING_CLOUD_GRANT_TYPE,
        "client_id" => MARKETING_CLOUD_CLIENT_ID,
        "client_secret" => MARKETING_CLOUD_CLIENT_SECRET,
        "scope" => MARKETING_CLOUD_SCOPE,
        "account_id" => MARKETING_CLOUD_ACCOUNT_ID,
    ];

    $response['token_req'] = [];
    $response['save_req'] = [];

    // Request #1 - Token
    $response['token_req'] = api_post_call($credentials, MARKETING_CLOUD_TOKEN_URI,);

    if ( !$response['token_req'] || $response['token_req']['httpcode'] != 200) {
        $response['success'] = false;
        $response['message'] = 'Falha de obter token';
        return $response;
    }

    if (! isset(json_decode($response['token_req']['response'])->access_token)) {
        $response['success'] = false;
        $response['message'] = 'Falha ao realizar json_decode - parse do token';
        if (!WP_DEBUG) unset($response['token_req']);
        if (!WP_DEBUG) unset($response['save_req']);
        return $response;
    }

    // Request #2 - Save Lead
    $response['save_req'] = api_post_call($body, MARKETING_CLOUD_SAVE_LEAD_URI, json_decode($response['token_req']['response'])->access_token);

    if ( !$response['save_req'] || $response['save_req']['httpcode'] != 200) {
        $response['success'] = false;
        $response['message'] = 'Falha de realizar save';
        if (!WP_DEBUG) unset($response['token_req']);
        if (!WP_DEBUG) unset($response['save_req']);
        return $response;
    }

    $response['success'] = true;
    return $response;
}


function api_post_call($data, $api_uri, $token = false){

    // Inicializa a sessão cURL
    $ch = curl_init();

    $headers = [];

    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
        $headers[] = 'Content-Type: application/json';
    }

    $body = $token ? json_encode($data) : http_build_query($data);

    // Configura as opções da requisição cURL
    curl_setopt($ch, CURLOPT_URL, $api_uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Executa a requisição e obtém a resposta
    $response = curl_exec($ch);

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verifica se ocorreu algum erro na requisição
    if (curl_errno($ch)) {
        echo 'Erro na chamada da API: ' . curl_error($ch);
    }

    // Fecha a sessão cURL
    curl_close($ch);

    return [
        'api_uri' => $api_uri,
        'token' => $api_uri,
        'data' => $data,
        'headers' => $headers,
        'response' => $response,
        'httpcode' => $httpcode
    ];
}