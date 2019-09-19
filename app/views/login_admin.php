{% include ('components/head.php') %}
<title>Login</title>
<body>
{% include ('components/title.php') %}
{% include ('components/nav.php') %}
    <div class="login">
        {% include ('components/error_msg.php') %}
        <h2 class="login-header">Log in as admin</h2>
        <form action='/login_admin/check' method="POST" class="login-container">
            <p><input type="text" placeholder="Username" name="login"   /></p>
            <p><input type="password" placeholder="Password" name="pass"   /></p>
            <p><input type="submit" value="Submit" name="sign_in" class='login-container-last-child' /></p>
        </form>
    </div>

{% include ('components/footer.php') %}