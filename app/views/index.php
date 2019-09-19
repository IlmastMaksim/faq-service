{% include ('components/head.php') %}
<title>FAQ-service</title>
<body>
{% include ('components/title.php') %}
{% include ('components/nav.php') %}
<section class="faq">
		<ul class="faq-categories">
		{% for category in categories %}
			<li><a href="#{{category.category}}">{{category.category}}</a></li>
		{% endfor %}
		</ul> 

	<div class="faq-items">
	{% for key,value in questions %}
		<ul id="{{key}}" class="faq-group">
			<li class="faq-title"><h2>{{key}}</h2></li>
			{% for question in value %}
			<li>
				<a class="faq-trigger" href="#0">{{question.question}}</a>
				<div class="faq-content">			
					<p>{{question.answer}}</p>
				</div> 
			</li>
			{% endfor %}
		</ul>
	{% endfor %}
	</div>
	<a href="#0" class="faq-close-panel">Close</a>
</section>

{% include ('components/footer.php') %}