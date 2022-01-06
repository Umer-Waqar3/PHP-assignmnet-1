$(document).ready(function(){
    $('button[name="edit"]').click(function(){
      $('input[name="image2"]').val($(this).prev().prev().prev().prev().prev().val()); 
      $('input[name="name1"]').val($(this).prev().prev().prev().prev().val()); 
      $('input[name="publisher1"]').val($(this).prev().prev().prev().val()); 
      $('input[name="isbn1"]').val($(this).prev().prev().val()); 
      $('input[name="id"]').val($(this).prev().val()); 
      $( '#form1' ).css( "display","none" );
      $( '#form2' ).css( "display","block" );
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
  });

function edit(){
  $( '#form2' ).css( "display","none" );
  $( '#form1' ).css( "display","block" );
};

$(document).ready(function(){
  $('input[name="delete"]').click(function(){
    $(this).css("display","none");
    $(this).prev().css("display","block");
    
  });
});

$(document).ready(function(){
  $('input[name="cancel"]').click(function(){
    $(this).parent().css("display","none");
    $(this).parent().next().css("display","block");
  });
});
