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
		url: baseUrl + "/getAkun",
		method: "GET",
	},
	columns: [{ data: "kode_akun" }, { data: "nama_akun" }],
});
