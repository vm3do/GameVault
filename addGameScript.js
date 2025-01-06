const manageUsersModal = document.getElementById("manageUsersModal");
    const addGameModal = document.getElementById("addGameModal");

    function openModal() {
        manageUsersModal.classList.remove("hidden");
    }   
    function closeModal() {
        manageUsersModal.classList.add("hidden");
    }   
    function openAddGameModal() {
        addGameModal.classList.remove("hidden");
    }   
    function closeAddGameModal() {
        addGameModal.classList.add("hidden");
    }


let apiKey = "7e629840eefe48f79499c2882b4bb911";

document.querySelector("#fetchButton").addEventListener('click', ()=> {
    let title = document.querySelector('#gameTitle').value.toLowerCase();
    fetch( `https://api.rawg.io/api/games/${title}?key=7e629840eefe48f79499c2882b4bb911` )
    .then(response => {


        if(!response.ok){
            throw new Error("couldnt fetch data")
        }
        return response.json()

    })
    .then(data => {
        console.log(data)
        document.querySelector("#gameGenre").value = data.genres.length > 0 ? data.genres[0]['name'] : "null"
        document.querySelector("#description").value = data.description_raw
        
        document.querySelector("#releaseDate").value = data.released
        document.querySelector("#background").value = data.background_image
        
        
    })
    .catch(error => console.log(error))
})
