<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">

					<div id="alert-login" class="alert alert-danger" style="display: none;"></div>

					<form id="login-form" class="form-horizontal" role="form" method="POST">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	function alretLogin(errors){
		var htmlText = '<strong>Whoops!</strong> There were some problems with your input.<br><br>';
		htmlText += '<ul>';
		$.each(errors, function(index, value){
		    htmlText += '<li>' + index + ': ' + value + '</li>';
		});
		htmlText += '</ul>';
		$('#alert-login').html(htmlText);
		$('#alert-login').show();
	}

	$("#login-form").submit(function(e) {
		var url = "{{ url('/auth/login') }}";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#login-form").serialize(),
			success: function(data)
			{
				if(typeof data.failed !== 'string'){
					$('#main-content').html(data);
					reloadNavi();
				}else{
					alretLogin({'email': data.failed});
				}
				
			},
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	            alretLogin($.parseJSON(jqXHR.responseText));    
	        }
		});
		e.preventDefault();
	});
});
</script>
