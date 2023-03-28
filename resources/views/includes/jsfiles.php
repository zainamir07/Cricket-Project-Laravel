<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.marquee.min.js"></script>
<script src="js/main.js"></script> 

 
<script>
	

// $(".js-marquee-wrapper").on("mouseover", function(e){
// 		$('.js-marquee-wrapper').marquee({
// 		pauseOnHover: true

// 	});
// });

	
</script>
<script type="text/javascript">
	$(document).ready(function() {
	<?php if (checkLogin() == true) { ?>	
	window.setInterval(function(){

        $.ajax({
            url: "getChatCounter.php",
            type: "POST",
            success: function(response) {
                if (response != "" && response != 0) {
                 //  alert(response);
                 $("#counterMsg").show();
                 $("#counterInbox").show();
                 $("#counterMsg").html(response);
                 $("#counterInbox").html(response);


                } else {
                    $("#counterMsg").hide();
                 $("#counterInbox").hide();
                 $("#counterMsg").html("");
                 $("#counterInbox").html("");
                }


            },
            error: function() {
                alert("error");
            }

        });
	}, 5000);
	<?php } ?>
	});
</script>