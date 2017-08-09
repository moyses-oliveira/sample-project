<!DOCTYPE html>
<html>
<?php $this->getHead()->render(); ?>

<body>
	<header class="container-fluid">
	
<?php $this->getFrame('header')->render();?>
	
	</header>
	<!-- end-header -->
	
	<section class="container content-frames">
		<section class="content-frame-left span3">
		
<?php $this->getFrame('left')->render();?>
		
		</section>
		<!-- end-content-frame-left -->
		
		<main class="content-frame-content span6">
		
<?php $this->getFrame('content')->render();?>
		
		</main>
		<!-- end-content-frame-content -->
		
		<section class="content-frame-right span3">

<?php $this->getFrame('right')->render();?>
		
		</section>
		<!-- end-content-frame-right -->
	</section>
	<!-- end-content-frames -->
	
	<footer class="container-fluid">
	
<?php $this->getFrame('footer')->render();?>

	</footer>
	<!-- end-footer -->
</body>
</html>

