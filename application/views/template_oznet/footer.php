<!-- <footer class="main-footer">

</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div> -->




<!-- jQuery -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
    $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>

<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Summernote -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>AdminLTE/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/dist/js/pages/dashboard.js"></script> -->

<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- <script src="<?= base_url('assets/'); ?>AdminLTE/dist/js/demo.js"></script> -->

<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url('assets/'); ?>AdminLTE/plugins/toastr/toastr.min.js"></script>



<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'yyyy-MM-DD'
        });
        $('#reservationdate2').datetimepicker({
            format: 'yyyy-MM-DD'
        });

        $('#reservationdate1').datetimepicker({
            format: 'yyyy-MM-DD'
        });
    });

    $('#reservationdatetime').datetimepicker({
        icons: {
            time: 'far fa-clock'
        }
    });
    $('#reservationdatetime2').datetimepicker({
        icons: {
            time: 'far fa-clock'
        }
    });

    $('#reservationdatetime1').datetimepicker({
        icons: {
            time: 'far fa-clock'
        }
    });
</script>


</body>

</html>