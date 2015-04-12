<script type="text/javascript">
$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}'
	 	}
	});

	function reloadNavi(){
		var url = "{{ url('/navi-bar') }}";
		$.get(url, function(data, status){
			$('#navi-bar').html(data);
	    });
	};
});
</script>
