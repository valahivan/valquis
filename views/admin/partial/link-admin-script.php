 <script src="<?= BASE_URL ?>public/assets/js/sweetalert.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/jquery/jquery.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/js/adminlte.min.js"></script>
 
 <!-- DataTables  & Plugins -->
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="<?= BASE_URL ?>public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

 <!-- Select 2 -->
 <script src="<?= BASE_URL ?>public/assets/plugins/select2/js/select2.full.min.js"></script>
 <!-- CKeditor -->
 <script src="<?= BASE_URL ?>public/assets/plugins/ckeditor/ckeditor.js"></script>
 <!-- Chart JS -->
 <script src="<?= BASE_URL ?>public/assets/plugins/chartjs/chart.min.js"></script>
 
 <script>
    function changePassword(form) {
        $('.modal-loading').modal('show');
        $('#list-error-password .list-group').html(``);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                var object = $.parseJSON(response);

                if (object.errors) {
                    $('#list-error-password').removeClass('d-none');
                    $.each(object.errors, function (key, error) {
                        $('#list-error-password .list-group').append(`<li>${error}</li>`);
                    });
                }

                if (object.status == 1) {
                    Swal.fire({
                        title: "Success!!",
                        text: object.message.success,
                        icon: "success"
                    });
                    $('.modal-password').modal('hide');
                    $('#list-error-password').addClass('d-none');

                    $('#old_password').val('');
                    $('#password').val('');
                    $('#confirm_password').val('');
                }
                $('.modal-loading').modal('hide');
            }
        });
    }

    function logoutAdmin(element) {
        $('.modal-loading').modal('show');
        $.post(element.attr('action'), function (respone) {
            var object = $.parseJSON(respone);
            if (object.status == 1) {
                window.location.href = 'login-admin-page';
            }
        });
    }

    $(document).ready(function () {
        let activeUrl = window.location.pathname.split('/');

        $('.sidebar .nav-item a').each(function () {
            if ($(this).attr('href') == activeUrl[3]) {
                $(this).addClass('active shadow-none');
            }
        });

        $('.sidebar .nav-treeview a').each(function () {
            if ($(this).attr('href') == activeUrl[3]) {
                $(this).addClass('active');
                $(this).closest('.nav-treeview').parent().addClass('menu-open');
                $(this).closest('.nav-treeview').prev().addClass('active shadow-none');
            }
        });

        const selects = $('.select2bs4');
        selects.each(function () {
            $(this).select2({
                theme: 'bootstrap4'
            });
        });

        $('.form-logout').click(function (e) {
            e.preventDefault();
            logoutAdmin($(this));
        });

        $('.form-password').submit(function (e) {
            e.preventDefault();
            changePassword($(this));
        });
    });
 </script>