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
		url: baseUrl + "/getBidang",
		method: "GET",
	},
	columns: [
		{ data: "urusan" },
		{ data: "kode_bidang" },
		{ data: "nama_bidang" }
	],
});
