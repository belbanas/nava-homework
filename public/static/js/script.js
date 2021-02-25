const DOM = {
    init: () => {
        DOM.fillTable();
        DOM.submitBtnHandler();
    },
    fillTable: () => {
        fetch('/images')
            .then(response => response.json())
            .then(json_response => {
                let tableBody = document.querySelector('#table-body');
                tableBody.innerHTML = "";
                for (let image of json_response.result) {
                    let viewCount = 0;
                    fetch('images/' + image.id + "/count")
                        .then(resp => resp.json())
                        .then(json_resp => {
                            if (json_resp.view_count) {
                                viewCount = json_resp.view_count
                            } else {
                                console.log(json_resp);
                            }
                            let HTML = "";
                            HTML += `<tr id="${image.id}">`
                            HTML += `<th>${image.id}</th>`
                            HTML += `<td>${image.author}</td>`
                            HTML += `<td>${image.name}</td>`
                            HTML += `<td>${viewCount}</td>`
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
                            tableBody.innerHTML += HTML;
                        })
                        .then(DOM.deleteBtnHandler)
                        .then(DOM.editBtnHandler)
                }
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
    submitBtnHandler: () => {
        let submitBtn = document.getElementById("submit-btn");
        submitBtn.addEventListener('click', () => {
            let name = document.getElementById("name").value;
            let author = document.getElementById("author").value;
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
        });
    },
    editBtnHandler: () => {
        let editBtns = document.querySelectorAll(".edit-btn");
        for (let editBtn of editBtns) {
            editBtn.addEventListener("click", () => {
                console.log("hello!");
                let nameContainer = document.querySelector('#name');
                let authorContainer = document.querySelector('#author');
                nameContainer.value = editBtn.dataset.name;
                authorContainer.value = editBtn.dataset.author;
            })
        }
    }
}

DOM.init();

