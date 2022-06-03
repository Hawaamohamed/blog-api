
	<!-- jQuery -->
	<script type="text/javascript" src="{{asset('layout/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('layout/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('layout/js/owl.carousel.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('layout/js/jquery.magnific-popup.js')}}"></script>

	<script type="text/javascript" src="{{asset('layout/js/main.js')}}"></script>

    <script type="text/javascript" src="{{asset('layout/js/custom-file-input.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){

   //Links color
   var page = $("div.link_color").data("target");
   $("#nav li ."+page).css({
       "borderBottom":"3px solid #fff",
       "color":"#fff"
   });

              //$(".actions-list").insertAfter(siblings(".actions"));
             $(document).on("click",".actions",function(){
                 $(".actions-list").css("z-index","2");
                 $(this).siblings(".actions-list").toggleClass("hidden").css("z-index","3");

             });
           ///////////////Show list//////////////////
         $(document).on("click",".actions-list ul li", function (){
             var actions = $(this).data("class");
             $(this).parent("ul").parent(".actions-list").siblings("input.actions").val(actions);
             $(".actions-list").addClass("hidden");
         });



         //responses popup
         $(document).on("click", ".response-modal .btn-modal", function(){
             $(this).parent(".modal-footer").parent(".modal-content").parent(".modal-dialog").parent(".response-modal").addClass("hidden");
         });
             $(document).on("click",".button_delete",function(){
                 $("#success-modal .btn-proced").addClass("hidden");
             });


  });

</script>


<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>

</body>


</body>

</html>
