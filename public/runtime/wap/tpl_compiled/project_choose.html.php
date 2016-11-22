<?php echo $this->fetch('inc/header.html'); ?>
<section class="project_choose">
	
	<div class="ul_block">
		<ul>
			<?php if (app_conf ( "INVEST_STATUS" ) == 0): ?>
			<li>
				<a href="#" onclick="RouterURL('<?php
echo parse_url_tag_wap("u:project#add|"."".""); 
?>','#project-add',2);" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5">回报众筹</p>
						<span class="f12 f_999">我有一个梦想，有创意项目，有创意产品，点击发布回报众筹</span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<li style="display:none">
				<a href="<?php
echo parse_url_tag_wap("u:project#investor_index1|"."".""); 
?>" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5"><?php echo $this->_var['gq_name']; ?></p>
						<span class="f12 f_999">我有创业梦想，有融资需求，点击发布<?php echo $this->_var['gq_name']; ?></span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<?php elseif (app_conf ( "INVEST_STATUS" ) == 1): ?>
			<li>
				<a href="#" onclick="RouterURL('<?php
echo parse_url_tag_wap("u:project#add|"."".""); 
?>','#project-add',2);" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5">回报众筹</p>
						<span class="f12 f_999">我有一个梦想，有创意项目，有创意产品，点击发布回报众筹</span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<?php elseif (app_conf ( "INVEST_STATUS" ) == 2): ?>
			<li style="display:none">
				<a href="<?php
echo parse_url_tag_wap("u:project#investor_index1|"."".""); 
?>" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5"><?php echo $this->_var['gq_name']; ?></p>
						<span class="f12 f_999">我有创业梦想，有融资需求，点击发布<?php echo $this->_var['gq_name']; ?></span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if (app_conf ( "IS_SELFLESS" ) == 1): ?>
			<li>
				<a href="#" onclick="RouterURL('<?php
echo parse_url_tag_wap("u:project#add_selfless|"."".""); 
?>','#project-add_selfless',2);" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5">公益众筹</p>
						<span class="f12 f_999">我有一个梦想，有创意项目，有创意产品，点击发布公益众筹</span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<?php endif; ?>
			
			<?php if (app_conf ( "IS_HOUSE" ) == 1 && $this->_var['user_info']['is_investor'] == 2 && $this->_var['user_info']['investor_status'] == 1): ?>
			<li>
				<a href="#" onclick="RouterURL('<?php
echo parse_url_tag_wap("u:project#add_house|"."".""); 
?>','#project-add_house',2);" class="webkit-box">
					<div class="text webkit-box-flex">
						<p class="f16 mb5">房产众筹</p>
						<span class="f12 f_999">我有一个梦想，有创意项目，有创意产品，点击发布公益众筹</span>
					</div>
					<i class="fa fa-chevron-right"></i>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</section>
<?php echo $this->fetch('inc/footer.html'); ?> 