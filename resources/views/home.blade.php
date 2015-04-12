<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<table id="gacha-list">
						@foreach($gacha_list as $gacha)
							<tr><td>
								<button gacha-id="{{$gacha['info']['id']}}" type="button" class="btn btn-gacha @if(time()-$gacha['reset_time']<0) disabled @endif">
									{{$gacha['info']['name']}}
								</button>
							</tr></td>
						@endforeach
					</table>
					<div id="gacha-content">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$(".btn-gacha").click(function(e) {
		var url = "{{ url('/gacha/draw') }}" + '/' + $(this).attr('gacha-id');
		$.ajax({
			type: "GET",
			url: url,
			success: function(data)
			{
				console.log(data);	
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