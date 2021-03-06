(function($){
  $.fn.pushLink = function(settings){
    settings = $.extend({
      isDisableRead: false,
    }, settings);

    return this.each(function(){
      var linkUrl = $(this).attr('data-location-url');
      var notifyId = $(this).attr('data-notify-id');
      $(this).click(function(){
        if ( false == settings.isDisableRead )
        {
          $.getJSON( openpne.apiBase + 'push/read.json' , { 'id': notifyId, 'apiKey': openpne.apiKey }, function(d){
            window.location = linkUrl;
          });
        }
        else
        {
          window.location = linkUrl;
	}
      });
    });
  };

  $.fn.friendLink = function(settings){
    return this.each(function(){
      $(this).click(function(){
        $(this).parent().find('button').hide();
        $(this).siblings('.ncfriendloading').show();
        var pushElement = $(this).parents('.push');
        var memberId = pushElement.attr('data-member-id');
        var notifyId = pushElement.attr('data-notify-id');
        $.getJSON( openpne.apiBase + 'push/read.json' , { 'id': notifyId, 'apiKey': openpne.apiKey }, function(d){});
        $.ajax({
          url: openpne.apiBase + 'member/friend_accept.json',
          type: 'GET',
          data: 'member_id=' + memberId + '&apiKey=' + openpne.apiKey,
          dataType: 'json',
          success: function(data) {
            if(data.status=='success'){
              $('.ncfriendloading').hide();
              $(this).parent().find('.ncfriendresultmessage').text('リクエストを承認しました');
              $(this).parent().find('.ncfriendresultmessage').show();
            }else{
              alert(data.message);
            }
          },
          error: function(r, s, e){
            $('.ncfriendloading').hide();
            $(this).parent().find('.ncfriendresultmessage').text('既に承認済みです');
            $(this).parent().find('.ncfriendresultmessage').show(); 
          }
        });
      });
    });
  };

  $.fn.friendUnlink = function(settings){
    return this.each(function(){
      $(this).click(function(){
        $(this).parent().find('button').hide();
        $(this).siblings('.ncfriendloading').show();
        var pushElement = $(this).parents('.push');
        var memberId = pushElement.attr('data-member-id');
        var notifyId = pushElement.attr('data-notify-id');
        $.getJSON( openpne.apiBase + 'push/read.json' , { 'id': notifyId, 'apiKey': openpne.apiKey }, function(d){});
        $.ajax({
          url: openpne.apiBase + 'member/friend_reject.json',
          type: 'GET',
          data: 'member_id=' + memberId + '&apiKey=' + openpne.apiKey,
          dataType: 'json',
          success: function(data) {
            if(data.status=='success'){
              $('.ncfriendloading').hide();
              $('.ncfrinedresultmessage', $(this).parent()).text('リクエストを拒否しました');
              $('.ncfrinedresultmessage', $(this).parent()).show();
             }else{
              alert(data.message);
            }   
          },
          error: function(r, s, e) {
            $('.ncfriendloading').hide();
            $(this).parent().find('.ncfriendresultmessage').text('既に拒否済みです');
            $(this).parent().find('.ncfriendresultmessage').show(); 
          }
        });
      });
    });
  };
})(jQuery);
