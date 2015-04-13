<center>
	<h2>{{$gacha['info']['name']}}</h2>
	<table style="margin-bottom: 10px;">
	<tr><th>
		Free 1 time/ {{$gacha['info']['reset_period']/(60*60)}}h. 
		@if($gacha['countdown'] < 0)
			Can draw for free now. 
		@else
			Will reset at {{$gacha['formated_reset_time']}} 
		@endif
	</th></tr>
	<tr><td>
		<center><img src="image/item0.jpg"></br></center>
	</td></tr>
	</table>

	<button id="cancel_gacha" style="width: 150px;" type="button" class="btn btn-danger">Cancel</button>
	<button id="draw_gacha" style="width: 150px;" type="button" class="btn btn-success 
	@if($gacha['countdown'] < 0 && Auth::user()->coin < $gacha['info']['price']) .disabled @endif">
		@if($gacha['countdown'] < 0) Draw @else Pay {{$gacha['info']['price']}} Coins @endif
	</button>
	
</center>

<script type="text/javascript">
$(document).ready(function()
{
	@if($gacha['countdown'] >= 0 || Auth::user()->coin >= $gacha['info']['price'])
		$("#draw_gacha").click(function(e) {
			var url = "{{ url('/gacha/draw') }}/{{$gacha['info']['id']}}";
			$.ajax({
				type: "POST",
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
	@endif
	$('#cancel_gacha').click(function(e) {
		$('#dialog-box').hide();
		$('#dialog-box').html('');
	});
});
</script>