$(document).on("pageInit","#message-history", function(e, pageId, $page) {
	bind_del_contact();
	bind_del_message();
	function bind_del_contact()
	{
		$(".delcontact").bind("click",function(){
			var ajaxurl = $(this).attr("href");
			var query = new Object();
			query.ajax = 1;
			$.confirm("确定要删除与该联系人的私信记录吗？",function(){
				$.ajax({ 
					url: ajaxurl,
					dataType: "json",
					data:query,
					type: "POST",
					success: function(ajaxobj){
						close_pop();
						if(ajaxobj.status==1)
						{
							if(ajaxobj.info!="")
							{
								$.showSuccess(ajaxobj.info,function(){
									if(ajaxobj.jump!="")
									{
										href = ajaxobj.jump;
										$.router.loadPage(href);
									}
								});	
							}
							else
							{
								if(ajaxobj.jump!="")
								{
									href = ajaxobj.jump;
									$.router.loadPage(href);
								}
							}
						}
						else
						{
							if(ajaxobj.info!="")
							{
								$.showErr(ajaxobj.info,function(){
									if(ajaxobj.jump!="")
									{
										href = ajaxobj.jump;
										$.router.loadPage(href);
									}
								});	
							}
							else
							{
								if(ajaxobj.jump!="")
								{
									href = ajaxobj.jump;
									$.router.loadPage(href);
								}
							}							
						}
					},
					error:function(ajaxobj)
					{
						if(ajaxobj.responseText!='')
						alert(ajaxobj.responseText);
					}
				});
			});
			
			
			return false;
		});
	}



	function bind_del_message()
	{
		$(".delmessage").bind("click",function(){
			var ajaxurl = $(this).attr("href");
			var query = new Object();
			query.ajax = 1;
			$.confirm("确定要删除该记录吗？",function(){
				$.ajax({ 
					url: ajaxurl,
					dataType: "json",
					data:query,
					type: "POST",
					success: function(ajaxobj){
						close_pop();
						if(ajaxobj.status==1)
						{
							if(ajaxobj.info!="")
							{
								$.showSuccess(ajaxobj.info,function(){
									if(ajaxobj.jump!="")
									{
										href = ajaxobj.jump;
										$.router.loadPage(href);
									}
								});	
							}
							else
							{
								if(ajaxobj.jump!="")
								{
									href = ajaxobj.jump;
									$.router.loadPage(href);
								}
							}
						}
						else
						{
							if(ajaxobj.info!="")
							{
								$.showErr(ajaxobj.info,function(){
									if(ajaxobj.jump!="")
									{
										href = ajaxobj.jump;
										$.router.loadPage(href);
									}
								});	
							}
							else
							{
								if(ajaxobj.jump!="")
								{
									href = ajaxobj.jump;
									$.router.loadPage(href);
								}
							}							
						}
					},
					error:function(ajaxobj)
					{
						if(ajaxobj.responseText!='')
						alert(ajaxobj.responseText);
					}
				});
			});
			
			
			return false;
		});
	}
});