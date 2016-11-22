<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/style.css" />
<script type="text/javascript" src="__TMPL__Common/js/check_dog.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/IA300ClientJavascript.js"></script>
<script type="text/javascript">
	var ACTION_ID ='<?php echo $action_id ?>';
 	var VAR_MODULE = "<?php echo conf("VAR_MODULE");?>";
	var VAR_ACTION = "<?php echo conf("VAR_ACTION");?>";
	var MODULE_NAME	=	'<?php echo MODULE_NAME; ?>';
	var ACTION_NAME	=	'<?php echo ACTION_NAME; ?>';
	var ROOT = '__APP__';
	var ROOT_PATH = '<?php echo APP_ROOT; ?>';
	var CURRENT_URL = '<?php echo trim($_SERVER['REQUEST_URI']);?>';
	var INPUT_KEY_PLEASE = "<?php echo L("INPUT_KEY_PLEASE");?>";
	var TMPL = '__TMPL__';
	var APP_ROOT = '<?php echo APP_ROOT; ?>';
	var LOGINOUT_URL = '<?php echo u("Public/do_loginout");?>';
	var WEB_SESSION_ID = '<?php echo es_session::id(); ?>';
	var EMOT_URL = '<?php echo APP_ROOT; ?>/public/emoticons/';
	var MAX_FILE_SIZE = "<?php echo (app_conf("MAX_IMAGE_SIZE")/1000000)."MB"; ?>";
	var FILE_UPLOAD_URL ='<?php echo u("File/do_upload");?>' ;
	CHECK_DOG_HASH = '<?php $adm_session = es_session::get(md5(conf("AUTH_KEY"))); echo $adm_session["adm_dog_key"]; ?>';
	function check_dog_sender_fun()
	{
		window.clearInterval(check_dog_sender);
		check_dog2();
	}
	var check_dog_sender = window.setInterval("check_dog_sender_fun()",5000);
	
</script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/jquery.timer.js"></script>
<script type="text/javascript" src="__TMPL__Common/js/script.js"></script>
<script type="text/javascript" src="__ROOT__/public/runtime/admin/lang.js"></script>
<script type='text/javascript'  src='__ROOT__/admin/public/kindeditor/kindeditor.js'></script>
<script type='text/javascript'  src='__ROOT__/admin/public/kindeditor/lang/zh_CN.js'></script>
</head>
<body onLoad="javascript:DogPageLoad();">
<div id="info"></div>

