<!-- Header -->
<?php include_once "header.php"; ?>

<!-- Container -->
	<main>
		<button id="addFile">+</button>
		<h2>External Files</h2>

	</main>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		(function($){
			var Page = {
				__init 	: function(){
					this.__listen();
				},
				__listen 	: function(){
				
				}
			}

			$(document).ready(function(){
				Page.__init();
			});
		})(jQuery);
	</script>
<!-- Footer -->
<?php include_once "footer.php"; ?>
