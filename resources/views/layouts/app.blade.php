<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
</head>

<body class="bg-light">

    @yield('content')

    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        function showToast(message, type = 'success') {
            const el = document.createElement('div');
            el.className = `toast align-items-center text-white bg-${type} border-0`;
            el.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>`;
            document.getElementById('toastContainer').appendChild(el);
            new bootstrap.Toast(el, {
                delay: 5000
            }).show();
            el.addEventListener('hidden.bs.toast', () => el.remove());
        }

        window.initDataTable = function(selector, options = {}) {
            $(selector).DataTable({
                dom: '<"row mb-2"<"col-md-6"B><"col-md-6"f>>rtip',
                buttons: [{
                        extend: 'csvHtml5',
                        className: 'btn btn-sm btn-outline-success',
                        text: '⬇ CSV'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-outline-success',
                        text: '⬇ Excel'
                    },
                ],
                order: [],
                pageLength: 10,
                ...options,
            });
        };

        @if (session('success'))
            showToast(@json(session('success')), 'success');
        @endif
        @if (session('error'))
            showToast(@json(session('error')), 'danger');
        @endif
    </script>
    @stack('scripts')
</body>

</html>
