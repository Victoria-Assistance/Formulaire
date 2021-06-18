<?php 
    require_once(__DIR__ . '/vendor/autoload.php');
    use \Mailjet\Resources;
    define('API_PUBLIC_KEY', '71474ad440e0ee5f0859591c9a71ee6e');
    define('API_PRIVATE_KEY', '05ae9ea12d121174ac4c1e538cb75899');
    $mj = new \Mailjet\Client(API_USER, API_LOGIN,true,['version' => 'v3.1']);


    if(!empty($_POST['surname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['message'])){
        $surname = htmlspecialchars($_POST['surname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => "contact@victoria-assistance.com",
                'Name' => "Victoria"
                ]
            ],
                'To' => [
                [
                    'Email' => "contact@victoria-assistance.com",
                    'Name' => "Victoria"
                ]
                ],
                'Subject' => "Demande de renseignement",
                'TextPart' => "$email, $message",     
                'CustomID' => "AppGettingStartedTest"
            ]
            ]
        ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success();
            echo "Email envoyé avec succès !";
        }
        else{
            echo "Email non valide";
        }

    }