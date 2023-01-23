<!-- data table -->

<script>
  // $(function() {
  //   $("#example1").DataTable({
  //     "responsive": true,
  //     "lengthChange": false,
  //     "autoWidth": false,
  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });
</script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
<script>
  $(function() {
    $("#example3").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

  });
</script>

<script>
  $(function() {
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

<!-- data table end -->

<script>
  function alphaOnly(evt) {
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

      return false;
    return true;
  }

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      // alert("Please enter only Numbers.");
      return false;
    }
    return true;
  }
</script>

<!-- show hide form and listing -->
<script>
  $('.list_edit_btn').click(function() {
    // $('.show_form_section').trigger('click');
    // $("#form_section").css("display", "block");
  });
</script>

<script>
  $('.show_form_section').click(function() {
    $("#form_section").css("display", "block");
    $("#list_section").css("display", "none");
  });
</script>

<script>
  $('.show_list_section').click(function() {
    $("#form_section").css("display", "none");
    $("#list_section").css("display", "block");
  });
</script>
<!-- show hide form and listing -->