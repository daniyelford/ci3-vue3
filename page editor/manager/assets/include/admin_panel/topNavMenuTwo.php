<?php
//sathe dstresi
$topMenuLink = '#';
$topMenuTitle = 'menu';
$x = 'satre dastresi b menu ha';
$s='tedade satr haye dastresi';
$y='taiine ozve madar';
?>
<div class="sticky mb-4" dir="rtl">
	<div class="horizontal-main hor-menu clearfix side-header">
		<div class="horizontal-mainwrapper container clearfix">
			<!--Nav-->
			<nav class="horizontalMenu clearfix">
				<div class="horizontal-overlapbg"></div>
				<ul class="horizontalMenu-list " style="margin-right: 75px">
					<?php //if($x==1){foreach ($list as $value) { ?>
					<li aria-haspopup="true">
						<a href="<?= $topMenuLink ?>">
							<?= $topMenuTitle ?><i class="angle fe fe-chevron-down"></i>
						</a>
						<?php //for($x=2;$x<count($s);$x++){ ?>
						<!--<ul class="slide-menu">-->
						<?php //if($y==$topMenuTitle){ foreach ($list as $value){ ?>
						<!--<li>
						<a href="<?= $topMenuLink ?>">
							<?= $topMenuTitle ?>
							<i class="angle fe fe-chevron-left"></i>
						</a>
					</li>-->
						<!--</ul>-->
						<?php //}}} ?>
					</li>
					<?php //} ?>
			</nav>
			<!--Nav-->
		</div>
	</div>
</div>
