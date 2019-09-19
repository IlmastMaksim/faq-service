{% include ('components/head.php') %}
<title>Login</title>
<body>
{% include ('components/title.php') %}
{% include ('components/nav.php') %}
    <div class="login">
			{% include ('components/error_msg.php') %}
            <h2 class="login-header">Sign up</h2>
            <form action='/register/check' method="POST" class="login-container">
                <p><input type="text" placeholder="Username" name="login"   /></p>
                <p><input type="text" placeholder="Email" name="email"   /></p>
                <p><input type="password" placeholder="Password" name="pass"   /></p>
                <p><input type="password" placeholder="Confirm Password" name="pass_2"   /></p>
                <p><input type="submit" value="Submit" name="sign_in" class='login-container-last-child' /></p>
            </form>
    </div>

{% include ('components/footer.php') %}