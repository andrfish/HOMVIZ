

$('#watch').on('click', function(){
  $(this).css('display','none')
  $('#video').css('display','block')
  keepuserinfo()
});

var player, playing = false;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('video', {
        height: '600',
        width: '640',
        videoId: 'okcfxtIIQdU',
        events: {
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerStateChange(event) {

  if (event.data == YT.PlayerState.PLAYING) {
    console.log('start')
     videoInteractionFeedback('started '+time())
     playing = true;
    }

  else if(event.data == YT.PlayerState.PAUSED){
        videoInteractionFeedback('paused '+time())
        console.log('paused')
        playing = false;
   }

}

$(document).ready(function(){
})

function keepuserinfo(){
      var token = $('input[name=_token]').attr('value');

    $.ajax({

        url: "/userwatchingvideo",
        type:"POST",
        data: { '_token': token},

        success:function(data){


        },error:function(e){


        }

    });
}

function videoInteractionFeedback(text_data){

    var token = $('input[name=_token]').attr('value');

    $.ajax({

        url: "/userwatchingvideo",
        type:"POST",
        data: { '_token': token,'text_data':text_data},

        success:function(data){

        },error:function(e){

        }

    });

}

function time(){
  let d = new Date();
  return d.getTime()
}