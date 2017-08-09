<?php /* @var $this \Spell\UI\Layout\Theme */ ?>
<!DOCTYPE html>
<html>
<?php echo $this->getHead()->render(); ?>

<body>
	<header class="container-fluid">
	
<?php echo $this->renderFrame('header');?>
	
	</header>
	<!-- end-header -->
	
	<section class="container content-frames">
		<section class="content-frame-left span3">
		
<?php //$this->renderFrame('left');?>
		
		</section>
		<!-- end-content-frame-left -->
		
		<main class="content-frame-content span6">
		
<?php echo $this->renderView('content') ?>
		
		</main>
		<!-- end-content-frame-content -->
		
		<section class="content-frame-right span3">

<?php //$this->getFrame('right');?>
		
		</section>
		<!-- end-content-frame-right -->
	</section>
	<!-- end-content-frames -->
	
	<footer class="container-fluid">
	
<?php echo $this->renderFrame('footer');?>

	</footer>
	<!-- end-footer -->
</body>
</html>

