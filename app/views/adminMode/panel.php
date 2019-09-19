{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
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
                        <td>Category</td>
                        <td>Status</td>
                        <td>Operations</td>
                </tr>
                </thead>
                <tbody class="panel_dashboard_cell">
                {% for question in questions %}
                <tr>
                    <td>{{ question.question }}</td>
                    <td><p>{{ question.author }} ({{ question.email }})</p><p>{{ question.date_added }}</p></td>
                    <td>
                        <p>{{ question.category }}</p>
                        <form action="/panel/change_category" method="POST" class="panel_dashboard_form">
                            <input type="hidden" name="id" value="{{question.id}}" />
                            <select name="category_id" class="panel_dashboard_select">
                                {% for category in categories %}
                                <option value="{{ category.id }}">{{ category.category }}</option>
                                {% endfor %}
                            </select>
                            <button type="submit" name="changecategory" class="panel_dashboard_select_sub"><i class="fa fa-check"></i></button>
                        </form>
                    </td>
                    <td class="panel_status">
                    {% if question.answer is null and question.visibility is null %}
                        <p>Waiting for response</p>
                        <p>(not published)</p>
                    {% endif %}
                    {% if question.answer and question.visibility is null %}
                        <p>Not published</p>
                        <p>(response given)</p>
                    {% endif %}
                    {% if question.answer and question.visibility %}
                        <p>Published</p>
                        <p>(response given)</p>
                    {% endif %}
                    </td>
                    <td class="panel_actions">
                        <p><i class="fa fa-trash"></i><a href="/panel/delete_question/{{question.id}}" class='panel_actions_del'> Delete</a></p>
                        <p><i class="fa fa-pencil"></i><a href="/edit_question/{{ question.id }}"> Edit</a></p>
                        {% if question.visibility %}
                        <p><i class="fa fa-unlink"></i><a href="/panel/dispublish_question/{{ question.id }}"> Take off publication</a></p>                            
                        {% endif %}
                        {% if question.visibility is null %}
                        <p><i class="fa fa-link"></i><a href="/panel/publish_question/{{ question.id }}"> Publish question</a></p>
                        {% endif %}
                    </td>
                </tr>
                {% endfor %}
                </tbody>
        </table>
    {% endif %}
{% endblock %}