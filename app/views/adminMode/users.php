{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
{% endblock %}
{% block child %}
{% if users is empty %}
    <p>
        No users!
    </p>
{% else %}
            {% include ('components/error_msg.php') %}
            <table>
                <thead class="panel_dashboard_categories">
                <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Delete</td>
                        <td>Make admin</td>
                        <td>Change password</td>
                </tr>
                </thead>
                <tbody class="panel_dashboard_cell">
                {% for user in users %}
                <tr>
                    <td>{{user.id}}</td>
                    <td><p>{{user.login}}</p></td>
                    <td><p>{{user.email}}</p></td>
                    <td>
                    <p><a href="/users/delete_user/{{user.id}}" class="admins_delete_link"><span class="fa fa-trash"></span> Delete</a></p>
                    </td>
                    <td>
                        <form action="/users/make_admin" method="POST" class="admins_delete_link">
                            <input type="hidden" name="id" value="{{user.id}}">
                            <input type="hidden" name="login" value="{{user.login}}">
                            <input type="hidden" name="email" value="{{user.email}}">
                            <span class="fa fa-user-plus"></span> 
                            <input type="submit" name="makeadmin" value="Make admin" class="users_button_make_admin">	
                        </form>
                    </td>
                    <td>
                    <form action="/users/change_password" method="POST">
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
                </tr>
                {% endfor %}
                </tbody>
        </table>
    {% endif %}
{% endblock %}