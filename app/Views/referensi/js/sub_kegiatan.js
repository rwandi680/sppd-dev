$("#tabelData").DataTable({
	filterDropDown: {
        columns: [
            { idx: 0 },
            { idx: 1 },
            { idx: 2 },
            { idx: 3 }
        ],
        bootstrap: true
	},
	responsive: true,
	autoWidth: true,
	processing: true,
	ordering: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	ajax: {
		url: baseUrl + "/getSubKegiatan",
		method: "GET",
	},
	columns: [
		{ data: "urusan" },
		{ data: "nama_bidang" },
		{ data: "nama_program" },
		{ data: "nama_kegiatan" },
		{ data: "nama_sub_kegiatan" },
	],
});
