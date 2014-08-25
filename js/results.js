(function () {
	$(document).ready(function(){
		var obj=eval("("+data.substring(1,(data.length-1))+")");
		var i=0;
		try{
			while(true){
				$(".search_result").append('<a href="title.php?query='+obj.titles[i].id+'" class="result_link"><div class="result"><img src="posters/'+obj.titles[i].id+'.jpg"/><br/><h1>'+obj.titles[i].title+'</h1></div></a>');
				i++;
			}
		}
		catch(e){
		}
		if(i==0)
			$(".search_result").append('No results found!');
	});		
}());