    
        
            </div>
        </div>
            <!-- End of Main Content -->
{{-- 
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Advocate Mail</span>
                    </div>
                </div>
            </footer> --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script> --}}

    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/datepicker.js')}}"></script>
        <script src="{{asset("ckeditor/ckeditor.js")}}"></script>
        

    <script>
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>
    <!-- Page level plugins -->
    {{-- <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
    {{-- <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script> --}}

</body>

</html>