<?php

    require 'vendor/autoload.php';

    $googleAPIKey = 'YOUR_API_KEY_HERE';
    $articleText = 'Cisco, a worldwide leader in IT and networking, is developing a method of confidential group communications based on Blockchain technology, according to a patent application released by the US Patent and Trademark Office (USPTO) March 29.';

    $client = new GuzzleHttp\Client();

    $requestData = [
        'input' =>[
            'text' => $articleText
        ],
        'voice' => [
            'languageCode' => 'en-US',
            'name' => 'en-US-Wavenet-F'
        ],
        'audioConfig' => [
            'audioEncoding' => 'MP3',
            'pitch' => 0.00,
            'speakingRate' => 1.00
        ]
    ];


    try {
        $response = $client->request('POST', 'https://texttospeech.googleapis.com/v1beta1/text:synthesize?key=' . $googleAPIKey, [
            'json' => $requestData
        ]);

    } catch (Exception $e) {
        die('Something went wrong: ' . $e->getMessage());
    }


    $fileData = json_decode($response->getBody()->getContents(), true);
    file_put_contents('tts.mp3', base64_decode($fileData['audioContent']));
