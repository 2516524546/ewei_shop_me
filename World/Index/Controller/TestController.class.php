<?php
namespace Index\Controller;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Think\Controller;
class TestController extends CommonController {

    public function login(){
        $fb = new Facebook([
            'app_id' => '213750755890819', // Replace {app-id} with your app id
            'app_secret' => '76c3fe7dac901b5f4199159d3e65f4bd',
            'default_graph_version' => 'v2.8',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $url = htmlspecialchars('newworld.bofanchina.com/index.php?m=Index&c=Test&a=login_callback');
        $loginUrl = $helper->getLoginUrl($url, $permissions);
        var_dump(htmlspecialchars($loginUrl));
        $nurl = 'https://www.facebook.com/v2.8/dialog/oauth?client_id=213750755890819&state=d14512e36b08d1dc894387f71458b45a&response_type=code&sdk=php-sdk-5.6.3&redirect_uri=https://newworld.bofanchina.com/index.php?m=Index&c=Test&a=login_callback&scope=email';
        echo '<a href="' . htmlspecialchars($nurl) . '">Login with Facebook!</a>';
    }


    public function login_callback(){
        $fb = new Facebook([
            'app_id' => '213750755890819', // Replace {app-id} with your app id
            'app_secret' => '76c3fe7dac901b5f4199159d3e65f4bd',
            'default_graph_version' => 'v2.8',
        ]);

        $helper = $fb->getJavaScriptHelper();

        try {
            var_dump($helper);
            echo 'https://graph.facebook.com/oauth/access_token?client_id=213750755890819&redirect_uri=newworld.bofanchina.com&client_secret=76c3fe7dac901b5f4199159d3e65f4bd&code=AQDbpnMKUoo399z5WsQAxmu4EfTVe3rAzxyXPeLh94nnyAR868-Xu_enicSa22WRULKLMzYa0LV1VeQrjsupUgkLfodDqcayttHADTH58ugyKSzgxIq9HqfMQeZQTqHnbJYDCNxhU_f9AANwbiEuXCjAWkAMD8ohKLCCVXqPj0dmS5Z1b4Il_-6XM8RyZ3AnYDckviH8TfUFjNhstltJKagcVjDPoTAn-w9biYL3wwN_YUm5iu8UzRRWk13NF0wconpd7I4pphKN3oDm5-JsbhRrTtKPkBS0KQM7wEVPRQ4QLkwnpuPaYMIfiHPcawCIgOdrhpOMrMrTfKgNP-sBAKIS';
            $accessToken = $helper->getAccessToken();

        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

// Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(213750755890819); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;
    }

    public function testht(){


        $this->display();
    }


}