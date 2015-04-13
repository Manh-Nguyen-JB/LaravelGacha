<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<table id="gacha-list">
						@foreach($gacha_list as $gacha)
							<tr><td>
								<button gacha-id="{{$gacha['id']}}" type="button" class="btn btn-gacha @if($gacha['id'] == 1) active @endif">
									{{$gacha['name']}}
								</button>
							</tr></td>
						@endforeach
					</table>
					<div id="gacha-content">
						@foreach($gacha_list as $gacha)
							<div id="gacha_info_{{$gacha['id']}}" class="gacha-info" @if($gacha['id'] == 1) style="display: block" @endif>
								<center>
									<h2>{{$gacha['name']}}</h2>
									<button gacha-id="{{$gacha['id']}}" type="button" class="btn btn-draw btn-gacha-validate">Draw</button>
									<table class='probability'>
										<tr><th>Common</th><th>Uncommon</th><th>Rare</th><th>Super Rare</th></tr>
										<tr>
											<td>{{$gacha['rate_common']}}%</td>
											<td>{{$gacha['rate_uncommon']}}%</td>
											<td>{{$gacha['rate_rare']}}%</td>
											<td>{{$gacha['rate_superrare']}}%</td>
										</tr>
									</table>
								</center>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='dialog-box'></div>
<script type="text/javascript">
$(document).ready(function()
{
	$('.btn-gacha').click(function(e) {
		$('[id^=gacha_info_]').hide();
		var current_gacha = '#gacha_info_' + $(this).attr('gacha-id');
		$(current_gacha).show();
	});
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