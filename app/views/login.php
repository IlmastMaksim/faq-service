{% include ('components/head.php') %}
<title>Login</title>
<body>
{% include ('components/title.php') %}
{% include ('components/nav.php') %}
    <div class="login">
			{% include ('components/error_msg.php') %}
            <h2 class="login-header">Log in</h2>
            <form action='/login/check' method="POST" id="loginform" class="login-container">
                <p><input type="text" id="login" placeholder="Username" name="login"   /></p>
                <p><input type="password" id="password" placeholder="Password" name="pass"   /></p>
                <p><input type="submit" value="Submit" id="submit" class='login-container-last-child' name="sign_in" /></p>
                <p class="login_as_admin">Log in as <a href="/login_admin"><span>admin</span></a> or <a href="/register"><span>register</span></a>?</p>
            </form>
    </div>
{% include ('components/footer.php') %}