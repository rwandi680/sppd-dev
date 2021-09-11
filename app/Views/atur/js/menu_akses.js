const table = $("#tabelData").DataTable({
	responsive: true,
	autoWidth: true,
	processing: true,
	ordering: false,
	lengthMenu: [
		[20, 50, 100, -1],
		[20, 50, 100, "All"],
	],
	columns: [
		{ data: "no" },
		{ data: "menu" },
		{ data: "sub" },
		{ data: "link" },
		{ data: "ket" },
		{ data: "opsi" },
	],
});

$("#role").change(function () {
	let id = $(this).val();
	if (id != 0) {
		let getData = baseUrl + "/getMenuAkses/" + id;
		table.ajax.url(getData).load();
	}
});
