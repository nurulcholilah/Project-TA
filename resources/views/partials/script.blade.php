 <!-- Bootstrap JS -->
 <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
 <!--plugins-->
 <script src="{{ url('assets/js/jquery.min.js') }}"></script>
 <script src="{{ url('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
 <script src="{{ url('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
 <script src="{{ url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
 <!--app JS-->
 <script src="{{ url('assets/js/app.js') }}"></script>
 <!-- datatable -->
 <script src="{{ url('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ url('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
 <script src="{{ url('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
 <script src="{{ url('assets/js/widgets.js')}}"></script>
 <!-- Date Picker -->
 <script src="{{ url('assets/plugins/datetimepicker/js/legacy.js')}}"></script>
 <script src="{{ url('assets/plugins/datetimepicker/js/picker.js')}}"></script>
 <script src="{{ url('assets/plugins/datetimepicker/js/picker.time.js')}}"></script>
 <script src="{{ url('assets/plugins/datetimepicker/js/picker.date.js')}}"></script>
 <script src="{{ url('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
 <script src="{{ url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}"></script>
 <script>
     $('.datepicker').pickadate({
             selectMonths: true,
             selectYears: true
         }),
         $('.timepicker').pickatime()
 </script>
 <script>
     $(function() {
         $('#date-time').bootstrapMaterialDatePicker({
             format: 'YYYY-MM-DD HH:mm'
         });
         $('#date').bootstrapMaterialDatePicker({
             time: false
         });
         $('#time').bootstrapMaterialDatePicker({
             date: false,
             format: 'HH:mm'
         });
     });
 </script>

 <!-- script untuk pencarian -->
 <script>
     $(document).ready(function() {
         $('#example').DataTable();
     });
 </script>

 <script>
     $(document).ready(function() {
         var table = $('#example2').DataTable({
             lengthChange: false,
             buttons: ['copy', 'excel', 'pdf', 'print']
         });

         table.buttons().container()
             .appendTo('#example2_wrapper .col-md-6:eq(0)');
     });
 </script>

 <!-- deskripsi -->
 <script>
     function showFullDescription(button) {
         const td = button.parentElement;
         td.style.whiteSpace = "normal";
         button.style.display = "none";
     }
 </script>

 <!--Password show & hide js -->
 <script>
     $(document).ready(function() {
         $("#show_hide_password a").on('click', function(event) {
             event.preventDefault();
             if ($('#show_hide_password input').attr("type") == "text") {
                 $('#show_hide_password input').attr('type', 'password');
                 $('#show_hide_password i').addClass("bx-hide");
                 $('#show_hide_password i').removeClass("bx-show");
             } else if ($('#show_hide_password input').attr("type") == "password") {
                 $('#show_hide_password input').attr('type', 'text');
                 $('#show_hide_password i').removeClass("bx-hide");
                 $('#show_hide_password i').addClass("bx-show");
             }
         });
     });
 </script>


 <!-- single select -->
 <script src="assets/plugins/select2/js/select2.min.js"></script>
 <script>
     $('.single-select').select2({
         theme: 'bootstrap4',
         width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
         placeholder: $(this).data('placeholder'),
         allowClear: Boolean($(this).data('allow-clear')),
     });
 </script>