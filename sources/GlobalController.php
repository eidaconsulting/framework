<?php
class GlobalController {

    protected function sendinblue($name, $email, $subject, $htmlmessage, $textmessage){
        $curl = curl_init();

        $data = [
            'sender' => [
                'name' => 'AOC FINANCE',
                'email' => 'hello@aocfinance.com'
            ],
            'id' => 2,
            'to' => [
                [
                    'name' => $name,
                    'email' => $email
                ],
            ],
            'htmlContent' => $htmlmessage,
            'textContent' => $textmessage,
            'subject' => $subject,
            'templateid' => 2
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "api-key: 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"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890.@*_-(){]}[!|#&';
        $pass = []; //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}

