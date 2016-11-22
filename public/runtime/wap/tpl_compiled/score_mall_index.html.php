<?php if ($_REQUEST['is_ajax'] != 1): ?>
<?php echo $this->fetch('inc/header.html'); ?>
<?php 
 $this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/score.css";
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['pagecss'],
);
echo $k['name']($k['v']);
?>" />
<input type="hidden" class="pull_to_refresh_url" value="<?php
echo parse_url_tag_wap("u:score_mall#index|"."".""); 
?>" />
<!-- 默认的下拉刷新层 -->
<div class="pull-to-refresh-layer">
    <div class="preloader"></div>
    <div class="pull-to-refresh-arrow"></div>
</div>
<div class="deals_index">
	<div class="main_menu_box">
		<div class="hide_list">
		  	<div class="abbr">
		  	   	<div class="first_list webkit-box-flex" id="first_list">
		  	   	    <ul>
						<?php $_from = $this->_var['cate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate_item');if (count($_from)):
    foreach ($_from AS $this->_var['cate_item']):
?>
						<li class="directory"><?php echo $this->_var['cate_item']['name']; ?></li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  	   	    </ul>
		  	   	</div>
			   	<div class="second_list webkit-box-flex" id="second_list">
			   		<?php $_from = $this->_var['cate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate_item');if (count($_from)):
    foreach ($_from AS $this->_var['cate_item']):
?>
			   	    <ul>
			   	    	<li class="two_directory"><a href="<?php echo $this->_var['cate_item']['url']; ?>">全部</a></li>
			   	    	<?php if ($this->_var['cate_item']['sub_list']): ?>
						<?php $_from = $this->_var['cate_item']['sub_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'clist');if (count($_from)):
    foreach ($_from AS $this->_var['clist']):
?>
						<?php if ($this->_var['clist']): ?>
						<li class="two_directory"><a href="<?php echo $this->_var['clist']['url']; ?>"><?php echo $this->_var['clist']['name']; ?></a></li>
				   		<?php endif; ?>
					    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php endif; ?>	
		  	   	    </ul>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			   	</div>
		  	</div>
			<div class="abbr">
		  	   	<div class="all_list" id="first_list">
		  	   	    <ul>
						<?php $_from = $this->_var['integral_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'integral_0_88978100_1479805428');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['integral_0_88978100_1479805428']):
?>
						<li class="directory"><a href="<?php echo $this->_var['integral_0_88978100_1479805428']['url']; ?>" title="<?php echo $this->_var['integral_0_88978100_1479805428']['name']; ?>" <?php if ($this->_var['integral_0_88978100_1479805428']['integral'] == integral_str): ?>class="current"<?php endif; ?>><?php echo $this->_var['integral_0_88978100_1479805428']['name']; ?></a></li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>	
		  	   	    </ul>
		  	   	</div>  
		  	</div>
		</div>
		<div class="main_list">
	 	   	<ul class="mall-cate webkit-box">
	 	   	   	<li class="webkit-box-flex"><?php if ($this->_var['cate_name']): ?><?php echo $this->_var['cate_name']; ?><?php else: ?>全部分类 <?php endif; ?><i class="icon iconfont ml5">&#xe607;</i></li>
			   	<li class="webkit-box-flex"><?php if ($this->_var['state_name']): ?><?php echo $this->_var['state_name']; ?><?php else: ?>积分范围<?php endif; ?><i class="icon iconfont ml5">&#xe607;</i></li>
	 	   	</ul>
	 	</div>
 	</div>
	<div class="blank10"></div>
	<div class="sort_box">
		<ul class="webkit-box">
		<?php $_from = $this->_var['sort_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'sort_0_89018600_1479805428');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['sort_0_89018600_1479805428']):
?>
		<li class="webkit-box-flex ">
			<a class="<?php if ($this->_var['sort_0_89018600_1479805428']['sort'] == $this->_var['sort_str']): ?>sort_cur<?php endif; ?>" <?php if ($this->_var['key'] == 3): ?>style="border-right:none"<?php endif; ?> href="<?php echo $this->_var['sort_0_89018600_1479805428']['url']; ?>"><?php echo $this->_var['sort_0_89018600_1479805428']['name']; ?></a>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
	</div>
	<div class="blank10"></div>
	<div class="score_goods pull-to-refresh-content">
	<?php endif; ?>
		<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
		<div class="good_item b_radius3 clearfix">
			<a href="<?php
echo parse_url_tag_wap("u:score_good_show#index|"."id=".$this->_var['good']['id']."".""); 
?>" class="webkit-box">
				<div class="img_a">
					<img src="<?php if ($this->_var['good']['img'] == ''): ?><?php echo $this->_var['TMPL']; ?>/images/empty_thumb.gif<?php else: ?><?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['good']['img'],
  'w' => '150',
  'h' => '150',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?><?php endif; ?>" alt="<?php echo $this->_var['good']['name']; ?>" />
				</div>
				<div class="webkit-box-flex">
					<div class="name"><?php echo $this->_var['good']['name']; ?></div>
					<div><span class="f_red"><?php echo $this->_var['good']['score']; ?>积分</span></div>
					<div class="sales"><?php echo $this->_var['good']['total_buy']; ?>人兑换</div>
				</div>
			</a>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	<?php if ($_REQUEST['is_ajax'] != 1): ?>
	</div>
	<div class="blank15"></div>
	<div class="pages"><?php echo $this->_var['pages']; ?></div>
	<div class="blank15"></div>
</div>
<!-- score_mall_index.js -->
<?php echo $this->fetch('inc/footer.html'); ?>
<?php endif; ?>