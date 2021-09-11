$("#tabelData").DataTable({
	responsive: true,
	autoWidth: true,
	processing: true,
	// ordering: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	ajax: {
		url: baseUrl + "/getUser",
		method: "GET",
	},
	columns: [
		{ data: "no" },
		{ data: "nama" },
		{ data: "username" },
		{ data: "role" },
		{ data: "skpd" },
		{ orderable: false, data: "opsi" },
	],
});

//tambah
$("#formAdd").submit(function (e) {
	e.preventDefault();
	var form = $("#formAdd")[0];
	var data = new FormData(form);
	$.ajax({
		method: "POST",
		url: baseUrl + "/tambahUser",
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
		url: baseUrl + "/getUserId",
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
				$('[name="x_nama"]').val(data.nama_lengkap);
				$('[name="x_user"]').val(data.xusername);
				$('[name="x_role"]').val(data.id_role).trigger("change");
				$('[name="x_skpd"]').val(data.id_skpd).trigger("change");
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
		url: baseUrl + "/editUser",
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
				url: baseUrl + "/hapusUser",
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

//reset password
$("#tabelData").on("click", "#btnReset", function () {
	swal({
		title: "Reset Password?",
		text: "Password user dikembalikan ke default!",
		icon: "warning",
		buttons: {
			cancel: {
				text: "Batal",
				visible: true,
				closeModal: true,
			},
			confirm: {
				text: "Reset",
				className: "btn-danger",
				closeModal: true,
			},
		},
	}).then((yes) => {
		if (yes) {
			const id = $(this).attr("data-id");
			$.ajax({
				url: baseUrl + "/resetPassword",
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
						text: "Password berhasil direset",
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
