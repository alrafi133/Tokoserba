</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

 <!-- Main Footer -->
 <footer class="main-footer">
   <!-- To the right -->
   <div class="float-right d-none d-sm-inline">
     Radebaiv Shop
   </div>
   <!-- Default to the left -->
   <strong>Copyright &copy; <?php echo date('Y') ?> <span>Kelompok 1</span>.</strong> All rights reserved.
 </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
    window.setTimeout(function() {
      $(".alert").fadeTo(500,0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
</script>

</body>
</html>
