const DOM = {
    init: () => {
        DOM.fillTable();
    },
    fillTable: () => {
        fetch('/images')
            .then(response => response.json())
            .then(json_response => {
                let tableBody = document.querySelector('#table-body');
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
                            HTML += `<tr>`
                            HTML += `<th>${image.id}</th>`
                            HTML += `<td>${image.author}</td>`
                            HTML += `<td>${image.name}</td>`
                            HTML += `<td>${viewCount}</td>`
                            HTML += `</tr>`
                            tableBody.innerHTML += HTML;
                        })
                }
            })
    }
}

DOM.init();

