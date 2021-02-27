const DOM = {
    init: () => {
        DOM.fillTable();
        DOM.updateBtnHandler();
    },
    fillTable: () => {
        DOM.imageIdToUpdate = null;
        document.getElementById("name").value = null;
        document.getElementById("author").value = null;
        document.querySelector(".alert-place").innerHTML = "";
        fetch('/images')
            .then(response => response.json())
            .then(json_response => {
                let tableBody = document.querySelector('#table-body');
                tableBody.innerHTML = "";
                let HTML = "";
                for (let image of json_response.result) {
                    HTML += `<tr id="${image.id}">`
                    HTML += `<th>${image.id}</th>`
                    HTML += `<td>${image.author}</td>`
                    HTML += `<td>${image.name}</td>`
                    HTML += `<td>${image.view_count}</td>`
                    HTML += `<td><span class="dropdown">
                                    <span class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Menü
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><span class="dropdown-item edit-btn" data-id="${image.id}" data-name="${image.name}" data-author="${image.author}">Módosítás</span></li>
                                        <li><span class="dropdown-item del-btn" data-id="${image.id}">Törlés</span></li>
                                        <li><a class="dropdown-item" href="/images/${image.id}">Megtekintés</a></li>
                                    </ul>
                                    </span></td>`
                    HTML += `</tr>`
                }
                tableBody.innerHTML = HTML;
                DOM.deleteBtnHandler();
                DOM.editBtnHandler();
            })
    },
    deleteBtnHandler: () => {
        let deleteBtns = document.querySelectorAll('.del-btn');
        for (let btn of deleteBtns) {
            btn.addEventListener('click', () => {
                fetch('/images/' + btn.dataset.id, {
                    method: 'DELETE'
                })
                    .then(response => response.json())
                    .then(response => console.log(response))
                let row = document.getElementById(btn.dataset.id);
                row.parentNode.removeChild(row);
            })
        }
    },
    imageIdToUpdate: null,
    editBtnHandler: () => {
        let editBtns = document.querySelectorAll(".edit-btn");
        for (let editBtn of editBtns) {
            editBtn.addEventListener("click", () => {
                let nameContainer = document.querySelector('#name');
                let authorContainer = document.querySelector('#author');
                nameContainer.value = editBtn.dataset.name;
                authorContainer.value = editBtn.dataset.author;
                DOM.imageIdToUpdate = editBtn.dataset.id;
            })
        }
    },
    sendImage: (name, author) => {
        fetch('/images', {
            method: 'POST',
            headers: {
                'content-type': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                author: author
            })
        })
            .then(response => response.json())
            .then(json_resp => {
                console.log(json_resp)
                DOM.fillTable();
            })
    },
    updateImage: (name, author) => {
        fetch('/images/' + DOM.imageIdToUpdate, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify({
                name: name,
                author: author
            })
        })
            .then(response => response.json())
            .then(json => console.log(json))
            .then(DOM.fillTable)
    },
    updateBtnHandler: () => {
        let updateBtn = document.querySelector('#update-btn');
        updateBtn.addEventListener("click", () => {
            let name = document.getElementById("name").value;
            let author = document.getElementById("author").value;
            if (name === "" || author === "") {
                DOM.alertHandler();
            } else {
                DOM.imageIdToUpdate === null ? DOM.sendImage(name, author) : DOM.updateImage(name, author);
            }
        })
    },
    alertHandler: () => {
        let alert = document.querySelector(".alert-place");
        alert.innerHTML = `<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
                <strong>Hiba! </strong>Kérlek mindkét mezőt töltsd ki!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
    }
}

DOM.init();

