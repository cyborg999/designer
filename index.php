<!-- Header -->
<?php include_once "header.php"; ?>
<style type="text/css">
	#all-tags {
		padding: 5px;
	}
	#all-tags .tag {
		margin-bottom: 20px;
		border-bottom: 1px solid #f7f7f7;
		position: relative;
		padding: 3px;
	}

	#all-tags .tag .tag-name {
		position: absolute;
		left: -5px;
		top: 6px;
		background: black;
		color: white;
		font-style: italic;
		font-size: 10px;
		padding: 2px;
	}
	#all-tags .row {
		width: 50%;
		border:1px dashed orange;
		margin:auto;
		padding: 20px;
	}
	#all-tags .container-fluid, 
	#all-tags .container {
		border : 1px dashed red;
		max-width: 100%!important;
		padding: 20px;
	}
</style>
<!-- Container -->
	<main>

		<section id="workspace" class="layout">

		</section>
		<aside id="tags">
		<button>view layout</button>
		<br>
		<?php $categories = $model->getCategories(); ?>
			<label>category
				<select id="categories">
					<?php foreach($categories as $category){ ?>
						<option value="<?= $category['category'];?>"><?= $category['category'];?></option>
					<?php } ?>
					<option value="foun">found</option>
				</select>
			</label>

			<?php $tags = $model->getTagByCategory($categories[0]['category']); ?>
			<input type="text" id="tagSearch" placeholder="Type tag here"/>

			<section id="all-tags">
				<?php foreach($tags as $tag){?>
					<div class="clearfix tag">
						<label class="tag-name"><?= $tag['name'];?></label>
						<div class="markup">
							<?= $tag['markup'];?>
						</div>
					</div>
				<?php } ?>
				
			</section>
				
		</aside>
	</main>
	
<!-- script -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript">
		(function($){
			var Page = {
				__init 	: function(){
					this.__listen();
					this.loadCategory();
				},
				__listen 	: function(){
					var me = this;

					$("#categories").on("change", function(){
						me.loadCategory();
					});
				},
				loadCategory : function(){
					var css = $("#categories").val();

					if($("#css-"+css).length > 0){
						return false;
					}

					var head  = document.getElementsByTagName('head')[0];
				    var link  = document.createElement('link');
				    link.id   = "css-"+css;
				    link.rel  = 'stylesheet';
				    link.type = 'text/css';
				    link.href = 'css/'+css+'.css';
				    link.media = 'all';
				    head.appendChild(link);

				    this.initSortable();
				},
				initSortable : function(){
					var tags = $("#all-tags .tag");
				   	var origin = 'sortable';
				   	var ele = "";

					$("#workspace").droppable({
					 drop: function (event, ui) {
					    if (origin === 'draggable') {
					    	// console.log(ui.draggable);
					    	ele = $(ui.draggable.find(".markup").html());
					    	ele.addClass("sortable");
					    	ui.draggable.prop("outerHTML",(ele.prop("outerHTML"))); 
					    	
					    	ele = ui.draggable;
					    	// console.log();
							// ui.draggable.html('<span>Look at this new fancy HTML!</span>');
							origin = 'sortable';

							// $(ui.draggable).addClass("dandandan");
								$(".sortable").droppable({
									drop : function(){
						    			if (origin === 'sortable') {
											console.log("drop");
										}
									}
								}).sortable();
						    }
						 }
					}).sortable({
					 revert: true
					});

					tags.draggable({
					 connectToSortable: "#workspace, .sortable",
					 helper: "clone",
					 revert: "invalid",
					 start: function () {
					     origin = 'draggable';
					 }
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
