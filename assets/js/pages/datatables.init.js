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
        // Prefer jQuery DataTables if present, otherwise fallback to Simple-DataTables
        try {
            if (window.jQuery && $.fn.DataTable) {
                // merge defaults
                var defaults = { responsive: true };
                var cfg = Object.assign({}, defaults, options || {});
                return $(selector).DataTable(cfg);
            } else if (window.DataTable) {
                return new DataTable(selector, options || {});
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
                targets: 5,
                className: 'priority-column',
                responsivePriority: 1,
                visible: true
            }
        ],
        responsive: true 
    });
    new DataTable('#dataolt', {
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