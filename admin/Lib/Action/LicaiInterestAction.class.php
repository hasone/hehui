<?php
// +----------------------------------------------------------------------
// | Fanwe 方维众筹商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class LicaiInterestAction extends CommonAction{
	public function index()
	{	
		require_once APP_ROOT_PATH.'system/libs/licai.php';
		
		$id = intval($_REQUEST["id"]);
		if(!$id)
		{
			$this->error("操作失败，请返回重试");
		}
		$condition = " and licai_id = ".$id;
		
		//排序字段 默认为主键名
		if (isset ( $_REQUEST ['_order'] )) {
			$order = strim($_REQUEST ['_order']);		
		} else {
			$order = " id ";
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset($_REQUEST ['_sort'])){
			$sort = strim($_REQUEST ['_sort']) ? 'asc' : 'desc';
		} else {
			$sort = 'desc';
		}
		
		$sortImg = $sort; //排序图标
		$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
				
		$page = intval($_REQUEST['p']);
		if($page==0)
			$page = 1;
		
		$page_size = 20;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		$result = array();
		
		$licai = $GLOBALS["db"]->getRow("select name,id from ".DB_PREFIX."licai where id=".$id);

		$this->assign("licai",$licai);
		
		$result['count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."licai_interest  where 1=1 ".$condition);
		
		if($result['count'] > 0){
			
			$result['list'] = $GLOBALS['db']->getAll("SELECT * FROM ".DB_PREFIX."licai_interest where 1=1 ".$condition." order by ".str_replace("_format","",$order)." ".$sort." limit ".$limit);
			
		}
		
		$sort = $sort == 'desc' ? 1 : 0; //排序方式
		
		$this->assign ( 'sort', $sort );
		$this->assign ( 'order', $order );
		$this->assign ( 'sortImg', $sortImg );
		$this->assign ( 'sortType', $sortAlt );
		
		foreach($result['list']  as $k => $v)
		{
			$result['list'][$k]["interest_rate_format"] = $v['interest_rate']."%";
			$result['list'][$k]["buy_fee_rate_format"] = $v['buy_fee_rate']."%";
			$result['list'][$k]["site_buy_fee_rate_format"] = $v['site_buy_fee_rate']."%";
			$result['list'][$k]["redemption_fee_rate_format"] = $v['redemption_fee_rate']."%";
			$result['list'][$k]["before_rate_format"] = $v['before_rate']."%";
			$result['list'][$k]["before_breach_rate_format"] = $v['before_breach_rate']."%";
			$result['list'][$k]["breach_rate_format"] = $v['breach_rate']."%";
			$result['list'][$k]["platform_rate_format"] = $v['platform_rate']."%";
			$result['list'][$k]["freeze_bond_rate_format"] = $v['freeze_bond_rate']."%";
			$result['list'][$k]["platform_breach_rate_format"] = $v['platform_breach_rate']."%";
			
			$result['list'][$k]["min_money_format"] = format_money_wan($v['min_money']);
			$result['list'][$k]["max_money_format"] = format_money_wan($v['max_money']);

		}
		
		$this->assign("list",$result['list']);
		
		$page = new Page($result['count'],$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$this->assign('page',$p);
		$this->assign('main_title',"收益率列表");
		$this->display ();
	}
	
	public function edit()
	{
		require_once APP_ROOT_PATH.'system/libs/licai.php';
		
		$id = intval($_REQUEST ['id']);
		$vo = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."licai_interest where  id = ".$id);
		
		$vo["min_money_format"] = $vo['min_money']/10000;
		$vo["max_money_format"] = $vo['max_money']/10000;
		
		$this->assign ( 'vo', $vo );
		
		$this->display ();
	}
	public function update()
	{
		B('FilterString');
		$data = M(MODULE_NAME)->create();
		
		$data["min_money"] = $data['min_money']*10000;
		$data["max_money"] = $data['max_money']*10000;
		
		$this->assign("jumpUrl",u(MODULE_NAME."/edit",array("id"=>$data['id'])));
		
		$log_info_array = M(MODULE_NAME)->where("id=".intval($data['id']))->find();
		
		$log_info = $log_info["licai_id"]."--".$log_info["id"];
		//print_r($log_info);die;
		//开始验证有效性
		
		if(!check_empty($data['min_money']))
		{
			$this->error("请输入最小金额");
		}	
		if(!check_empty($data['max_money']))
		{
			$this->error("请输入最大金额");
		}
		if(!check_empty($data['interest_rate']))
		{
			$this->error("请输入利率");
		}
		if(floatval($data["min_money"]) > floatval($data["max_money"]))
		{
			$this->error("请输入正确的金额");
		}	
		
		$list=M(MODULE_NAME)->save ($data);
		
		if (false !== $list) {
			
			require_once(APP_ROOT_PATH."system/libs/licai.php");
			
			syn_licai_status($log_info_array['licai_id']);
			save_log($log_info.L("UPDATE_SUCCESS"),1);
			$this->success(L("UPDATE_SUCCESS"));
		} else {
			//错误提示
			save_log($log_info.L("UPDATE_FAILED"),0);
			$this->error(L("UPDATE_FAILED"),0,$log_info.L("UPDATE_FAILED"));
		}
	}
	public function delete()
	{
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['title'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->delete();	
		
				if ($list!==false) {
					save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
					clear_auto_cache("get_help_cache");
					$this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("FOREVER_DELETE_FAILED"),0);
					$this->error (l("FOREVER_DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	public function add()
	{
		$id = intval($_REQUEST["id"]);
		
		if(!$id)
		{
			$this->error("操作失败，请返回重试");
		}
		
		$licai = $GLOBALS["db"]->getRow("select name,id from ".DB_PREFIX."licai where id=".$id);

		$this->assign("licai",$licai);
		
		$this->display ();
	}
	public function insert()
	{
		B('FilterString');
		$data = M(MODULE_NAME)->create();
		
		$data["min_money"] = $data['min_money']*10000;
		$data["max_money"] = $data['max_money']*10000;
		
		$this->assign("jumpUrl",u(MODULE_NAME."/add",array("id"=>$data["licai_id"])));
		
		$log_info = $data["licai_id"];
		
		//开始验证有效性
		
		if(!check_empty($data['min_money']))
		{
			$this->error("请输入最小金额");
		}	
		if(!check_empty($data['max_money']))
		{
			$this->error("请输入最大金额");
		}
		if(strim($data['interest_rate']) == "")
		{
			$this->error("请输入利率");
		}
		if(floatval($data["min_money"]) > floatval($data["max_money"]))
		{
			$this->error("请输入正确的金额");
		}
		
		
		$list=M(MODULE_NAME)->add ($data);
		
		$log_info .= "--".$list["id"];
		
		if (false !== $list) {
			require_once(APP_ROOT_PATH."system/libs/licai.php");
			syn_licai_status($data['licai_id']);
			save_log($log_info.L("INSERT_SUCCESS"),1);
			$this->success(L("INSERT_SUCCESS"));
		} else {
			//错误提示
			save_log($log_info.L("INSERT_FAILED"),0);
			$this->error(L("INSERT_FAILED"),0,$log_info.L("INSERT_FAILED"));
		}
	}
}
?>