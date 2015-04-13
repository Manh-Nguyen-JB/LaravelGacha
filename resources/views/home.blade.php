<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<center>
						<ul>
							@foreach($gacha_list as $gacha)
							<li><div gacha-id="{{$gacha['id']}}" class="btn-gacha-validate" id="gacha-{{$gacha['id']}}">
								<div class="overlay"></div></div><h3>{{$gacha['name']}}</h3></li>
							@endforeach
						</ul>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='dialog-box'></div>
<script type="text/javascript">
$(document).ready(function()
{
	$(".btn-gacha-validate").click(function(e) {
		var url = "{{ url('/gacha/validate') }}" + '/' + $(this).attr('gacha-id');
		$.ajax({
			type: "GET",
			url: url,
			success: function(data)
			{
				$('#dialog-box').html(data);
				$('#dialog-box').show();
			},
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	            console.log($.parseJSON(jqXHR.responseText));    
	        }
		});
		e.preventDefault();
	});
});
</script>