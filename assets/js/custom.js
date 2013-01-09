
// FUNCTION TO INSERT MAILCHIMP API
$('#frm_MC').submit(function(event) {
	event.preventDefault();
	var $form = $( this ),
  key = $form.find( 'input[name="key"]' ).val(),
  url = $form.attr( 'action' );
  if(key == ''){
  	alert('No API key');
  }else{
		$.ajax({
		  type: "POST",
		  url: url,
		  data: {key : key},
		  dataType: 'json',
		  success: function(data) {
		  	if(data == true){
		  		location = '';
		  	}else if(data == false){
		  		alert('Incorrect API');
		  	}
		  }
		});
	}
  return false;
});

$('#changeMC').click(function(){
	$('.MCkeyform').show();
});
$('#closeMcFrm').click(function(){
	$('.MCkeyform').hide();
});


// FUNCTION TO INSERT SHOPIFY DATA

$('#frm_shopify').submit(function(event) {
	event.preventDefault();
	var $form = $( this ),

  type = $form.find( 'input[name="shopify"]' ).val(),
  shop = $form.find( 'input[name="shopName"]' ).val(),
  api = $form.find( 'input[name="shopifyApi"]' ).val(),

  url = $form.attr( 'action' );
  if(shop == ''){
  	alert('Enter Shop Name');
  }else if(api == ''){
  	alert('Enter Your Shopify API key');
  }else{
		$.ajax({
		  type: "POST",
		  url: url,
		  data: {type : type, shop : shop, api : api},
		  dataType: 'json',
		  success: function(data) {
		  	if(data == 1){
		  		location = '';
		  	}
		  }
		});
	}
  return false;
});