<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


class Xoo_Sl_Apple{


    protected static $_instance = null;


    public static function get_instance(){
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


     * @param string $der
     * @param int    $partLength
     *
     * @return string
     */
    public static function fromDER(string $der, int $partLength){
        $hex = unpack('H*', $der)[1];
        if ('30' !== mb_substr($hex, 0, 2, '8bit')) { // SEQUENCE
            throw new \RuntimeException();
        }
        if ('81' === mb_substr($hex, 2, 2, '8bit')) { // LENGTH > 128
            $hex = mb_substr($hex, 6, null, '8bit');
        } else {
            $hex = mb_substr($hex, 4, null, '8bit');
        }
        if ('02' !== mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new \RuntimeException();
        }
        $Rl = hexdec(mb_substr($hex, 2, 2, '8bit'));
        $R = self::retrievePositiveInteger(mb_substr($hex, 4, $Rl * 2, '8bit'));
        $R = str_pad($R, $partLength, '0', STR_PAD_LEFT);
        $hex = mb_substr($hex, 4 + $Rl * 2, null, '8bit');
        if ('02' !== mb_substr($hex, 0, 2, '8bit')) { // INTEGER
            throw new \RuntimeException();
        }
        $Sl = hexdec(mb_substr($hex, 2, 2, '8bit'));
        $S = self::retrievePositiveInteger(mb_substr($hex, 4, $Sl * 2, '8bit'));
        $S = str_pad($S, $partLength, '0', STR_PAD_LEFT);
        return pack('H*', $R.$S);
    }



    /**
     * @param string $data
     *
     * @return string
     */
    private static function preparePositiveInteger(string $data){
        if (mb_substr($data, 0, 2, '8bit') > '7f') {
            return '00'.$data;
        }
        while ('00' === mb_substr($data, 0, 2, '8bit') && mb_substr($data, 2, 2, '8bit') <= '7f') {
            $data = mb_substr($data, 2, null, '8bit');
        }
        return $data;
    }


    /**
     * @param string $data
     *
     * @return string
     */
    private static function retrievePositiveInteger(string $data){
        while ('00' === mb_substr($data, 0, 2, '8bit') && mb_substr($data, 2, 2, '8bit') > '7f') {
            $data = mb_substr($data, 2, null, '8bit');
        }
        return $data;
    }


    public function encode($data) {
        $encoded = strtr(base64_encode($data), '+/', '-_');
        return rtrim($encoded, '=');
    }



    public static function generateJWT($kid, $iss, $sub, $key) {
        
        $header = [
            'alg' => 'ES256',
            'kid' => $kid
        ];
        $body = [
            'iss' => $iss,
            'iat' => time(),
            'exp' => time() + 3600,
            'aud' => 'https://appleid.apple.com',
            'sub' => $sub
        ];


        $privKey = openssl_pkey_get_private($key);
        
        if (!$privKey){
           return false;
        }

        $payload = $this->encode(json_encode($header)).'.'.$this->encode(json_encode($body));
        
        $signature = '';
        $success = openssl_sign($payload, $signature, $privKey, OPENSSL_ALGO_SHA256);
        if (!$success) return false;

        $raw_signature = $this->fromDER($signature, 64);
        
        return $payload.'.'.$this->encode($raw_signature);
    }


    public function verifyToken(){


                $body = $_POST['userInfo'];


        $kid = 'WFTPSX6R98'; // identifier for private key
$iss = 'A7X5AQUT4K'; // team identifier
$sub = 'com.turingpi.loginservice'; // my app id

$key = <<<EOD
-----BEGIN PRIVATE KEY-----
MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgg0syGW+WB9E6P/G7
yb4Y4dDTJTGOKBRaIDV+TPUFtVWgCgYIKoZIzj0DAQehRANCAARs5LoJ2YrDBig8
R1/qgjdS6pT4BFXObyJoBzoGZRjx1pCFADNjyzGZ2g64zTWvEx4kC6/A7dHpKvFM
fXg/LXEl
-----END PRIVATE KEY-----
EOD; // replaced with correct key


 $jwt = xoo_sl_helper()->generateJWT($kid, $iss, $sub, $key);


         $body = array_merge( $body, array(
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->settings['gl-apple-clientid'],
            'redirect_uri'  => $this->settings['gl-apple-redirect'],
            'client_secret' => $jwt,
        ) );

        print_r(json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $body['id_token'])[1])))));


        print_r($body);

        $response = wp_remote_post(
            'https://appleid.apple.com/auth/token?response_mode=form_post',
            array(
                'body'  => $body,
                'headers'    => array(
                    'Authorization' => 'Basic  ' . base64_encode($body['client_id'] . ':' . $body['client_secret'])
                ),
            )
        );

         if (is_wp_error($response)) {

                
            } else if (wp_remote_retrieve_response_code($response) !== 200) {

                //$this->errorFromResponse(json_decode(wp_remote_retrieve_body($response), true));
            }

            $accessTokenData = json_decode(wp_remote_retrieve_body($response), true);

        print_r($accessTokenData);
        die();
    }

}

function xoo_sl_apple(){
    return Xoo_Sl_Apple::get_instance();
}
xoo_sl_apple();