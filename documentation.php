<?php

# Variables
$doc_json = file_get_contents("documentation.json");
$doc = json_decode($doc_json, true);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="gh4B9n-1raaD9BtdLzYUVUwTOPQv_0xq5qZ1HgClLM4" />
    <title>pfSense-API - Jared Hendrickson</title>
    <link rel="stylesheet" type="text/css" href="documentation.css">
</head>
<body>
    <img class="logo" src="files/logo.png">
    <div class="content_container">
        <!--DOC HEADER-->
        <br><h1>pfSense-API Documentation</h1>
        <!--INTRO-->
        <div class="border_line"></div>
        <h2>Introduction</h2>
        <p>
            pfSense API is a fast, safe, full-fledged API based on REST architecture.
            This works by leveraging the same PHP functions and processes used by
            pfSense's webConfigurator into API endpoints to create, read, update
            and delete pfSense configurations. All API endpoints enforce input
            validation to prevent invalid configurations from being made.
            Configurations made via API are properly written to the master
            XML configuration and the correct backend configurations are made
            preventing the need for a reboot. All this results in the fastest,
            safest, and easiest way to automate pfSense!
        </p><br>
        <!--INSTALL-->
        <div class="border_line"></div>
        <h2>Installation</h2>
        <p>To install pfSense API, simply run the following command from the pfSense shell:<br></p>
        <div class="cli"><pre>pkg add https://github.com/jaredhendrickson13/pfsense-api/releases/download/v0.0.1/pfSense-2-4-pkg-API-0.0_1.txz</pre></div>
        <p>To uninstall, run the following command:<br></p>
        <div class="cli"><pre>pkg delete pfSense-pkg-API</pre></div>
        <p>
            <i>Note: if you do not have shell access to pfSense, you can still install via the webConfigurator by
                navigating to 'Diagnostics > Command Prompt' and enter the commands there
            </i>
        </p><br>
        <!--REQUIREMENTS-->
        <div class="border_line"></div>
        <h2>Requirements</h2>
        <li>pfSense 2.4.4 or later is supported</li><br>
        <li>pfSense API requires a local user account in pfSense. The same permissions required to make configurations in the webConfigurator are required to make calls to the API endpoints</li><br>
        <li>While not an enforced requirement, it is STRONGLY recommended that you configure pfSense to use HTTPS instead of HTTP. This ensures that login credentials and/or API tokens remain secure in-transit</li><br>
        <br>
        <!--AUTHENTICATION-->
        <div class="border_line"></div>
        <h2>Authentication</h2>
        <p>
            By default, pfSense API uses the same credentials as the webConfigurator. This behavior allows you to
            configure pfSense from the API out of the box, and user passwords may be changed from the API to immediately
            add additional security if needed. Alternatively, you can configure pfSense API to create secure API client
            IDs and tokens for API users. To generate, or delete API keys you can navigate to `System > API` in the UI
            after installation, and change the authentication mode to `API Token`.
        </p><br>
        <!--RESPONSES-->
        <div class="border_line"></div>
        <h2>Response Codes</h2>
        <p>`200 (OK)` : API call succeeded<p>
        <p>`400 (Bad Request)` : An error was found within your requested parameters</p>
        <p>`401 (Unauthorized)` : API client has not completed authentication or authorization successfully</p>
        <p>`403 (Forbidden)` : The API endpoint has refused your call. Commonly due to your access settings found in `System > API`</p>
        <p>`404 (Not found)` : Either the API endpoint or requested data was not found</p>
        <p>`500 (Server error)` : The API endpoint encountered an unexpected error processing your API request</p><br>
        <!--ERRORS-->
        <div class="border_line"></div>
        <h2>Error Codes</h2>
        <p>
            A full list of error codes can be found by navigating to /api/v1/system/api/errors/ after installation. This
            will return JSON data containing each error code and their corresponding error message. No authentication is
            required to view the error code library. This also makes API integration with third-party software easy as
            the API error codes and messages are always just an HTTP call away!
        </p><br>
        <!--REQUESTS-->
        <div class="border_line" style="width: 100%"></div>
        <h1>Requests</h1>
        <?php
        foreach ($doc["request"] as $req) {
            $method_color = ($req["method"] === "POST") ? "#ffba52" : "#bcff82";
            echo PHP_EOL;
            echo '        <div class="api_call_container">'.PHP_EOL;
            echo '            <h3><span style="color:'.$method_color.'">'.$req["method"].'</span> ' . $req["name"] . '</h3>'.PHP_EOL;
            echo '            <p>'.$req["url"].'</p>'.PHP_EOL;
            echo '            <p>'.$req["description"].'</p>'.PHP_EOL;
            echo '            <table class="param_table">'.PHP_EOL;
            echo '              <tr>'.PHP_EOL;
            echo '                  <th>Key</th>'.PHP_EOL;
            echo '                  <th>Value Type</th>'.PHP_EOL;
            echo '                  <th>Description</th>'.PHP_EOL;
            echo '              </tr>'.PHP_EOL;
            foreach ($req["query"] as $qry) {
                echo '               <tr>' . PHP_EOL;
                echo '                    <td>' . $qry["key"] . '</td>' . PHP_EOL;
                echo '                    <td>' . str_replace(["<", ">"], "", $qry["value"]) . '</td>' . PHP_EOL;
                echo '                   <td>' . $qry["description"] . '</td>' . PHP_EOL;
                echo '               </tr>' . PHP_EOL;
            }
            echo '          </table><br>'.PHP_EOL;
            echo '     </div>'.PHP_EOL;
        }
        ?>
    </div>
    <footer>
        <a href="https://github.com/jaredhendrickson13/pfsense-api"><img id="gh_logo" src="files/github_logo.png"></a>
        <p>Copyright &copy; 2020 - Jared Hendrickson</p>
    </footer>
</body>
