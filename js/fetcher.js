(function () {
var query='';
var obj;
	$(document).ready(function(){
		$("#search").bind('keyup',function(){
			query=$("#search").val();
				if(query.length>=1)
					fetch();
				else if(query.length === 0)
					$("#suggest").html('');
		});
		$("#search").bind('focus',function(){
			if(query.length>=1)
					fetch();
		});
		$(".wrapper").bind('click',function(){
			$("#suggest").css('display','none');
			$(".logindiv").css('display','none');
		});
	});
	function fetch(){
		$.post('fetch.php',{query:query},function(data){
			$("#suggest").css('display','block');
			obj=eval("("+data.substring(1,(data.length-1))+")");
			$("#suggest").html('');
			var i=0;
				while(i<5){
					if(!obj.data[i].title)
						break;
						$("#suggest").append('<a href="title.php?query='+obj.data[i].id+'" class="hint_link"><div class="hint"><img src="posters/'+obj.data[i].id+'.jpg"/><br/><h1>'+obj.data[i].title+'</h1></div></a>');
					i++;
				}
			while(i<10){
				$("#suggest").append('<a href="celeb.php?query='+obj.data[i].id+'" class="hint_link"><div class="hint"><img src="person/'+obj.data[i].id+'.jpg"/><br/><h1>'+obj.data[i].name+'</h1></div></a>');
				i++;
			}
		});
	}
}());