{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
{% endblock %}
{% block child %}
        <div class="edit_question_container">
        {% for suggestion in suggestion_info %}
        <form action="/editSuggestion/check/{{ suggestion.id }}" method="POST" class="">
				<input type="hidden" name="id" value="{{ suggestion.id }}">
				<label class="edit_question_label">Question: </label>
            <div class="edit_question_input_div">
                <input type="text" name="question" value="{{ suggestion.question }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Author: </label>
            <div class="edit_question_input_div">
                <input type="text" name="username" value="{{ suggestion.username }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Email: </label>
            <div class="edit_question_input_div">
                <input type="text" name="email" value="{{ suggestion.email }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Suggestion: </label>
            <div class="edit_question_input_div">
                <textarea rows="10" cols="45" name="suggestion" class="edit_question_textarea">{{ suggestion.suggestion }}</textarea>
            </div><br>
				<input type="submit" name="update" value="Update" class="edit_question_submit">
            </form>
            </div>
        {% endfor %}
{% endblock %}