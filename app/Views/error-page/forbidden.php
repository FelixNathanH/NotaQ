<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error/Forbidden</title>
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
    <script src="<?= base_url('asset/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Forbidden',
            text: 'Anda tidak memiliki akses ke halaman ini, silahkan kembali ke halaman sebelumnya',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect back to the previous page
                window.history.back();
            }
        });
    </script>
</body>

</html>