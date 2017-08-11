$(document).ready(function () {
	var dir_site = "/arsip/index.php";
	var dir_site2 = "/arsip";
	var cur_dir = window.location.href;
	cur_dir = cur_dir.split('/');

	var url = $(location).attr('href');
	var segments = url.split('/');

	$("#tanggal").datepicker({ maxDate: '0', changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
	////////////////
	$(".deldata").click(function(){
		var d = $(this).attr('id')
		$("#deliddata").val(d);
	});
	$('#deldatago').click(function () {
		$('#fdeldata').submit();
	});
	$('#fdeldata').ajaxForm({ success: deldata });
	function deldata() {
		alert("Data telah sukses dihapus");
		$('#deldata').modal('hide');
		window.location.reload(true);
	}
	////////////////
	$('#delfilego').click(function () {
		$('#fdelfile').submit();
	});
	$('#fdelfile').ajaxForm({ success: delfile });
	function delfile() {
		alert("File telah sukses dihapus");
		$("#uplodfile").show();
		$("#linkfile").hide();
		$('#delfile').modal('hide');
	}
	////////////////user
	function reloaduser() {
		$.ajax({
			type: "POST",
			url: document.location.protocol + "//" + document.location.hostname + "" + dir_site + "/admin/reloaduser/",
			cache: false,
			success: function (html) {
				$("#divtabeluser").html(html);
			}
		});
	}
	$("#divtabeluser").on('click','.deluser',function () {
		var d = $(this).attr("id");
		$("#deliduser").val(d);
	});

	$('#delusergo').click(function () {
		$('#fdeluser').submit();
	});
	$('#fdeluser').ajaxForm({ success: deluser });
	function deluser() {
		alert("Data telah sukses dihapus");
		reloaduser();
		$('#deluser').modal('hide');
	}
	$('#editusergo').click(function () {
		$('#feduser').submit();
	});
	$('#feduser').ajaxForm({ success: eduser });
	function eduser() {
		alert("Data telah sukses disimpan");
		reloaduser();
		$('#edituser').modal('hide');
	}

	$('#addusergo').click(function () {
		$('#fadduser').submit();
	});
	$('#fadduser').ajaxForm({ success: adduser });
	function adduser() {
		alert("Data telah sukses disimpan");
		reloaduser();
		$('#adduser').modal('hide');
		$("#fadduser")[0].reset();
	}

	$("#divtabeluser").on('click','.eduser',(function () {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: document.location.protocol + "//" + document.location.hostname + "" + dir_site + "/admin/auser/",
			data: "id=" + d,
			cache: false,
			success: function (ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#eusername").val(html.username);
				$("#etipe").val(html.tipe);
				$("#ediduser").val(html.id);
			}
		})
	}));
	//////////////////////
	/////////////////////kode
	function reloadkode() {
		$.ajax({
			type: "POST",
			url: document.location.protocol + "//" + document.location.hostname + "" + dir_site + "/admin/reloadkode/",
			cache: false,
			success: function (html) {
				$("#divtabelkode").html(html);
			}
		});
	}
	$("#divtabelkode").on('click','.delkode',function () {
		var d = $(this).attr("id");
		$("#delidkode").val(d);
	});

	$('#delkodego').click(function () {
		$('#fdelkode').submit();
	});
	$('#fdelkode').ajaxForm({ success: delkode });
	function delkode() {
		alert("Data telah sukses dihapus");
		reloadkode();
		$('#delkode').modal('hide');
	}
	$('#editkodego').click(function () {
		$('#fedkode').submit();
	});
	$('#fedkode').ajaxForm({ success: edkode });
	function edkode() {
		alert("Data telah sukses disimpan");
		reloadkode();
		$('#editkode').modal('hide');
	}

	$('#addkodego').click(function () {
		$('#faddkode').submit();
	});
	$('#faddkode').ajaxForm({ success: addkode });
	function addkode() {
		alert("Data telah sukses disimpan");
		reloadkode();
		$('#addkode').modal('hide');
		$("#faddkode")[0].reset();
	}

	$("#divtabelkode").on('click','.edkode',(function () {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: document.location.protocol + "//" + document.location.hostname + "" + dir_site + "/admin/akode/",
			data: "id=" + d,
			cache: false,
			success: function (ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#ekode").val(html.kode);
				$("#enama").val(html.nama);
				$("#eretensi").val(html.retensi);
				$("#edidkode").val(html.id);
			}
		})
	}));
	//////////////////////
	function formatnumber(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
});
