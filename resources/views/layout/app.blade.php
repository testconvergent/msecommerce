<!DOCTYPE html>
<html> 
<!-- Mirrored from moltran.coderthemes.com/dark_2/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Feb 2016 12:27:31 GMT -->
<head>
<base href="{{url('to/')}}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
	<!--style-->
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all"/>
    <link href="css/responsive.css" type="text/css" rel="stylesheet" media="all"/>
    <!--bootstrape-->
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all"/>
    <!--font-awesome-->
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all"/>
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
    <!-- Owl Stylesheets -->
    <!--<link rel="stylesheet" href="css/docs.theme.min.css">-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>    
	<!-- Owl javascript -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/owl.carousel.js"></script>
	<!--mega_menu_js-->
	<script src="js/pinterest_grid.js"></script>
	<script>
			$(document).ready(function() {
			  var owl = $('.owl-carousel');
			  owl.owlCarousel({
				margin: 10,
				nav: true,
				loop: true,
				responsive: {
				  0: {
					items: 1
				  },
				  450: {
					items: 2
				  },
				  650: {
					items: 3
				  },
				  992: {
					items: 4
				  },
				  1200: {
					items: 5
				  },
				}
			  })
			})
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			/* Menu Start */
			$('#sm').mouseover(function(){
				$(this).show();
			});
			$('#sm').mouseout(function(){
				$(this).hide();
			});
			
			$('#m1').mouseover(function(){
				$('.all_menu').show();
				$('').hide();
				$('#sm').show();
				$('.all_menu').pinterest_grid({
					no_columns: 4,
					padding_x: 10,
					padding_y: 10,
					margin_bottom: 50,
					single_column_breakpoint: 700
				});
			});
			
			
			$('#m1, #m2 ').mouseleave(function(){
				$('#sm').hide();
				$('#sm1, #sm2').hide();
			});
			/* Menu Start */
		});
	</script>
	<script>
	$(document).ready(function(){
		$(".sign_ffrr").mouseenter(function(){
			$(".drop_for_signup2").show();
		});
		$(".drop_for_signup2").mouseleave(function(){
			$(".drop_for_signup2").hide();
		});
	});
	</script>
	<script>
$(document).ready(function(){
    $(".menu_dash").mouseenter(function(){
        $(".dropdown_dash").slideDown();
    });
	$(".dropdown_dash").mouseleave(function(){
		$(".dropdown_dash").slideUp();
	});
});
</script> 
	<style>
		#blog-landing {
			position: absolute;
			max-width: 1170px;
			width: 100%;
			top:42px;
		}
	</style>
</head>
		<body>
			@section('body')
			@show
		</body>
</html>