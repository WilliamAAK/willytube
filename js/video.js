const params = getSearchParameters();

loadVideo();
loadVideoTitle();

function loadVideo()
{
    let video = document.getElementById('video');

    video.src = "/api/watch.php?action=stream&video=" + params.v;

    video.play();
}

function getSearchParameters() {
    var prmstr = window.location.search.substr(1);
    return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
  var params = {};
  var prmarr = prmstr.split("&");
  for ( var i = 0; i < prmarr.length; i++) {
      var tmparr = prmarr[i].split("=");
      params[tmparr[0]] = tmparr[1];
  }
  return params;
}


function loadVideoTitle()
{
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "/api/watch.php?action=details&video=" + params.v);

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const json = JSON.parse(this.responseText)
            document.getElementById("videoTitle").innerHTML = json["title"];
        }
    }
    
    //xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send();
}