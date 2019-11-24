const uploadForm = document.getElementById("uploadForm");
const inpFile = document.getElementById("inpFile");
const progressBarFill = document.querySelector("#progressBar > .determinate");
const table = document.querySelector("#Table > tbody");

uploadForm.addEventListener("submit", uploadFile);

function uploadFile(e)
{
    e.preventDefault();

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/api/upload.php");
    xhr.upload.addEventListener("progress", e => {
        const percent = e.lengthComputable ? (e.loaded / e.total) * 100 : 0;
        progressBarFill.style.width = percent.toFixed(2) + "%";
        if (percent.toFixed(2) == 100)
        {
            progressBarFill.className = "indeterminate";
        }
    });

    xhr.onreadystatechange = function() {
        progressBarFill.className = "determinate";
        progressBarFill.style.width = "0%";
        
        if (this.readyState == 4 && this.status == 200) 
        {
            jsonToTable(JSON.parse(this.responseText));
        }
    }
    
    xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send(new FormData(uploadForm));
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
            const cell2 = row.insertCell(1);

            cell1.innerHTML = data[i].file.toUpperCase();
            if (data[i].message == "Successful")
            {
                cell2.innerHTML = "<a class='card-link' href='/watch.html?v=" + data[i].video + "'>" + data[i].message + "</a>";
            } else
            {
                cell2.innerHTML = data[i].message;
            }
        }
    }
}