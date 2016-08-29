<!-- Header -->
<?php include_once "header.php"; ?>

<!-- Container -->
	<main>
		<button id="addTag">+</button>
		<h2>HTML Tags</h2>
		<?php $tags = $model->getAllTags();
			// op($tags);
		?>
		<table >
			<thead>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($tags as $tag) { ?>
				<tr>
					<td><?=$tag['name']; ?></td>
					<td><?=$tag['category']; ?></td>
					<td>
						<a data-id="<?= $tag['id'];?>" class="deleteTag" href="">delete</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>

		<form style="width:200px;" method="post"  class="hidden" action="request.php?m=tags">
			<a href="" class="close right">close</a>
			<br>
			<label>Name
				<input type="text" name="name" required placeholder="tag name"/>	
			</label>
			<br>
			<label>Category
				<select name="category">
					<option value="bootstrap">Bootsrap</option>
					<option value="foundation">Foundation</option>
				</select>
			</label>
			<br>
			<label>Markup
				<textarea  required rows="20" name="markup"></textarea>
			</label>
			<br>
			<input type="submit" value="add"/>
		</form>
	</main>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		(function($){
			var Page = {
				__init 	: function(){
					this.__listen();
				},
				__listen 	: function(){
					$("#addTag").on("click", function(){
						$("table").first().addClass("hidden");
						$("form").first().removeClass("hidden");
						$("h2").first().html("Add New HTML Tag");
					});

					$("form .close").on("click", function(e){
						e.preventDefault();

						$("table").first().removeClass("hidden");
						$("form").first().addClass("hidden");
						$("h2").first().html("HTML Tags");
					});

					$(".deleteTag").on("click", function(e){
						e.preventDefault();

						var me = $(this);
						var id = me.data("id");

						$.ajax({
							url : "request.php?m=addTag",
							data 	: {id:id},
							type : "POST",
							dataType : "JSON",
							success : function(res){
								if(res.success == "1"){
									me.parents("tr").remove();
								}
							},
							error : function(){
								console.log("Oops, something went wrong.");
							}
						});
					});
				}
			}

			$(document).ready(function(){
				Page.__init();
			});
		})(jQuery);
	</script>
<!-- Footer -->
<?php include_once "footer.php"; ?>
