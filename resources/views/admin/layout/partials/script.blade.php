{{-- <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script> --}}

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="{{asset('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>

	<script>
        // Sidebar
        
        document.getElementById('drop-down').style.display="none";
        document.getElementById('sett-drop-down').style.display="none";

        $(document).ready(function(){
             $("#menu_arrow").click(function(){
                    $("#drop-down").toggle();
            });
            $("#sett-menu_arrow").click(function(){
                    $("#sett-drop-down").toggle();
            });

           });
        // document.getElementById('menu_arrow').addEventListener("click",function(){
        //     document.getElementById('drop-down').style.display="block";


        // });        
    </script>