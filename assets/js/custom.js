
// FUNCTION TO INSERT MAILCHIMP API
$('#frm_MC').submit(function(event) {
	event.preventDefault();
	var $form = $( this ),
  key = $form.find( 'input[name="key"]' ).val(),
  list = $form.find( 'select[name="MC_lsit"]' ).val(),
  url = $form.attr( 'action' );
  if(key == ''){
  	alert('No API key');
  }else if(list == 0){
  	alert('Select a list');
  }else{
		$.ajax({
		  type: "POST",
		  url: url,
		  data: {key : key , list :list},
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
$('#get_list').click(function(){
    var key = $('#key').val();
    
    if(!key){
      alert('Enter a key first');
    }else{
      var options = $("#MClists");
      options.empty();
      $('#loading-image').show();
      $.ajax({
        url: "index.php/common/settings/getList",
        type: "post",
        data: { key: key},
        datatype: "json",
        success: function(response){
          if(response == 0){
            alert("No lists Found or Incorrect API Key");
          }else{
          for(var i = 0; i < response.length; ++i)
          {
            $.each(response[i], function(id, name){
              options.append("<option value='"+ id +"'>"+ name +"</option>");
            });
          }
          }
        },
        complete: function(){	
         $('#loading-image').hide();
       }
      });
    }
    
  });
$('#download').click(function(event) {
  event.preventDefault();
  var form = $('#csvDownload');
  var url = form.attr( 'action' );
  var MfFile = form.find( 'input[name="MF"]' ).val();
  if(MfFile == ''){
    alert('Please enter MF File Name.');
  }else{
    $('#csvDownload').submit();
  }
  return false;
});
// $('#download').click(function(){
//    $.ajax({
//     url: "index.php/common/settings/downloadCSV",
//     type: "post",
//     data: '',
//     datatype: "json",
//     success: function(response){
//       if(response == 0){
//         alert("No lists Found or Incorrect API Key");
//       }else{
//         for(var i = 0; i < response.length; ++i)
//         {
          
//         }
//       }
//     },
//     complete: function(){ 
//      $('#loading-image').hide();
//    }
//   });
// });