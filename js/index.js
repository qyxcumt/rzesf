function getHouseTable(){
	$.post("index.php",
			{
		fun:"getHouse"
			},
			function(data,status){
				//alert(data)
				if("success"==status){
					$("#HouseTableDiv").html(data)
				}else
					;//alert(data)
				
			})
}

function getInfo(){
	$.post("index.php",
			{
		fun:"getInfo"
			},
			function(data,status){
				if("success"==status){
					$("#InfoDiv").html(data)
				}else
					;
			})
}
