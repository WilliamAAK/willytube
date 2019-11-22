const table = document.querySelector("#Table > tbody");

function loadPosts()
{
    const xhr = new XMLHttpRequest();

    xhr.open("GET", getPreferredServer() +"/api/posts.php?action=listRecent");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            jsonToTable(JSON.parse(this.responseText));
        }
    }

    xhr.send();
}

function jsonToTable(data) {

    table.innerHTML = "";

    if(data.message) {
        const row = table.insertRow(0);
        const cell1 = row.insertCell(0);
        cell1.innerHTML = data.message;
        return;
    }

    for (var i = 0; i < Object.keys(data).length; i++) {

        if (true) {

            const row = table.insertRow(0);
            const cell1 = row.insertCell(0);

            cell1.innerHTML = "<a class='' href='/watch.html?v=" + data[i].uid + "'>" + data[i].title + "</a>";
        }
    }
}

window.onload = function() {
    loadPosts();
}