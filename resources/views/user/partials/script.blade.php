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


 <!-- JavaScript untuk mengganti gambar profil langsung -->
 <script>
     // Fungsi untuk menampilkan gambar yang dipilih ke elemen profil
     document.getElementById('image').addEventListener('change', function(event) {
         if (event.target.files.length > 0) {
             const selectedImage = event.target.files[0];
             const imageUrl = URL.createObjectURL(selectedImage);

             // Simpan hasil perubahan gambar ke elemen profil
             const profileImage = document.querySelector('.profile-image'); // Pastikan Anda memiliki kelas 'profile-image' pada elemen img profil
             profileImage.src = imageUrl;
         }
     });
 </script>

 <script>
     document.getElementById('image').addEventListener('change', function(event) {
         if (event.target.files.length > 0) {
             const selectedImage = event.target.files[0];
             const imageUrl = URL.createObjectURL(selectedImage);
             const profileImage = document.querySelector('.profile-image');

             profileImage.src = imageUrl;
         }
     });

     document.getElementById('save-changes').addEventListener('click', function() {
         const fileInput = document.getElementById('image');
         const image = fileInput.files[0];

         if (image) {
             const formData = new FormData();
             formData.append('image', image);

             // Kirim permintaan AJAX untuk memperbarui gambar profil
             fetch('/update-profile-image', {
                     method: 'POST',
                     body: formData,
                     headers: {
                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
                     },
                 })
                 .then(response => response.json())
                 .then(data => {
                     if (data.success) {
                         // Perbarui sumber gambar profil dengan URL gambar baru
                         const profileImage = document.querySelector('.profile-image');
                         profileImage.src = data.profile_image;
                         alert('Gambar profil berhasil diperbarui.');
                     } else {
                         alert('Gagal memperbarui gambar profil.');
                     }
                 })
                 .catch(error => {
                     console.error(error);
                     alert('Terjadi kesalahan saat memperbarui gambar profil.');
                 });
         }
     });
 </script>


 <!-- untuk menampilkan jam pada review -->
 <script>
     function getServerTime() {
         return $.ajax({
             async: false
         }).getResponseHeader('Date');
     }

     function realtimeClock() {
         var rtClock = new Date();
         // var rtClock = new Date(getServerTime());

         var hours = rtClock.getHours();
         var minutes = rtClock.getMinutes();
         var seconds = rtClock.getSeconds();

         // menampilkan AM PM
         // var amPm = (hours < 12) ? "AM" : "PM";
         // hours = (hours > 12) ? hours - 12 : hours;

         hours = ("0" + hours).slice(-2);
         minutes = ("0" + minutes).slice(-2);
         seconds = ("0" + seconds).slice(-2);

         document.getElementById("clock").innerHTML =
             hours + " : " + minutes + " : " + seconds;
         // + "  " + amPm;
         var jamnya = setTimeout(realtimeClock, 500);
     }
 </script>