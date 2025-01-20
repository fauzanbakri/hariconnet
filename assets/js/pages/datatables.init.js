function initializeTables() {
    new DataTable('#example', {
        lengthMenu: [
            [-1, 10, 25, 50],
            ['All', 10, 25, 50]
        ],
        order: [[18, 'desc']],
        columnDefs: [
            {
                targets: 14,
                visible: true
            },
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
        order: [[18, 'desc']],
        columnDefs: [
            {
                targets: 14,
                visible: false
            }
        ],
        responsive: true 
    });
}
document.addEventListener("DOMContentLoaded", function() {
    initializeTables();
});