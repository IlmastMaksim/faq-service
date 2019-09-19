{% extends 'user.php' %}
{% block title %}
	<title>User Panel</title>
{% endblock %}
{% block child %}
                {% include ('components/error_msg.php') %}
                <div class="settings_main">
                    <h1>Settings</h1>
                </div>
                <table>
                <thead class="panel_dashboard_categories">
                <tr>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Password</td>
                </tr>
                </thead>
                <tbody class="panel_dashboard_cell">
                {% for user in user_info %}
                    <td>
                        <form action="/settings/change_username" method="POST">
                            <input type="hidden" name="id" value="{{user.id}}">
                            <p><input type="text" value="{{user.login}}" name="login" class="settings_text"></p>
                            <button type="submit" name="changeusername" class="settings_input">Change</button>
                        </form>
                    </td>
                    <td>
                        <form action="/settings/change_email" method="POST">
                            <input type="hidden" name="id" value="{{user.id}}">
                            <p><input type="email" name="email" value="{{user.email}}" class="settings_text"></p>
                            <button type="submit" name="changeemail" class="settings_input">Change</button>
                        </form>
                    </td>
                    <td>
                        <form action="/settings/change_password" method="POST">
                                <input type="hidden" name="id" value="{{user.id}}">
                                <div>
                                <input type="password" name="old_pass" placeholder="Previous Password" class="old_pass">
                                </div>
                                <div>
                                <input type="password" name="new_pass" placeholder="New Password" class="new_pass">
                                </div>
                                <div>
                                <input type="password" name="confirm_pass" placeholder="Confirm Password" class="new_pass">
                                </div>
                                <input type="submit" name="changepassword" value="Change" class="changepass_submit">	
                        </form>
                    </td>
                    {% endfor %}
                </tbody>
        </table>
{% endblock %}