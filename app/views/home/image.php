	<!-- start: outer container -->
	<div class="container">

		<!-- start: image title row -->
		<div class="grid" style="border-top: 3px solid red;">
			<div class="col-1">
				<div class="module title">
					<h1><?php echo $img_data->title; ?></h1>
				</div>
			</div>
		</div>
		<!-- end: image title row -->

		<!-- start:  prev - image - next row -->
		<div class="grid">
			<div class="col-1h-3">
				<div class="center-container nav-container">
					<div class="absolute-center nav-buttons">
						<div class="module">
							<a href="/home/image/<?php echo $prev_id; ?>" class="">
								<img src="/public/img/prev.png">
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-2-3">
				<span class="vote_image">
					<img src="<?php echo $img_data->url; ?>" >
				</span>
			</div>

			<div class="col-1h-3">
				<div class="center-container nav-container">
					<div class="absolute-center nav-buttons">
						<div class="module">
							<a href="/home/image/<?php echo $next_id; ?>" class="">
								<img src="/public/img/next.png">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end  prev - image - next row -->

		<!-- start: vote row -->
		<div class="grid">
			<div class="col-1">
				<div class="module vote-stats">

					<?php require 'app/views/home/voter.php'; ?>

				</div>
			</div>
		</div>
		<!-- end: vote row -->

	</div>
	<!-- end: outer container -->