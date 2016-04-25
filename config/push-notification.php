<?php

return array(

    'appNameIOS'     => array(
        'environment' => 'production',   //'development',  // 'production'
        'certificate'=> 'ckProd.pem',  // 'ck.pem',    // 'ckProd.pem',
        'passPhrase'  =>'networth',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production', 
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);