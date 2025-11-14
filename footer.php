
							
</body>
</html>
<!-- Aditional Script -->
<script type="text/javascript" src="./assets/js/jquery-1.11.3.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<!-- Pace -->
<script type="text/javascript" src="./assets/plugins/pace/pace.js"></script>
<script type="text/javascript" src="theme/datetime/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="theme/datetime/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Datepicker -->
<script type="text/javascript" src="./assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="./assets/plugins/datepicker/css/bootstrap-datepicker.min.css">
<script type="text/javascript">
	$('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
	    autoclose: 1,
	    todayHighlight: 1,
	    startView: 2,
	    minView: 2,
	    forceParse: 0
    });

	$('.datepicker').datepicker({
	    format: "yyyy/mm/dd",
	    weekStart: 1,
	    todayBtn: "linked",
	    daysOfWeekHighlighted: "0,6",
	    orientation: "bottom right",
	    autoclose: true,
	    todayHighlight: true,
	    toggleActive: true,
	    language: "id"
	});

	window.history.pushState(null, null, window.location.href);
    window.onpopstate = function() {
        window.history.go(1); // Ini akan memaksa browser untuk tetap di halaman yang sekarang
    };

	// mencegah user ketika refresh halaman dan mengirim data yang sama pada halaman yang sama
	if (window.history.replaceState) {
	  window.history.replaceState(null, null, window.location.href);
	}

	if (`<?= $error; ?>` != "") {
		Swal.fire({
		  icon: "warning",
		  title: "Wrong Password !"
		});

	}

	$("#anak_ke").keypress(function (e) {
	    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
  	});

	$("#daribrp_saudara").keypress(function (e) {
	    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
  	});

  	$("#isijuzberapa").keypress(function (e) {
	    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
  	});

  	$("#nomorhpayah").keypress(function (e) {
	    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
  	});

</script>
<!-- Validetta -->
<link rel="stylesheet" type="text/css" href="./assets/plugins/validetta/validetta.min.css">
<script type="text/javascript" src="./assets/plugins/validetta/validetta.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".nmsklhasal").hide();
		$(".isianjuz").hide();
		$(".isiansurah").hide();

		$(".targetasalsekolah" ).on(
			"change", function() {
			if(this.value == "sdmi") {
				$(".nmsklhasal").show();
				$("#asal_sekolah").focus();
			} else {
				$(".nmsklhasal").hide();
			}
		});

		$(".target_tahfidz").on("change", function() {
			if(this.value == "sudahtahfidz") {
				$(".isianjuz").show();
				$(".isiansurah").show();
				$("#isijuzberapa").focus();
			} else {
				$(".isianjuz").hide();
				$(".isiansurah").hide();
				$(".nmsklhasal").hide();
			}
		});

		$('.validetta').validetta({
			showErrorMessages : true,
			display : 'inline', // bubble or inline
			errorTemplateClass : 'validetta-inline',
		});

		$("#swp").click(function(){
            let x = document.getElementById("password_lg");
            if (x.type === "password") {
                $("#icnEye").removeClass("glyphicon-eye-open");
                $("#icnEye").addClass("glyphicon-eye-close");
                $("#text_pw").text('Hide')
                x.type = "text";
            } else {
                x.type = "password";
                $("#icnEye").removeClass("glyphicon-eye-close");
                $("#icnEye").addClass("glyphicon-eye-open");
                $("#text_pw").text('Show')
            }
        });

	});
</script>
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="./assets/plugins/datatables/media/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="./assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').DataTable( {
			"language": {
	            "url": "http://cdn.datatables.net/plug-ins/1.10.11/i18n/Indonesian.json"
	        }
			// "order": [[ 0, "desc" ]]
		} );
		$('#datatable2').DataTable( {
			// "order": [[ 0, "desc" ]]
		} );
	} );
</script>
<!-- Tooltip -->
<script type="text/javascript">
    $('.tooltip').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
</script>
