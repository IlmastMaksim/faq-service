{% include ('components/head.php') %}
<title>User Panel</title>
<body>
{% include ('components/title.php') %}
{% include ('components/nav.php') %}
    <div class="panel_container">
        <div class="panel_menu">
            <ul>
            {% if session_user %}
                <li>Welcome {{   session_user  }}!</li>
            {% endif %}
                <li><i class="fa fa-question-circle"></i><a href="/panel">Questions</a></li>
                <li><i class="fa fa-bullhorn"></i><a style="padding-left: 5px;" href="/ask_question">Ask a Question</a></li>
                <li><i class="fa fa-cogs"></i><a href="/settings">Settings</a></li>
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