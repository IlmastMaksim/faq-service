{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
{% endblock %}
{% block child %}
{% if suggestions is empty %}
<p>
  No suggestions!
</p>  
{% else %}
    <table>
        <thead class="panel_dashboard_categories">
        <tr>
                <td>Question</td>
                <td>Author and date</td>
                <td>Category</td>
                <td>Suggestion</td>
                <td>Operations</td>
        </tr>
        </thead>
        <tbody class="panel_dashboard_cell">
        {% for suggestion in suggestions %}
        <tr>
            <td>{{ suggestion.question }}</td>
            <td><p>{{ suggestion.username }} ({{ suggestion.email }})</p><p>{{ suggestion.date }}</p></td>
            <td class="panel_status">
                {{suggestion.category}}
            </td>
            <td>
                {{suggestion.suggestion}}
            </td>
            <td class="panel_actions">
                <p><i class="fa fa-trash"></i><a href="/suggestions/delete_suggestion/{{suggestion.id}}" class='panel_actions_del'> Delete</a></p>
                <p><i class="fa fa-link"></i><a href="/suggestions/publish_suggestion/{{ suggestion.id }}"> Publish</a></p>
            </td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
{% endif %}
        {% endblock %}