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
		{ data: "kepala" },
		{ data: "nip" },
		{ data: "jabatan" },
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
				$('[name="nama_kepala"]').val(data.kepala);
				$('[name="nip"]').val(data.nip);
				$('[name="jabatan"][value="' + data.jabatan + '"]').prop(
					"checked",
					true
				);
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
