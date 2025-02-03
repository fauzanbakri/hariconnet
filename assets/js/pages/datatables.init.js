function initializeTables() {
    new DataTable('#example', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        order: [[20, 'desc']],
        columnDefs: [
            {
                targets: 20,
                className: 'priority-column',
                responsivePriority: 1
            }
        ],
        responsive: true 
    });
    new DataTable('#example1', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        order: [[0, 'asc']],
        columnDefs: [
            {
                targets: 14,
                visible: false
            },
            {
                targets: 18,
                className: 'priority-column',
                responsivePriority: 1,
                visible: true
            }
        ],
        responsive: true 
    });
    new DataTable('#datatim', {
        responsive: true 
    });
    new DataTable('#dataolt', {
        responsive: true 
    });
}
document.addEventListener("DOMContentLoaded", function() {
    initializeTables();
});