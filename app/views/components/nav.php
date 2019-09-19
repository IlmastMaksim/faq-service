<div class="topnav" id="myTopnav">
  	{% if session_admin %}
	  	<div class="topnav_container">
			<a href="/panel">Administration</a>
			<a href="/login/logout">Log Out</a>
			<a href="javascript:void(0);" class="icon" onclick="makeResponsive()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		{% elseif session_user %}
		<div class="topnav_container">
			<a href="/panel"></i>Panel</a>
			<a href="/login/logout">Log Out</a>
			<a href="javascript:void(0);" class="icon" onclick="makeResponsive()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		{% else %}
		<div class="topnav_container">
			<a href="/">Home</a>
			<a href="/about">About</a>
			<a href="/login">Log In</a>
			<a href="#contact">Contact</a>
			<a href="javascript:void(0);" class="icon" onclick="makeResponsive()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
	{% endif %}
</div>