<!DOCTYPE html>
<html>
	
<?php include 'head.phtml'; ?>
	
<body class="hold-transition skin-black-light sidebar-mini layout-boxed">
	
<div class="wrapper">
		<!-- Main content -->
		<section class="content">
			<div class="box box-primary">
				<ol class="breadcrumb">
				<?php 
				$tab = PHP_EOL . str_repeat("\t", 6);
				$bcFormat = $tab . '<li><a href="%3$s" title="%2$s">%1$s</a></li>';
				$bc = '';
				foreach($breadcrumb as $k=>$v):
					if(is_array($v))
						$bc = vsprintf($bcFormat, $v);
					else
						$bc = $tab . sprintf('<li class="active">%s</li>', $v);

					echo $bc;
				endforeach;
				?>
				</ol>
				<div class="box-body">
					<?php echo $this->content; ?>
				</div>
			</div>
		</section>
</div>
	
</body>
</html>