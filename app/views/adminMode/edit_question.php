{% extends 'admin.php' %}
{% block title %}
	<title>Admin Panel</title>
{% endblock %}
{% block child %}
{% include ('components/error_msg.php') %}
        <div class="edit_question_container">
        {% for question in question_info %}
        <form action="/edit_question/submission" method="POST" class="">
				<input type="hidden" name="id" value="{{ question.id }}">
				<label class="edit_question_label">Question: </label>
            <div class="edit_question_input_div">
                <input type="text" name="question" value="{{ question.question }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Author: </label>
            <div class="edit_question_input_div">
                <input type="text" name="author" value="{{ question.author }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Email: </label>
            <div class="edit_question_input_div">
                <input type="text" name="email" value="{{ question.email }}" class="edit_question_input">
            </div>
				<label class="edit_question_label">Answer: </label>
            <div class="edit_question_input_div">
                <textarea rows="10" cols="45" name="answer" class="edit_question_textarea">{{ question.answer }}</textarea>
            </div><br>
				<input type="radio" name="visibility" value="1" class=""> Publicate the question  <br><br>
				<input type="radio" name="visibility" value="NULL" class=""> No publication<br><br>
				<input type="submit" name="update" value="Update" class="edit_question_submit">
            </form>
            </div>
        {% endfor %}
{% endblock %}