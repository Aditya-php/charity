<div class="content-wrapper">
	<script type="text/javascript">
		// Enable pusher logging - don't include this in production
		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};

		var pusher = new Pusher('a2a3dba956bfcc9c573d', {
  cluster: "ap2"
});
		var channel = pusher.subscribe('support-ticket');

		channel.bind('support-messages', function(data) {
			alert("callsssssssss");
			alert(data.message);
		});
	</script>

	<p id="event">Waiting on event...</p>
	<p>Go to <strong><a href="<?php echo base_url('admin/SupportTicket/trigger_event'); ?>">/example/trigger_event</a></strong> in a new tab to trigger event.</p>
	
</div>
