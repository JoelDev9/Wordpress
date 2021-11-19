<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include "inc/header.php";

    $task = 'get_all_questionnaire';
    if(isset($_GET['task'])) {
        $task = $_GET['task'];
    }
    $partner_notification->process($task);
?>

<div class="buttons-container">
  <input class="btn btn-secondary" type="button" name="back" value="BACK" id="btn_back">
  <input class="btn btn-primary" type="button" name="next" value="NEXT" id="btn_next">
  <input class="btn btn-primary" type="button" name="next" value="SUBMIT" id="btn_submit">
</div>
<script>
  var participant_id;

  $( document).ready(function() {
    $('#btn_submit').hide();
    $('#btn_back').hide();

  });
  $('#btn_back').on('click', function(e){
    console.log(participant_id);
    if(participant_id){
      $('.participant_id').val(participant_id);  
    }
    var current = $('ul.active');
    $('ul').removeClass('active');
    current.prev().addClass('active');   
    if(current.attr("class") == "step-3"){
      $('#btn_next').show();
      $("#btn_submit").hide();
    }
    if(current.attr("class") == "step-2"){
    $("#btn_back").hide();
    }
});

  $('#email_address').on('change', function(e){
    if($(this).val() != ''){
      if(isEmail($(this).val()) == false){
        $('.invalid_em_add').removeClass('hide');
      }else{
        $('.invalid_em_add').addClass('hide');
      }
    }
  });

  $('#btn_next').on('click', function(e){
    console.log(participant_id);
    var counter = 0;
    $.each($('.input-data'), function(){
      if($(this).val() == ''){
        $(this).css("border-color","red");
      counter++;
      }else{
         $(this).css("border-color", "");
         if($(this).attr('class') == "email_address input-data"){
          if(isEmail($(this).val()) == false){
            $(this).css("border-color","red");
            counter++;
          }else{
             $(this).css("border-color", "");
          }
        }
      }
    });

    if(counter == 0){
    $('#btn_back').show();
    var current = $('ul.active');  

    $('ul').removeClass('active');
    current.next().addClass('active'); 
    if(current.attr("class") == "step-2"){
      $('#btn_next').hide();
      $('#btn_submit').show();
    }     
    if(current.attr("class") == "step-1" || current.attr("class") == "step-2"){
      if(current.attr("class") == "step-1"){
        data = $('#step_1_form').serialize();
        url = "add_participant.php";
      }else{
        data = $('#step_2_form').serialize();
        url = "update_participant.php";
      }
      console.log('here');
      $.ajax({
        url:url,
        type:"POST",
        data:data,
        dataType:"JSON",
        success:function(data){
          participant_id = data;
          $('.participant_id').val(data);  
          //console.log(test);
        },error: function (data) {
          console.log(data);
        },

      });
      //$('#step_1_form').trigger('submit');
    }
  }

  });

  $('input[name=notify_partner]').on('change click', function() {
    //value =  $('#notify_partner').find(":selected").text();
    var value = $( 'input[name=notify_partner]:checked' ).val();
    console.log(value);
    if(value == "Yes"){
      $('.full_name').show();
      $('#full_name').val('');
    }else{
      $('.full_name').hide();
      $('#full_name').val('');

    }
  });


// Cloning Form
id_count = 1;
id_count2 = 2;

$('#add_more').on('click', function() {
  var source = $('.form-holder:first'), clone = source.clone();
  clone.find(':input').attr('id', function(i, val) {
    return val + id_count;
  });
  clone.find("input:text").val("").end();
  clone.find('.person').text('Person '+ (id_count + 1));
  clone.appendTo('.form-holder-append');
  id_count++;
  id_count2++;

});

$('#btn_submit').on('click', function(){
  //value =  $('#notify_partner').find(":selected").text();
  var value = $( 'input[name=notify_partner]:checked' ).val();
  if(value == "No"){
        $('#btn_submit').attr('disabled', true);
        $.ajax({
        url:"update_participant.php",
        type:"POST",
        data:$('#step_3_form').serialize() + '&participant_id=' + participant_id,
        //dataType:"JSON",
        success:function(data){
           location.href = "notification.php";
        }
      });    
  }else{
    if($('#full_name').val() == ""){
      $('#full_name').css("border-color","red");
    }else{
          $('#btn_submit').attr('disabled', true);
           $('#full_name').css("border-color","");
          $.ajax({
          url:"update_participant.php",
          type:"POST",
          data:$('#step_3_form').serialize() + '&participant_id=' + participant_id,
          //dataType:"JSON",
          success:function(data){
             location.href = "notification.php";
          }
        });    
    }
  } 

});

// Removing Form Field
$('body').on('click', '.remove', function() {
  var closest = $(this).closest('.form-holder').remove();

});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script> 
<?php include "inc/footer.php"; ?>