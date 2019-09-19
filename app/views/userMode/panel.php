{% extends 'user.php' %}
{% block title %}
	<title>User Panel</title>
{% endblock %}
{% block child %}
{% if questions is empty %}
<p>
    No questions!
</p>
{% else %}
            <table>
                <thead class="panel_dashboard_categories">
                <tr>
                        <td>Question</td>
                        <td>Author and date</td>
                        <td>Solution</td>
                </tr>
                </thead>
                <tbody class="panel_dashboard_cell">
                {% for question in questions %}
                <tr>
                    <td>{{ question.question }}</td>
                    <td><p>{{ question.author }} ({{ question.email }})</p><p>{{ question.date_added }}</p></td>
                    <td>
                    <p><i class="fa fa-comment"></i><a class="admins_delete_link" href="/give_a_suggestion/{{ question.id }}"> Give a suggestion</a></p>
                    </td>
                </tr>
                {% endfor %}
                </tbody>
        </table>
    {% endif %}
{% endblock %}