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
		url: baseUrl + "/getTahun",
		method: "GET",
	},
	columns: [
		{ data: "no" },
		{ data: "tahun" },
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
		url: baseUrl + "/tambahTahun",
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

// Hapus
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
			const thn = $(this).attr("data-id");
			$.ajax({
				url: baseUrl + "/hapusTahun",
				method: "POST",
				data: {
					thn: thn,
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

// edit Status
$("#tabelData").on("click", "#btnEditSts", function () {
	const thn = $(this).attr("data-id");
	const sts = $(this).attr("data-sts");
	$.ajax({
		url: baseUrl + "/editStsTahun",
		method: "POST",
		data: {
			thn: thn,
			sts: sts,
			_csrf: tokenValue,
		},
		dataType: "JSON",
		success: function (data) {
			swal({
				icon: "success",
				title: "Sukses!",
				text: "Data berhasil diubah",
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
});
