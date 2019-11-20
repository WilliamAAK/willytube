
function loadBtn()
{
    let video = document.getElementById('video');

    video.src = "/api/watch.php?action=stream&video=123";

    video.play();
}

loadBtn();




/* setTimeout(function() {  
    video.pause();

    source.setAttribute('src', '/api/video.php'); 

    video.load();
    video.play();
}, 3000);
 */