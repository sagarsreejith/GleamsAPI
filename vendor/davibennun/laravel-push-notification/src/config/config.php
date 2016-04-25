<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'production',
        'certificate' =>app_path().'/pushCertificate/Gleam_pro.pem',
        'passPhrase'  =>'gleam',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);