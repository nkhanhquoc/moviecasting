<?php

namespace common\helpers;

use Yii;

class Encrypter {

    public static function encrypt($text) {
        Yii::info("input: $text", "encrypt");
        try {
            $key = md5(time());
            Yii::info("key: $key", "encrypt");
            $key_size = strlen($key);
            Yii::info("Key size: " . $key_size, "encrypt");

            # show key size use either 16, 24 or 32 byte keys for AES-128, 192 and 256 respectively
            $crypttext = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB));
            Yii::info("input_encrypt: $crypttext", "encrypt");
            $dataText = "value=$crypttext&key=$key";
            //Public
            $enctypter = new \common\rsa\RsaPublic();
            $enctypter->key = "file://" . Yii::getAlias("@common") . "/connector/scent/rsa/public.pem";
            $data = $enctypter->encrypt($dataText);
            Yii::info("DATA: $data", "encrypt");
            //Private
            //$enctypter = new \common\rsa\RsaPrivate();
            //$enctypter->key = "file://" . Yii::getAlias("@common") . "/connector/vnm/private.pem";
            //$sig = $enctypter->encrypt($data);
            // fetch private key from file and ready it
            //$pkeyid = openssl_pkey_get_private("file://" . Yii::getAlias("@common") . "/connector/scent/sign/private.pem");
            //openssl_sign($data, $sig, $pkeyid);
            //$sig = base64_encode($sig);
            //Yii::info("SIG: $sig", "encrypt");
        } catch (\yii\base\Exception $e) {
            Yii::error($e->getMessage(), 'encrypt');
        }

        return "data=$data";
    }

    //verify chu ky so
    public static function verifySign($data, $sig) {
        try {
            $pubKey = openssl_get_publickey("file://" . Yii::getAlias("@common") . "/connector/scent/sign/public.pem");
            if (openssl_verify($data, base64_decode($sig), $pubKey)) {
                Yii::info("Verify chu ky so thanh cong", "encrypt");
                return 1;
            } else {
                Yii::error("Verify chu ky so that bai", "encrypt");
                return 0;
            }
        } catch (\yii\base\Exception $e) {
            Yii::error($e->getMessage(), 'encrypt');
            return -1;
        }
    }

    //giai ma RSA
    public static function decryptRSA($data) {
        try {
            $privateKey = openssl_get_privatekey("file://" . Yii::getAlias("@common") . "/connector/scent/rsa/private.pem");
            if (openssl_private_decrypt(base64_decode($data), $decrypted, $privateKey)) {
                Yii::info("giai ma RSA thanh cong", "encrypt");
                return $decrypted;
            } else {
                Yii::info("giai ma RSA that bai", "encrypt");
                return null;
            }
        } catch (\yii\base\Exception $e) {
            Yii::error($e->getMessage(), 'encrypt');
            return null;
        }
    }

    //giai ma AES
    public static function decryptAES($decrypted) {
        try {
            $params = explode('&', $decrypted);
            if (count($params) < 2) {
                throw new Exception("invalid decrypted data", 1);
            }
            $value = substr($params[0], strlen('value='));
            $key = substr($params[1], strlen('key='));
            $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($value), MCRYPT_MODE_ECB);
            return $output;
        } catch (\yii\base\Exception $e) {
            Yii::error($e->getMessage(), 'encrypt');
            return null;
        }
    }

}

?>