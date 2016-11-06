//Delete
var msgBox = $('#message-box').messageBox();

$('.delete-article').click(function(){
   var self = $(this);
   var id = self.attr('id');
   var msg = "Сигурни ли сте, че искате да изтриете избраната публикация?";

   function fnYes(){
       $.ajax({
           url: "/articles/delete/" + id,
           method : "post",
           success: function(){
               self.parent().remove();
               msgBox.hide();
           }
       });
   }

    function fnNo(){
       msgBox.hide();
    }


    msgBox.prompt(msg, fnYes, fnNo);
});


