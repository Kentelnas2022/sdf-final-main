<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reglog.css">
    <title>TaskMaster | Sign up!</title>
</head>
<body>
    <div class="hero">  
        <div class="form-box">
            <div class="button-box">    
                <div id="btn" class="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>

                <?php if(isset($_GET['error'])):?>
                    <p style="color: red; text-align: center;"><?=$_GET['error']; ?></p>
                <?php endif?>
                
            <form action="login_action.php" method="POST" id="login" class="input-group">
                <input type="text" class="input-field" placeholder="Username" name="username">
                <input type="password" class="input-field" placeholder="Enter Password" name="password">
                <button type="submit" class="submit-btn" value="Login">Login</button>
            </form>

            <form action="register_action.php" method="POST" id="register" class="input-group">
                 <input type="text" class="input-field" placeholder="Username" name="username">
                 <input type="email" class="input-field" placeholder="Email" name="email">
                 <input type="password" class="input-field" placeholder="Enter Password" name="password">
                 <input type="password" class="input-field" placeholder="Confirm Password" name="conpass">
                 <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("login"); 
        var y = document.getElementById("register"); 
        var z = document.getElementById("btn"); 

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>
</body>
</html>