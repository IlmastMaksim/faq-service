{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
{% endblock %}
{% block child %}
            {% include ('components/error_msg.php') %}
            <table>
                <thead class="panel_dashboard_categories">
                <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Delete</td>
                        <td>Make user</td>
                        <td>Change password</td>
                </tr>
                </thead>
                <tbody class="panel_dashboard_cell">
                {% for admin in admins %}
                <tr>
                    <td>{{admin.id}}</td>
                    <td><p>{{admin.login}}</p></td>
                    <td>{{admin.email}}</td>
                    <td>
                    <p><a href="/admins/delete_admin/{{admin.id}}" class="admins_delete_link"><span class="fa fa-trash"></span> Delete</a></p>
                    </td>
                    <td>
                    <form action="/admins/make_user" method="POST" class="admins_delete_link">
                            <input type="hidden" name="id" value="{{admin.id}}">
                            <input type="hidden" name="login" value="{{admin.login}}">
                            <input type="hidden" name="email" value="{{admin.email}}">
                            <span class="fa fa-user-plus"></span>
                            <input type="submit" name="makeuser" value="Make user" class="users_button_make_admin">	
                        </form>
                    </td>
                    <td>
                    <form action="/admins/change_password" method="POST">
                        <input type="hidden" name="id" value="{{admin.id}}">
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
{% endblock %}