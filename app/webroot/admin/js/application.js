!function($) {
	$(function() {

		var $window = $(window);

		var debug = false;

		// side bar
		$('.bs-docs-sidenav').affix({
			offset: {
				top: function() {
					return $window.width() <= 980 ? 290: 210;
				},
				bottom: 270
			}
		});

		// make code pretty
		if (window.prettyPrint) {
			prettyPrint();
		}

		$('#calculate').click(function() {
			var strategy = $('#stockStrategy').val();
			var startTime = $('#startTimeInput').val();
			var endTime = $('#endTimeInput').val();
			if (startTime == "") {
				alert("请选择开始时间");
				return false;
			}

			if (endTime == "") {
				alert("请选择结束时间");
				return false;
			}

			if (endTime < startTime) {
				alert("结束时间必须晚于开始时间");
				return false;
			}

			if (debug) {
				var str = "Submit stock: ";
				str += strategy;
				str += " from " + startTime;
				str += " to " + endTime;
				alert(str);
			}

			$('#top-stocks').html("");
			var url = '/stock/calculate?strategy=' + strategy;
			url += '&startTime=' + startTime;
			url += '&endTime=' + endTime;
			$('#load-info').html("<div class='alert alert-error'>Loading...</div>");
			$('#top-stocks').load(url, function() {
				$('#load-info').html("<div class='alert alert-success'>Success...</div>");
			});
			return false;
		});

		$('#startTime').datetimepicker({
			format: 'yyyy-MM-dd',
			language: 'en',
			pickDate: true,
			pickTime: true,
			hourStep: 1,
			minuteStep: 15,
			secondStep: 30,
			inputMask: true
		});
		$('#endTime').datetimepicker({
			format: 'yyyy-MM-dd',
			language: 'en',
			pickDate: true,
			pickTime: true,
			hourStep: 1,
			minuteStep: 15,
			secondStep: 30,
			inputMask: true
		});
	});
} (window.jQuery)

