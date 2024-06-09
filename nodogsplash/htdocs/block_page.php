<?php

function save_log($data)
{
    $fp = fopen('logdns.txt', 'a');
    fwrite($fp, json_encode($data) . "\n");
    fclose($fp);
}
$time = date('Y-m-d H:i:s');
$domain = $_SERVER['HTTP_HOST'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] != 'GET') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Bạn đang truy cập vào trang web bị chặn bởi DNS QUANHD, nếu bạn cần trợ giúp về tên miền này, vui lòng liên hệ với tôi qua Facebook: Hứa Đức Quân', 'domain' => $_SERVER['HTTP_HOST'], 'ip' => $_SERVER['REMOTE_ADDR'], 'path' => $_SERVER['REQUEST_URI'], 'facebook' => 'https://www.facebook.com/quancp72h', 'time' => $time], JSON_PRETTY_PRINT);
    save_log(['domain' => $_SERVER['HTTP_HOST'], 'ip' => $_SERVER['REMOTE_ADDR'], 'path' => $_SERVER['REQUEST_URI'], 'method' => 'POST/OTHER', 'time' => $time]);
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truy cập tên miền bị chặn</title>
    <link rel="icon" href="path_to_your_icon.ico" type="image/x-icon">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
            transition: background-color 0.5s, color 0.5s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #333;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #666;
        }

        img {
            width: 120px;
            border-radius: 50%;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        #p1 {
            cursor: pointer;
            border: 1px solid #ddd;
            padding: 10px;
            display: inline-block;
            margin: 10px 0;
            transition: background-color 0.3s, color 0.3s;
        }

        #p1:hover {
            background-color: #ddd;
            color: #333;
        }

        .highlight {
            color: #FF6347;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #333;
                color: #ddd;
            }

            h1 {
                color: #FF6A6A;
            }

            p {
                color: #ddd;
            }

            #p1 {
                border-color: #ddd;
            }

            #p1:hover {
                background-color: #444;
            }

            .highlight {
                color: #FF6347;
            }

            a {
                color: #80bdff;
            }

            a:hover {
                color: #007BFF;
            }
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>
    <?php
    save_log(['domain' => $domain, 'ip' => $_SERVER['REMOTE_ADDR'], 'path' => $_SERVER['REQUEST_URI'], 'method' => 'GET', 'time' => $time]);
    ?>
    <img src="https://cdn1.iconfinder.com/data/icons/website-and-browser/100/web_page_website_browser-15-512.png" alt="Your Image">
    <h1>Truy cập tên miền bị chặn bởi DNS QUANHD</h1>
    <p>Xin lỗi, nhưng tên miền <span class="highlight">"<?= $domain ?>"</span> đã bị chặn bởi <span class="highlight">DNS QUANHD</span> để đảm bảo an toàn cho người dùng, nếu bạn cần trợ giúp về tên miền này, vui lòng liên hệ với tôi qua Facebook: <a href="https://www.facebook.com/quancp72h">Hứa Đức Quân</a></p>
    <p id="p1" onclick="myFunction()">Bạn đang truy cập từ:
        <?php
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo $url;
        ?>
    </p>

    <p id="p2">Trình duyệt của bạn:
        <?php
        $browser = get_browser(null, true);
        echo $browser['browser'] . ' version ' . $browser['version'];
        ?>
    </p>

    <p id="p3">Hệ điều hành của bạn:
        <?php
        echo $browser['platform'];
        ?>
    </p>

    <p id="p4">IP của bạn:
        <?php
        echo $_SERVER['REMOTE_ADDR'];
        ?>
    </p>

    <script>
        function myFunction() {
            var copyText = document.getElementById("p1");

            var range = document.createRange();
            range.selectNode(copyText);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

            document.execCommand("copy");

            alert("Copied the text: " + copyText.textContent);
        }
    </script>
</body>

</html>