<script type="text/javascript" src="__TMPL__Common/js/conf.js"></script>
<script type="text/javascript" src="__ROOT__/public/region.js"></script>	
<script type="text/javascript" src="__TMPL__Common/js/user_edit.js"></script>
<div class="main">
<div class="main_title"><?php echo L("EDIT");?> <a href="<?php echo u("User/index");?>" class="back_list"><?php echo L("BACK_LIST");?></a></div>
<div class="blank5"></div>
<form name="edit" action="__APP__" method="post" enctype="multipart/form-data">
<table class="form conf_tab" cellpadding=0 cellspacing=0 >
	<tr>
		<td colspan=2 class="topTd"></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("USER_NAME");?>:</td>
		<td class="item_input"><?php echo ($vo["user_name"]); ?><input type="hidden" name="user_name" value="<?php echo ($vo["user_name"]); ?>"  /></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("USER_EMAIL");?>:</td>
		<td class="item_input"><?php echo ($vo["email"]); ?><input type="hidden" name="email" value="<?php echo ($vo["email"]); ?>"   /></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("USER_MOBILE");?>:</td>
		<td class="item_input"><input type="text" value="<?php echo ($vo["mobile"]); ?>" class="textbox" name="mobile" /></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("USER_PASSWORD");?>:</td>
		<td class="item_input"><input type="password" class="textbox" name="user_pwd" /></td>
	</tr>
	<tr>
		<td class="item_title"><?php echo L("USER_CONFIRM_PASSWORD");?>:</td>
		<td class="item_input"><input type="password" class="textbox" name="user_confirm_pwd" /></td>
	</tr>
	
	<tr>
		<td class="item_title">所属地区:</td>
		<td class="item_input">
			<select name="province">				
			<option value="" rel="0">请选择省份</option>
			<?php if(is_array($region_lv2)): foreach($region_lv2 as $key=>$region): ?><option value="<?php echo ($region["name"]); ?>" rel="<?php echo ($region["id"]); ?>" <?php if($region['selected']): ?>selected="selected"<?php endif; ?>><?php echo ($region["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			
			<select name="city">				
			<option value="" rel="0">请选择城市</option>
			<?php if(is_array($region_lv3)): foreach($region_lv3 as $key=>$region): ?><option value="<?php echo ($region["name"]); ?>" rel="<?php echo ($region["id"]); ?>" <?php if($region['selected']): ?>selected="selected"<?php endif; ?>><?php echo ($region["name"]); ?></option><?php endforeach; endif; ?>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="item_title">性别:</td>
		<td class="item_input">
			
			<label>女<input type="radio" name="sex" value="0" <?php if($vo['sex'] == 0): ?>checked="checked"<?php endif; ?> /></label>
			<label>男<input type="radio" name="sex" value="1" <?php if($vo['sex'] == 1): ?>checked="checked"<?php endif; ?>/></label>
			<label>未知<input type="radio" name="sex" value="-1" <?php if($vo['sex'] == -1): ?>checked="checked"<?php endif; ?> /></label>
		</td>
	</tr>
	<!--<tr>
		<td class="item_title">会员类型:</td>
		<td class="item_input">
			<select name="user_type">
				<option value="0" <?php if($vo['user_type'] == 0): ?>selected="selected"<?php endif; ?>>请选择类型</option>
				<option value="1" <?php if($vo['user_type'] == 1): ?>selected="selected"<?php endif; ?>>创业者</option>
				<option value="2" <?php if($vo['user_type'] == 2): ?>selected="selected"<?php endif; ?>>投资者</option>
			</select>
			<span class='tip_span'>默认为0无类型</span>
		</td>
	</tr>-->
	<tr>
		<td class="item_title">会员等级:</td>
		<td class="item_input">
			<select name="user_level">
				<option value="0">请选择等级</option>
				<?php if(is_array($user_level)): foreach($user_level as $key=>$level): ?><option value="<?php echo ($level["id"]); ?>" <?php if($vo['user_level'] == $level['id']): ?>selected="selected"<?php endif; ?>><?php echo ($level["name"]); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="item_title">简介:</td>
		<td class="item_input">
			<textarea name="intro" class="textarea"><?php echo ($vo["intro"]); ?></textarea>
		</td>
	</tr>
	

	
	<tr>
		<td class="item_title"><?php echo L("IS_EFFECT");?>:</td>
		<td class="item_input">
			<label><?php echo L("IS_EFFECT_1");?><input type="radio" name="is_effect" value="1" <?php if($vo['is_effect'] == 1): ?>checked="checked"<?php endif; ?>  /></label>
			<label><?php echo L("IS_EFFECT_0");?><input type="radio" name="is_effect" value="0" <?php if($vo['is_effect'] == 0): ?>checked="checked"<?php endif; ?> /></label>
		</td>
	</tr>
	<tr>
		<td colspan=2 class="bottomTd"></td>
	</tr>
</table>
<div class="blank5"></div>
	<table class="form" cellpadding=0 cellspacing=0 style="display:none;">
		<tr>
			<td colspan=2 class="topTd"></td>
		</tr>
		<tr>
			<td class="item_title">真实姓名</td>
			<td class="item_input">
			<input type="text" value="<?php echo ($vo["ex_real_name"]); ?>" name="ex_real_name" class="textbox" />
			</td>
		</tr>
		
		<tr>
			<td class="item_title">开户行：</td>
			<td class="item_input">
			<input type="text" name="ex_account_bank" value="<?php echo ($vo["ex_account_bank"]); ?>" class="textbox" style="width:500px;" />
			</td>
		</tr>
		<tr>
			<td class="item_title">银行帐号：</td>
			<td class="item_input">
			<input type="text"  name="ex_account_info" value="<?php echo ($vo["ex_account_info"]); ?>" class="textbox" style="width:500px;" />
			</td>
		</tr>
		
		<tr>
			<td class="item_title">联系电话：</td>
			<td class="item_input">
			<input type="text" name="ex_contact" value="<?php echo ($vo["ex_contact"]); ?>" class="textbox" style="width:500px;" />
			</td>
		</tr>
		<tr>
			<td class="item_title">联系QQ：</td>
			<td class="item_input">
			<input type="text"  name="ex_qq"  value="<?php echo ($vo["ex_qq"]); ?>" class="textbox" style="width:500px;" />
			</td>
		</tr>
		<tr>
			<td colspan=2 class="bottomTd"></td>
		</tr>
	</table> 
<div class="blank5"></div>
	<table class="form" cellspacing=0  cellpadding=0>
		<tr><td colspan=2 class="topTd"></td></tr>
		<tr>
			<td class="item_title">投资类型审核：</td>
			<td class="item_input">
				<input type="radio" name="investor_status" <?php if($vo["investor_stauts"] == 0): ?>checked="checked"<?php endif; ?> value="0">未审核
				<input type="radio" name="investor_status" <?php if($vo["investor_status"] == 1): ?>checked="checked"<?php endif; ?> value="1">审核通过
				<input type="radio" name="investor_status" <?php if($vo["investor_status"] == 2): ?>checked="checked"<?php endif; ?> value="2">审核未通过
			</td>
		</tr>
		<tr>
			<td class="item_title">投资类型</td>
			<td class="item_input">
				<input type="radio" name="is_investor"  <?php if($vo["is_investor"] == 0): ?>checked="checked"<?php endif; ?>  value="0"> 普通用户
				<input type="radio" name="is_investor" <?php if($vo["is_investor"] == 1): ?>checked="checked"<?php endif; ?>   value="1"> 投资人
				<input type="radio" name="is_investor" <?php if($vo["is_investor"] == 2): ?>checked="checked"<?php endif; ?>  value="2"> 机构投资者
			</td>
		</tr>
		 
	</table>
<div class="blank5"></div>
<table class="form identify_info" id="identify_info_0"  <?php if($vo["is_investor"] != 0): ?>style="display:0"<?php endif; ?>>
	<tr></tr>
</table>
<table class="form identify_info" cellspacing=0 cellpadding=0 id="identify_info_1" <?php if($vo["is_investor"] == 0): ?>style="display:0"<?php endif; ?>>
	<tr>
		<td class="item_title">身份证姓名：</td>
		<td class="item_input"><input type="text" name="identify_name" value="<?php echo ($vo["identify_name"]); ?>" ></td>
	</tr>
	<tr>
		<td class="item_title">身份证号码：</td>
		<td class="item_input"><input type="text" name="identify_number" value="<?php echo ($vo["identify_number"]); ?>"></td>
	</tr>
	<tr>
		<td class="item_title">身份证正面:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["identify_positive_image"]); ?>' name='identify_positive_image' id='keimg_h_identify_positive_image' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='identify_positive_image'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["identify_positive_image"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_positive_image"]); ?><?php endif; ?>' target='_blank' id='keimg_a_identify_positive_image' ><img src='<?php if($vo["identify_positive_image"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_positive_image"]); ?><?php endif; ?>' id='keimg_m_identify_positive_image' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["identify_positive_image"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='identify_positive_image' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
	<tr>
		<td class="item_title">身份证反面:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["identify_nagative_image"]); ?>' name='identify_nagative_image' id='keimg_h_identify_nagative_image' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='identify_nagative_image'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["identify_nagative_image"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_nagative_image"]); ?><?php endif; ?>' target='_blank' id='keimg_a_identify_nagative_image' ><img src='<?php if($vo["identify_nagative_image"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_nagative_image"]); ?><?php endif; ?>' id='keimg_m_identify_nagative_image' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["identify_nagative_image"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='identify_nagative_image' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
	<?php if($vo["is_investor"] == 1): ?><tr class="identify_info_3">
		<td class="item_title">名片:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["card"]); ?>' name='card' id='keimg_h_card' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='card'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["card"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["card"]); ?><?php endif; ?>' target='_blank' id='keimg_a_card' ><img src='<?php if($vo["card"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["card"]); ?><?php endif; ?>' id='keimg_m_card' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["card"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='card' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
	<tr class="identify_info_3">
		<td class="item_title">符合以下条件之一的自然人投资者:</td>
		<td class="item_input">
			<input type="radio" name="identity_conditions"  <?php if($vo["identity_conditions"] == 0): ?>checked="checked"<?php endif; ?>  value="0"> 我的金融资产超过100万元
			<input type="radio" name="identity_conditions"  <?php if($vo["identity_conditions"] == 1): ?>checked="checked"<?php endif; ?>   value="1"> 我的年收入超过30万元
			<input type="radio" name="identity_conditions"  <?php if($vo["identity_conditions"] == 2): ?>checked="checked"<?php endif; ?>  value="2"> 我是专业的风险投资人
			<input type="radio" name="identity_conditions"  <?php if($vo["identity_conditions"] == 3): ?>checked="checked"<?php endif; ?>  value="3"> 我不符合上述任一条件
		</td>
	</tr>
	<tr class="identify_info_3">
		<td class="item_title">信用报告:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["credit_report"]); ?>' name='credit_report' id='keimg_h_credit_report' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='credit_report'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["credit_report"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["credit_report"]); ?><?php endif; ?>' target='_blank' id='keimg_a_credit_report' ><img src='<?php if($vo["credit_report"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["credit_report"]); ?><?php endif; ?>' id='keimg_m_credit_report' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["credit_report"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='credit_report' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
	<tr class="identify_info_3">
		<td class="item_title">房产认证:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["housing_certificate"]); ?>' name='housing_certificate' id='keimg_h_housing_certificate' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='housing_certificate'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["housing_certificate"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["housing_certificate"]); ?><?php endif; ?>' target='_blank' id='keimg_a_housing_certificate' ><img src='<?php if($vo["housing_certificate"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["housing_certificate"]); ?><?php endif; ?>' id='keimg_m_housing_certificate' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["housing_certificate"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='housing_certificate' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr><?php endif; ?>
</table>	
<table class="form identify_info" cellspacing=0 cellpadding=0 id="identify_info_2"  <?php if($vo["is_investor"] != 2): ?>style="display:none;"<?php endif; ?> >
	<tr>
		<td class="item_title">机构名称:</td>
		<td class="item_input"><input type="text" name="identify_business_name" value="<?php echo ($vo["identify_business_name"]); ?>"></td>
	</tr>
	<tr>
		<td class="item_title">营业执照：</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["identify_business_licence"]); ?>' name='identify_business_licence' id='keimg_h_identify_business_licence' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='identify_business_licence'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["identify_business_licence"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_licence"]); ?><?php endif; ?>' target='_blank' id='keimg_a_identify_business_licence' ><img src='<?php if($vo["identify_business_licence"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_licence"]); ?><?php endif; ?>' id='keimg_m_identify_business_licence' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["identify_business_licence"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='identify_business_licence' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
	<tr>
		<td class="item_title">组织机构代码证：</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["identify_business_code"]); ?>' name='identify_business_code' id='keimg_h_identify_business_code' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='identify_business_code'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["identify_business_code"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_code"]); ?><?php endif; ?>' target='_blank' id='keimg_a_identify_business_code' ><img src='<?php if($vo["identify_business_code"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_code"]); ?><?php endif; ?>' id='keimg_m_identify_business_code' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["identify_business_code"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='identify_business_code' title='删除'>
                </div>
            </div>
        </div>
        </span> </td>
	</tr>
	<tr>
		<td class="item_title">税务登记证:</td>
		<td class="item_input"><span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($vo["identify_business_tax"]); ?>' name='identify_business_tax' id='keimg_h_identify_business_tax' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='identify_business_tax'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($vo["identify_business_tax"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_tax"]); ?><?php endif; ?>' target='_blank' id='keimg_a_identify_business_tax' ><img src='<?php if($vo["identify_business_tax"] == ''): ?>./admin/Tpl/default/Common/images/no_pic.gif<?php else: ?><?php echo ($vo["identify_business_tax"]); ?><?php endif; ?>' id='keimg_m_identify_business_tax' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/admin/Tpl/default/Common/images/del.gif' style='<?php if($vo["identify_business_tax"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='identify_business_tax' title='删除'>
                </div>
            </div>
        </div>
        </span></td>
	</tr>
</table>
<script>
	$(function(){
		$("input[name='is_investor']").bind("click",function(){
 			num=$(this).val();
			if(num==2){
				$("#identify_info_2").show("slow");
				$(".identify_info_3").hide();
			}else{
				if(num==0){
					$("#identify_info_1").hide();
				}else{
					$("#identify_info_1").show("slow");
					$(".identify_info_3").show("slow");
				}
				$("#identify_info_2").hide("slow");
			}
			
		});
	});
</script>
<div class="blank5"></div>
	<table class="form" cellpadding=0 cellspacing=0>
		<tr>
			<td colspan=2 class="topTd"></td>
		</tr>
		<tr>
			<td class="item_title"></td>
			<td class="item_input">
			<!--隐藏元素-->
			<input type="hidden" name="<?php echo conf("VAR_MODULE");?>" value="User" />
			<input type="hidden" name="<?php echo conf("VAR_ACTION");?>" value="update" />
			<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
 			<input type="hidden" name="wx_openid" value="<?php echo ($vo["wx_openid"]); ?>" />
			<!--隐藏元素-->
			<input type="submit" class="button" value="<?php echo L("EDIT");?>" />
			<input type="reset" class="button" value="<?php echo L("RESET");?>" />
			</td>
		</tr>
		<tr>
			<td colspan=2 class="bottomTd"></td>
		</tr>
	</table> 		 
</form>
</div>
</body>
</html>