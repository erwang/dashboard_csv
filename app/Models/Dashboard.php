<?php


namespace App\Models;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class Dashboard
{
    public function __construct($slug)
    {
        $passwordLength=substr($slug,-1);
        $fileName = Storage::path(substr($slug,0,-$passwordLength));
        $password = substr($slug,-$passwordLength);
        if(Storage::exists($fileName)){
            $fileContent =  Storage::get($fileName);
            // Storing a string into the variable which
            // needs to be Encrypted
            $simple_string = "Welcome to W3docs\n";

            // Displaying the original string
            echo "Original String: " . $simple_string;

            // Storingthe cipher method
            $ciphering = "AES-128-CTR";

            // Using OpenSSl Encryption method
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options   = 0;

            // Non-NULL Initialization Vector for encryption
            $encryption_iv = '1234567891011121';

            // Storing the encryption key
            $encryption_key = "W3docs";

            // Using openssl_encrypt() function to encrypt the data
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

            // Displaying the encrypted string
            echo "Encrypted String: " . $encryption . "\n";

            // Non-NULL Initialization Vector for decryption
            $decryption_iv = '1234567891011121';

            // Storing the decryption key
            $decryption_key = "W3docs";

            // Using openssl_decrypt() function to decrypt the data
            $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

            // Displaying the decrypted string
            echo "Decrypted String: " . $decryption;
        }else{

        }

    }
}
