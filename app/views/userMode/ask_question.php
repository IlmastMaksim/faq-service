{% extends 'user.php' %}
{% block title %}
	<title>User Panel</title>
{% endblock %}
{% block child %}
{% include ('components/error_msg.php') %}
    <div class="ask_question">
            <h2 class="question-header">Ask a Question</h2>
            <form action='/ask_question' method="POST" class="question-container">
            <input type="hidden" name="question_author" value="{{ session_user }}">
                <p><select name="question_category">
                    <option disabled="disabled" selected="selected">Choose category...</option>
                    {% for category in categories %}
                        <option value="{{ category.id }}">{{ category.category }}</option>
                    {% endfor %}
                </select></p>
                <p><input type="text" placeholder="Question" name="question_body"/></p>
                <p><input type="submit" value="Submit" name="question_submit" /></p>
            </form>
    </div>
        {% endblock %}