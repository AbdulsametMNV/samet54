document.addEventListener("DOMContentLoaded", function () {
    fetch('static/data/mythology.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const contentDivs = document.querySelectorAll('.content');

            contentDivs.forEach(div => {
                const entity = div.getAttribute('data-entity');
                if (data[entity]) {
                    div.innerHTML = `
                        <h3>${data[entity].name}</h3>
                        <p>${data[entity].description}</p>
                    `;
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
