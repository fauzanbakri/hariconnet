function initializeTables() {
    var kabupatenSet = new Set();

    // Ambil data Kabupaten langsung dari tabel sebelum DataTable aktif
    $('#example tbody tr').each(function() {
        var kabupaten = $(this).find('td:eq(11)').text().trim(); // Kolom ke-12 (index 11)
        if (kabupaten) {
            kabupatenSet.add(kabupaten);
        }
    });

    // Tambahkan data ke dropdown
    kabupatenSet.forEach(function(kabupaten) {
        $('#filterKabupaten').append(`<option value="${kabupaten}">${kabupaten}</option>`);
    });

    function createDataTable(selector, options) {
        // ensure the selector exists on the page
        try {
            if (window.jQuery && $(selector).length === 0) return null;
            if (!window.jQuery && typeof document.querySelector === 'function' && !document.querySelector(selector)) return null;
        } catch (e) {
            return null;
        }
        // Prefer jQuery DataTables if present, otherwise fallback to Simple-DataTables
        try {
            if (window.jQuery && (typeof $.fn.DataTable !== 'undefined' || typeof $.fn.dataTable !== 'undefined')) {
                // merge defaults
                var defaults = { responsive: true };
                var cfg = Object.assign({}, defaults, options || {});
                // prefer the newer API if available
                if (typeof $(selector).DataTable === 'function') {
                    try {
                        // avoid reinitialising an already-initialised table
                        if ($.fn.DataTable && $.fn.DataTable.isDataTable && $.fn.DataTable.isDataTable(selector)) {
                            var existing = $(selector).DataTable();
                            try { document.querySelector(selector).dataset.dtInitialized = '1'; } catch(e){}
                            return existing;
                        }
                    } catch (e) {}
                    var dt = $(selector).DataTable(cfg);
                    try { document.querySelector(selector).dataset.dtInitialized = '1'; } catch(e){}
                    return dt;
                }
                // fallback to older dataTable API
                if (typeof $(selector).dataTable === 'function') {
                    try {
                        if ($.fn.dataTable && $.fn.dataTable.isDataTable && $.fn.dataTable.isDataTable(selector)) {
                            var existingOld = $(selector).dataTable();
                            try { document.querySelector(selector).dataset.dtInitialized = '1'; } catch(e){}
                            return existingOld;
                        }
                    } catch (e) {}
                    var dtOld = $(selector).dataTable(cfg);
                    try { document.querySelector(selector).dataset.dtInitialized = '1'; } catch(e){}
                    return dtOld;
                }
                return null;
            } else if (window.DataTable) {
                var dtSimple = new DataTable(selector, options || {});
                try { document.querySelector(selector).dataset.dtInitialized = '1'; } catch(e){}
                return dtSimple;
            } else {
                console.warn('No DataTable implementation found for', selector);
                return null;
            }
        } catch (e) {
            console.error('Failed to initialize datatable for', selector, e);
            return null;
        }
    }

    createDataTable('#tiketclosetable', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        responsive: true 
    });
    createDataTable('#tabelpermohonan', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        columnDefs: [
            {
                targets: 24,
                className: 'priority-column',
                responsivePriority: 1
            }
        ],
        responsive: true 
    });
    createDataTable('#tabelbursa', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        columnDefs: [
            {
                targets: 23,
                className: 'priority-column',
                responsivePriority: 1
            }
        ],
        responsive: true 
    });
    createDataTable('#kakintable', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        columnDefs: [
            {
                targets: 9,
                className: 'priority-column',
                responsivePriority: 1
            }
        ],
        responsive: true 
    });
    createDataTable('#feederclosetable', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        responsive: true 
    });
    // new DataTable('#example', {
    //     lengthMenu: [
    //         [-1, 10, 25, 50],
    //         ['All', 10, 25, 50]
    //     ],
    //     order: [[19, 'desc']],
    //     columnDefs: [
    //         {
    //             targets: 20,
    //             className: 'priority-column',
    //             responsivePriority: 1
    //         },
    //         {
    //             targets: 0,
    //             visible: false
                
    //         },
    //     ],
    //     responsive: true 
    // });
    // new DataTable('#example1', {
    //     lengthMenu: [
    //         [-1, 10, 25, 50],
    //         ['All', 10, 25, 50]
    //     ],
    //     order: [[0, 'asc']],
    //     columnDefs: [
    //         {
    //             targets: 14,
    //             visible: false
    //         },
    //         {
    //             targets: 18,
    //             className: 'priority-column',
    //             responsivePriority: 1,
    //             visible: true
    //         }
    //     ],
    //     responsive: true 
    // });
    createDataTable('#datatim', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        columnDefs: [
            {
                targets: -1,
                className: 'priority-column',
                responsivePriority: 1,
                visible: true
            }
        ],
        responsive: true 
    });
    createDataTable('#dataolt', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        columnDefs: [
            {
                targets: 8,
                className: 'priority-column',
                responsivePriority: 1,
                visible: true
            }
        ],
        responsive: true 
    });
}
document.addEventListener("DOMContentLoaded", function() {
    initializeTables();
});