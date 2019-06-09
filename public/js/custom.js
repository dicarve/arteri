/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 *
 */

$(document).ready(function() {
	var url = $(location).attr("href");
	var segments = url.split("/");

	//console.log(base_url);
	//console.log(site_url);

	$("#tanggal").datepicker({
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
	$("#tgl_pinjam").datepicker({
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
	$("#tgl_haruskembali").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});

	/** Fungsi untuk menghapus data arsip */
	$(".deldata").click(function() {
		var d = $(this).attr("id");
		$("#deliddata").val(d);
	});
	$("#deldatago").on("click", function() {
		$("#fdeldata").submit();
	});
	$("#fdeldata").ajaxForm({ success: deldata });
	function deldata() {
		alert("Data telah sukses dihapus");
		$("#deldata").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk menghapus data sirkulasi arsip */
	$(".sdeldata").click(function() {
		var d = $(this).attr("id");
		$("#deliddata").val(d);
	});
	$("#sdeldatago").on("click", function() {
		$("#fsdeldata").submit();
	});
	$("#fsdeldata").ajaxForm({ success: sdeldata });
	function sdeldata() {
		alert("Data telah sukses dihapus");
		$("#deldata").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk mengembalikan arsip dalam sirkulasi */
	$(".kemdata").click(function() {
		var d = $(this).attr("id");
		$("#kemid").val(d);
	});
	$("#kemarsipgo").on("click", function() {
		$("#fkemarsip").submit();
	});
	$("#fkemarsip").ajaxForm({ success: kembdata });
	function kembdata() {
		alert("Arsip telah sukses dikembalikan");
		$("#arsipkembali").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk menghapus file attachment arsip */
	$("#delfilego").on("click", function() {
		$("#fdelfile").submit();
	});
	$("#fdelfile").ajaxForm({ success: delfile });
	function delfile() {
		alert("File telah sukses dihapus");
		$("#uplodfile").show();
		$("#linkfile").hide();
		$("#delfile").modal("hide");
	}

	/** Fungsi-fungsi terkait dengan data master user aplikasi arsip */
	function reloaduser() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloaduser/",
			cache: false,
			success: function(html) {
				$("#divtabeluser").html(html);
			}
		});
	}
	if ($("#divtabeluser").length > 0) {
		// reloaduser();
	}
	$("#divtabeluser").on("click", ".deluser", function() {
		var d = $(this).attr("id");
		$("#deliduser").val(d);
	});

	$("#delusergo").on("click", function() {
		$("#fdeluser").submit();
	});
	$("#fdeluser").ajaxForm({ success: deluser });
	function deluser() {
		alert("Data telah sukses dihapus");
		reloaduser();
		$("#deluser").modal("hide");
	}
	$("#editusergo").on("click", function() {
		$("#feduser").submit();
	});
	$("#feduser").ajaxForm({ success: eduser });
	function eduser() {
		alert("Data telah sukses disimpan");
		reloaduser();
		$("#feduser")[0].reset();
		$("#edituser").modal("hide");
	}

	$("#addusergo").on("click", function() {
		var d = $("#username").val();
		$.ajax({
			type: "POST",
			url: site_url + "/admin/cekuser/",
			data: "username=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				if (html.msg == "ok") {
					$("#fadduser").submit();
				} else {
					alert("username sudah terpakai!");
				}
			}
		});
	});
	$("#fadduser").ajaxForm({ success: adduser });
	function adduser(responseText, statusText, xhr, $form) {
		var jsonData = JSON.parse(responseText);
		if (jsonData.status == "error" && jsonData.pesan == "PASSWORD_UNMATCH") {
			alert(
				"Password yang anda tuliskan tidak sama dengan konfirmasi password.\nHarap periksa penggunaan huruf besar kecil."
			);
			$("#password, #conf_password").addClass("input-error");
			return false;
		}
		alert("Data telah sukses disimpan");
		reloaduser();
		$("#adduser").modal("hide");
		$("#password, #conf_password").removeClass("input-error");
		$("#fadduser")[0].reset();
	}

	$("#divtabeluser").on("click", ".eduser", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/auser/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#feduser")[0].reset();
				$("#eusername").val(html.username);
				$("#etipe").val(html.tipe);
				$("#eakses_klas").val(html.akses_klas);
				$("#ediduser").val(html.id);
				if (html.akses_modul != "") {
					var akses_modul = jQuery.parseJSON(html.akses_modul);
					if (typeof akses_modul == "object") {
						if (akses_modul.entridata == "on")
							$("#emodul1").prop("checked", true);
						if (akses_modul.sirkulasi == "on")
							$("#emodul2").prop("checked", true);
						if (akses_modul.klasifikasi == "on")
							$("#emodul3").prop("checked", true);
						if (akses_modul.pencipta == "on")
							$("#emodul4").prop("checked", true);
						if (akses_modul.pengolah == "on")
							$("#emodul5").prop("checked", true);
						if (akses_modul.lokasi == "on") $("#emodul6").prop("checked", true);
						if (akses_modul.media == "on") $("#emodul7").prop("checked", true);
						if (akses_modul.user == "on") $("#emodul8").prop("checked", true);
						if (akses_modul.import == "on") $("#emodul9").prop("checked", true);
					}
				}
			}
		});
	});
	//////////////////////
	/////////////////////kode
	function reloadkode() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadkode/",
			cache: false,
			success: function(html) {
				$("#divtabelkode").html(html);
			}
		});
	}
	if ($("#divtabelkode").length > 0) {
		//reloadkode();
	}
	$("#divtabelkode").on("click", ".delkode", function() {
		var d = $(this).attr("id");
		$("#delidkode").val(d);
	});

	$("#delkodego").on("click", function() {
		$("#fdelkode").submit();
	});
	$("#fdelkode").ajaxForm({ success: delkode });
	function delkode() {
		alert("Data telah sukses dihapus");
		reloadkode();
		$("#delkode").modal("hide");
	}
	$("#editkodego").on("click", function() {
		$("#fedkode").submit();
	});
	$("#fedkode").ajaxForm({ success: edkode });
	function edkode() {
		alert("Data telah sukses disimpan");
		reloadkode();
		$("#editkode").modal("hide");
	}

	$("#addkodego").on("click", function() {
		$("#faddkode").submit();
	});
	$("#faddkode").ajaxForm({ success: addkode });
	function addkode() {
		alert("Data telah sukses disimpan");
		reloadkode();
		$("#addkode").modal("hide");
		$("#faddkode")[0].reset();
	}

	$("#divtabelkode").on("click", ".edkode", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/akode/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#ekode").val(html.kode);
				$("#enama").val(html.nama);
				$("#eretensi").val(html.retensi);
				$("#edidkode").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master pencipta arsip */
	function reloadpenc() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadpenc",
			cache: false,
			success: function(html) {
				$("#divtabelpenc").html(html);
			}
		});
	}
	if ($("#divtabelpenc").length > 0) {
		// reloadpenc();
	}
	$("#divtabelpenc").on("click", ".delpenc", function() {
		var d = $(this).attr("id");
		$("#delidpenc").val(d);
	});
	$("#delpencgo").on("click", function() {
		$("#fdelpenc").submit();
	});
	$("#fdelpenc").ajaxForm({ success: delpenc });
	function delpenc() {
		alert("Data telah sukses dihapus");
		$("#delpenc").modal("hide");
		reloadpenc();
	}

	// AJAX untuk edit data pencipta
	$("#editpencgo").on("click", function() {
		$("#fedpenc").submit();
	});
	$("#fedpenc").ajaxForm({ success: edpenc });
	function edpenc() {
		alert("Data telah sukses disimpan");
		$("#editpenc").modal("hide");
		reloadpenc();
	}

	// AJAX untuk tambah data pencipta
	$("#addpencgo").on("click", function() {
		// alert($('#faddpenc').serialize());
		var form = $("#faddpenc");
		$.post(form.attr("action"), form.serialize()).done(addpenc);
	});
	function addpenc(data) {
		alert("Data telah sukses disimpan");
		$("#addpenc").modal("hide");
		$("#faddpenc")[0].reset();
		reloadpenc();
	}

	$("#divtabelpenc").on("click", ".edpenc", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/apenc/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_pencipta);
				$("#edidpenc").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master unit pengolah arsip */
	function reloadpeng() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadpeng",
			cache: false,
			success: function(html) {
				$("#divtabelpeng").html(html);
			}
		});
	}
	if ($("#divtabelpeng").length > 0) {
		// reloadpeng();
	}
	$("#divtabelpeng").on("click", ".delpeng", function() {
		var d = $(this).attr("id");
		$("#delidpeng").val(d);
	});
	$("#delpenggo").on("click", function() {
		$("#fdelpeng").submit();
	});
	$("#fdelpeng").ajaxForm({ success: delpeng });
	function delpeng() {
		alert("Data telah sukses dihapus");
		$("#delpeng").modal("hide");
		reloadpeng();
	}
	$("#editpenggo").on("click", function() {
		$("#fedpeng").submit();
	});
	$("#fedpeng").ajaxForm({ success: edpeng });
	function edpeng() {
		alert("Data telah sukses disimpan");
		$("#editpeng").modal("hide");
		reloadpeng();
	}
	$("#addpenggo").on("click", function() {
		$("#faddpeng").submit();
	});
	$("#faddpeng").ajaxForm({ success: addpeng });
	function addpeng() {
		alert("Data telah sukses disimpan");
		$("#addpeng").modal("hide");
		$("#faddpeng")[0].reset();
		reloadpeng();
	}
	$("#divtabelpeng").on("click", ".edpeng", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/apeng/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_pengolah);
				$("#edidpeng").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master lokasi arsip */
	function reloadlok() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadlok",
			cache: false,
			success: function(html) {
				$("#divtabellok").html(html);
			}
		});
	}
	if ($("#divtabellok").length > 0) {
		// reloadlok();
	}
	$("#divtabellok").on("click", ".dellok", function() {
		var d = $(this).attr("id");
		$("#delidlok").val(d);
	});
	$("#dellokgo").on("click", function() {
		$("#fdellok").submit();
	});
	$("#fdellok").ajaxForm({ success: dellok });
	function dellok() {
		alert("Data telah sukses dihapus");
		$("#dellok").modal("hide");
		reloadlok();
	}
	$("#editlokgo").on("click", function() {
		$("#fedlok").submit();
	});
	$("#fedlok").ajaxForm({ success: edlok });
	function edlok() {
		alert("Data telah sukses disimpan");
		$("#editlok").modal("hide");
		reloadlok();
	}
	$("#addlokgo").on("click", function() {
		$("#faddlok").submit();
	});
	$("#faddlok").ajaxForm({ success: addlok });
	function addlok() {
		alert("Data telah sukses disimpan");
		$("#addlok").modal("hide");
		$("#faddlok")[0].reset();
		reloadlok();
	}
	$("#divtabellok").on("click", ".edlok", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/alok/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_lokasi);
				$("#edidlok").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master media arsip */
	function reloadmed() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadmed",
			cache: false,
			success: function(html) {
				$("#divtabelmed").html(html);
			}
		});
	}
	if ($("#divtabelmed").length > 0) {
		// reloadmed();
	}
	$("#divtabelmed").on("click", ".delmed", function() {
		var d = $(this).attr("id");
		$("#delidmed").val(d);
	});
	$("#delmedgo").on("click", function() {
		$("#fdelmed").submit();
	});
	$("#fdelmed").ajaxForm({ success: delmed });
	function delmed() {
		alert("Data telah sukses dihapus");
		$("#delmed").modal("hide");
		reloadmed();
	}
	$("#editmedgo").on("click", function() {
		$("#fedmed").submit();
	});
	$("#fedmed").ajaxForm({ success: edmed });
	function edmed() {
		alert("Data telah sukses disimpan");
		$("#editmed").modal("hide");
		reloadmed();
	}
	$("#addmedgo").on("click", function() {
		$("#faddmed").submit();
	});
	$("#faddmed").ajaxForm({ success: addmed });
	function addmed() {
		alert("Data telah sukses disimpan");
		$("#addmed").modal("hide");
		$("#faddmed")[0].reset();
		reloadmed();
	}
	$("#divtabelmed").on("click", ".edmed", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/amed/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_media);
				$("#edidmed").val(html.id);
			}
		});
	});

	/** Init plugins dropdown chosen */
	$(".chosen").chosen();

	function formatnumber(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	$(".trigger-submit").on("click", function(e) {
		$("#singlebutton").trigger("click");
	});

	var xhr;
	$("input.xhr").each(function() {
		var obj = $(this);
		obj.autoComplete({
			minChars: 3,
			source: function(term, response) {
				// try { xhr.abort(); } catch(e){}
				xhr = $.getJSON(
					obj.attr("data-xhr") + "/" + term,
					{ q: term },
					function(data) {
						response(data);
					}
				);
			},
			renderItem: function(item, search) {
				// convert ke array
				var arr = Object.keys(item).map(function(k) {
					return item[k];
				});
				return (
					'<div class="autocomplete-suggestion" data-val="' +
					arr[0] +
					'">' +
					arr[0] +
					"</div>"
				);
			}
		});
	});
});
