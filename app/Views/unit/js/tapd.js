$("#tabelData").DataTable({
	responsive: true,
	autoWidth: true,
	processing: true,
	ordering: false,
	paging: false,
	info: false,
	searching: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	ajax: {
		url: baseUrl + "/getProfil",
		method: "GET",
	},
	columns: [
		{ data: "uraian" },
		{ data: "alamat" },
		{ data: "kota" },
		{ data: "opsi" },
	],
});

// edit
$("#tabelData").on("click", "#btnEdit", function () {
	let id = $(this).attr("data-id");

	$.ajax({
		url: baseUrl + "/getProfilId",
		method: "POST",
		dataType: "JSON",
		data: {
			id: id,
			_csrf: tokenValue,
		},
		success: function (data) {
			$.each(data, function () {
				$("#modalEdit").modal("show");
				$('[name="id"]').val(id);
				$('[name="uraian"]').val(data.uraian);
				$('[name="alamat"]').val(data.alamat);
				$('[name="kota"]').val(data.kota);
			});
		},
		error: function (data) {
			swal({
				icon: "error",
				title: "Gagal!",
				text: "Oops.. Terjadi kesalahan, silahkan coba lagi.",
			});
		},
	});
	return false;
});

$("#formEdit").submit(function (e) {
	e.preventDefault();
	var form = $("#formEdit")[0];
	var data = new FormData(form);
	$.ajax({
		method: "POST",
		url: baseUrl + "/editProfil",
		enctype: "multipart/form-data",
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		async: false,
		success: function (respon) {
			swal({
				icon: "success",
				title: "Berhasil!",
				text: "Data berhasil diubah",
				button: false,
				timer: 1000,
			});
			$("#formEdit")[0].reset();
			$("#modalEdit").modal("hide");
			$("#tabelData").DataTable().ajax.reload();
		},
		error: function (e) {
			swal({
				icon: "error",
				title: "Gagal!",
				text: "Oops.. Terjadi kesalahan, silahkan coba lagi.",
			});
		},
	});
});

$("#tabelDataTtd").DataTable({
	responsive: true,
	autoWidth: true,
	processing: true,
	ordering: false,
	paging: false,
	info: false,
	searching: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	ajax: {
		url: baseUrl + "/getTtd",
		method: "GET",
	},
	columns: [
		{ data: "nama" },
		{ data: "nip" },
		{ data: "jabatan" },
		{ data: "opsi" },
	],
});

// TTD
$("#tabelDataTtd").on("click", "#btnTambahTtd", function () {
	$("#modalTambahTtd").modal("show");
});

$("#formEdit").submit(function (e) {
	e.preventDefault();
	var form = $("#formEdit")[0];
	var data = new FormData(form);
	$.ajax({
		method: "POST",
		url: baseUrl + "/editProfil",
		enctype: "multipart/form-data",
		data: data,
		contentType: false,
		cache: false,
		processData: false,
		async: false,
		success: function (respon) {
			swal({
				icon: "success",
				title: "Berhasil!",
				text: "Data berhasil diubah",
				button: false,
				timer: 1000,
			});
			$("#formEdit")[0].reset();
			$("#modalEdit").modal("hide");
			$("#tabelData").DataTable().ajax.reload();
		},
		error: function (e) {
			swal({
				icon: "error",
				title: "Gagal!",
				text: "Oops.. Terjadi kesalahan, silahkan coba lagi.",
			});
		},
	});
});
