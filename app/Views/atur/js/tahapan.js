$("#tabelData").DataTable({
	responsive: true,
	autoWidth: true,
	processing: true,
	ordering: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	ajax: {
		url: baseUrl + "/getTahap",
		method: "GET",
	},
	columns: [
		{ data: "no" },
		{ data: "tahun" },
		{ data: "tahapan" },
		{ data: "ket" },
		{ data: "sts" },
		{ data: "opsi" },
	],
});

//tambah
$("#formAdd").submit(function (e) {
	e.preventDefault();
	var form = $("#formAdd")[0];
	var data = new FormData(form);
	$.ajax({
		method: "POST",
		url: baseUrl + "/tambahTahap",
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
				text: "Data berhasil ditambah",
				button: false,
				timer: 1000,
			});
			$("#formAdd")[0].reset();
			$("#modalAdd").modal("hide");
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

// edit
$("#tabelData").on("click", "#btnEdit", function () {
	let id = $(this).attr("data-id");

	$.ajax({
		url: baseUrl + "/getTahapId",
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
				$('[name="x_tahapan"]').val(data.tahapan);
				$('[name="x_ket"]').val(data.ket);
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
		url: baseUrl + "/editTahap",
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

// Opsi Kunci Tahapan
$("#tabelData").on("click", "#btnKunci", function () {
	let id = $(this).attr("data-id");
	let sts = $(this).attr("data-sts");

	$.ajax({
		method: "POST",
		url: baseUrl + "/editStsTahap",
		data: {
			id: id,
			sts: sts,
			_csrf: tokenValue,
		},
		dataType: "JSON",
		success: function (respon) {
			swal({
				icon: "success",
				title: "Berhasil!",
				text: "Status berhasil diubah",
				button: false,
				timer: 1000,
			});
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
	return false;
});

//Hapus
$("#tabelData").on("click", "#btnHapus", function () {
	swal({
		title: "Anda yakin?",
		text: "Data yang sudah dihapus tidak dapat dikembalikan!",
		icon: "warning",
		buttons: {
			cancel: {
				text: "Batal",
				visible: true,
				closeModal: true,
			},
			confirm: {
				text: "Hapus",
				className: "btn-danger",
				closeModal: true,
			},
		},
	}).then((yes) => {
		if (yes) {
			const id = $(this).attr("data-id");
			$.ajax({
				url: baseUrl + "/hapusTahap",
				method: "POST",
				data: {
					id: id,
					_csrf: tokenValue,
				},
				dataType: "JSON",
				success: function (data) {
					swal({
						icon: "success",
						title: "Sukses!",
						text: "Data berhasil dihapus",
						button: false,
						timer: 1000,
					});
					$("#tabelData").DataTable().ajax.reload();
				},
				error: function (data) {
					swal({
						icon: "error",
						title: "Gagal!",
						text: "Oops.. Terjadi kesalahan, silahkan coba lagi.",
					});
				},
			});
		}
	});
});
