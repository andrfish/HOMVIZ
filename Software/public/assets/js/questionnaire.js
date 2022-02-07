var timeElapsed = 0;
var myTimer;

$('#start').on('click', function(){
	$(this).css('display','none')
    $('form').css('display','block')
    start()
});

function tick(){
	console.log('here')
    timeElapsed++;
    $('#stopwatch').attr('value',timeElapsed)
}
function start(){
    //call the first setInterval
    myTimer = setInterval(tick, 1000);
}