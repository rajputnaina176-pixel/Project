
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher  Form</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
           padding: 40px 30px;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5eb;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-group input:focus {
            border-color: #667eea;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group .icon {
            position: absolute;
            right: 15px;
            top: 43px;
            color: #aaa;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            height: 18px;
            width: 18px;
            accent-color: #667eea;
        }

        .remember-me label {
            color: #555;
            font-size: 14px;
            cursor: pointer;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .form-header h1 {
                font-size: 24px;
            }
            
            .form-group input {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="form-header">
            <h1>Teacher Login</h1>
        </div>
        
        <form action="Admin.php" method="POST">
            <div class="form-group">
                <label for="text">Username</label>
                <input type="text" id="email" name="username" placeholder="Enter the username" required>
                <span class="icon">✉️</span>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                <span class="icon">🔒</span>
            </div>
            
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            
           <input type="submit" name="submit" value="Login"style="font-size:30px; width:100%;height: 50px; border-radius:10px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);color:white;">
        </form>
         
    </div>


</body>
</html>