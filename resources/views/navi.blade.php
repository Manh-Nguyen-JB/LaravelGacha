<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a id="btn-home" class="navbar-brand">Gacha Game</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="#">Login</a></li>
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
				@else
					<li><a href="#">Gacha</a></li>
					<li><a href="#">Inventory</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a><span id="coin-holder">{{Auth::user()->coin}}</span> Coins</a></li>
							<li><a id="btn-logout">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>

<script type="text/javascript">
$(document).ready(function()
{
	$("#btn-logout").click(function(e){
		var url = "{{ url('/auth/logout') }}";
		$.get(url, function(data, status){
			reloadNavi();
			$('#main-content').html(data);
	    });
	    e.preventDefault();
	});

	setInterval(function(){
		var coins = parseInt($('#coin-holder').text());
		$('#coin-holder').text(coins+1);
	},1000);
});
</script>