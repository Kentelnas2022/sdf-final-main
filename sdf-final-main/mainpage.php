<?php
// MainPage.php

class MainPage {
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="mainpage.css">
            <title>| Task Master |</title>
        </head>
        <body>
            <div class="banner">
                <div class="navbar">
                    <img src="img/Logo.png" class="logo" height="50vh">
                </div>
            </div>
            
            <div class="content">
                <h1>Take control of your tasks <br>and reclaim your time.</h1>
                <p>TaskMaster - where managing tasks becomes a <br>seamless and rewarding experience.</p>
                <div>
                    <button type="button" onclick="SwitchPage()" id="start"><span></span>Start for Free</button>
                </div>
            </div>
            <script>
                function SwitchPage(){
                    window.location.href = 'reglog.php';
                }
            </script>
        </body>
        </html>
        <?php
    }
}

// Usage:
$mainPage = new MainPage();
$mainPage->render();
?>
