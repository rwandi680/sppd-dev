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
		url: baseUrl + "/getKegiatan",
		method: "GET",
	},
	columns: [
		{ data: "urusan" },
		{ data: "nama_bidang" },
		{ data: "nama_program" },
		{ data: "nama_kegiatan" },
	],
});
