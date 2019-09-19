{% include ('components/head.php') %}
<title>Admin Panel</title>
<body>
{% include ('components/title.php') %}
    <div class="panel_container">
        <div class="panel_menu">
            <ul>
            {% if session_admin %}
                <li>Welcome {{   session_admin  }}!</li>
            {% endif %}
                <li><i class="fa fa-question-circle"></i><a href="/panel">Questions</a></li>
                <li><i class="fa fa-database"></i><a href="/suggestions">Suggestions</a></li>
                <li><i class="fa fa-user"></i><a href="/admins">Admins</a></li>
                <li><i class="fa fa-users"></i><a href="/users">Users</a></li>
                <li><i class="fa fa-list-ol"></i><a style="padding-left: 5px;" href="/categories">Categories</a></li>
                <li><i class="fa fa-sign-out"></i><a href="/login/logout">Log Out</a></li>
            </ul>  
        </div>
        <div class="panel_dashboard">
        {% block child %}
			{% endblock %}
        </div>
<script src="/public/js/lib/jquery-2.1.1.js"></script>
<script src="/public/js/error_message.js"></script> <!-- Resource jQuery -->
</body>
</html>