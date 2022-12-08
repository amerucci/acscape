function modal() {
    const the_rooms = document.querySelector('.the_rooms');
    const frisk = document.querySelector('.frisk');
    const furniture_modal = document.querySelector('.furniture_modal');


    the_rooms.addEventListener('click', function () {
        document.querySelector('#roomsModal').classList.add('show');
        document.querySelector('#roomsModal').style.display = 'block';
    });
    frisk.addEventListener('click', function () {
        document.querySelector('#friskModal').classList.add('show');
        document.querySelector('#friskModal').style.display = 'block';
        document.querySelector('#friskModal').style.opacity = '1';
    });
    furniture_modal.addEventListener('click', function () {
        document.querySelector('#furnitureModal').classList.add('show');
        document.querySelector('#furnitureModal').style.display = 'block';
        document.querySelector('#friskModal').style.opacity = '0';


    });
    const close = document.querySelectorAll('.close');
    close.forEach(element => {
        element.addEventListener('click', function () {
            document.querySelector('#roomsModal').classList.remove('show');
            document.querySelector('#roomsModal').style.display = 'none';
            document.querySelector('#friskModal').classList.remove('show');
            document.querySelector('#friskModal').style.display = 'none';
            document.querySelector('#furnitureModal').classList.remove('show');
            document.querySelector('#furnitureModal').style.display = 'none';

        });
    });
};
modal();

let countdown = 60 * 60; // 60 minutes (temps exprimé en secondes)
// let countdown = 10;
function updateCountdown() {
    countdown--;

    let minutes = Math.floor(countdown / 60);
    let seconds = countdown % 60;

    // Formater les minutes et les secondes avec des zéros au début (pour obtenir un format 00:00)
    minutes = minutes.toString().padStart(2, "0");
    seconds = seconds.toString().padStart(2, "0");

    if (countdownElement = document.getElementById("countdown") != null) {
        countdownElement = document.getElementById("countdown");

        if (countdown < 0) {
            const endgame_lose = document.querySelector('.endgame_lose');
            endgame_lose.classList.remove('dnone');
            return;
        }
    }

    countdownElement.innerHTML = minutes + ":" + seconds;
}
setInterval(updateCountdown, 1000);

let dataGlobal = []; // variable globale dataGlobal

// fetch pour récupérer le json dans /acscape/ingame/data with await and async
async function getData() {
    const response = await fetch('/acscape/ingame/data');
    if (response.ok) {
        const data = await response.json();
        dataGlobal = data['data']; // les données de dataGlobal
    } else {
        // l'appel fetch a échoué
        console.error('Erreur lors de la récupération des données :', response.statusText);
    }
}
// appeler la fonction asynchrone getData() et attendre qu'elle se termine
async function main() {
    await getData();
}

main()
    .then(toto => {
        console.log(dataGlobal.room[0].title); // devrait afficher le titre de la salle
        console.log(dataGlobal); // affiche le tableau global
    })
    .catch(error => {
        console.error(error);
    });