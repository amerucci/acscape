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

let li

const roomsList = document.querySelector('.rooms_list');

async function getData() {
    try {
        const response = await fetch('/acscape/ingame/data');
        if (response.ok) {
            const data = await response.json();
            dataGlobal = data.data; // les données global
            return dataGlobal;
        } else {
            console.error('Erreur lors de la récupération des données :', response.statusText);
        }
    } catch (error) {
        console.error('Erreur lors du chargement des données :', error);
    }
}

async function main() {
    const data = await getData();
    console.log(data); // affiche la valeur retournée par getData()
}

main()
    .then(data => {
        for (let i = 0; i < dataGlobal.room.length; i++) {

            li = document.createElement('li');
            li.classList.add('rooms_list_item', `nb-${i}`);
            li.innerHTML = dataGlobal.room[i].title;
            roomsList.appendChild(li);
            if (dataGlobal.room[i]['padlock'] == "yes") {
                roomsList.appendChild(li).style.color = 'red';
            }
            if (dataGlobal.room[i]['padlock'] == "no") {
                roomsList.appendChild(li).style.color = 'black';
            }

            let roomsArray = [];
            for (let j = 3; j <= 10; j++) {
                roomsArray.push(roomsList.childNodes[j]);
            }
            if (dataGlobal.room[i]['padlock'] == "yes") {
                roomsArray[i].addEventListener('click', function () {

                    console.log(dataGlobal.room[i]['clue']);

                    const modal = document.createElement('div');
                    modal.classList.add('modal', 'fade', 'modal-lg');
                    modal.setAttribute('id', 'roomsLock');
                    modal.setAttribute('tabindex', '-1');
                    modal.setAttribute('role', 'dialog');
                    modal.setAttribute('aria-labelledby', 'roomsModalLockLabel');
                    modal.setAttribute('aria-hidden', 'true');
                    modal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modalRoomLock">
                            <div class="modal-header">
                                <h5 class="modal-title  mx-auto" id="roomsModalLockLabel">${this.innerHTML} est fermée</h5>
                                <button type="button" class="closeLock" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                        </iconify-icon>
                                    </span>
                            </div>
                                <div class="modal-body">
                                    <p>Vous devez trouver la clé pour accéder à cette pièce</p>
                                        <div class="d-flex gap-2 clue_show">
                                           <p class="clue_show">Indice :</p>
                                           <p class="clue_show_content dnone">${dataGlobal.room[i]['clue']}</p>            
                                        </div>
                                    <input type="text" class="form-control" id="rooms_unlock_key" placeholder="Entrer la clé pour ${this.innerHTML} ">
                                    <p class="room_control_key"></p>
                                </div>
                        </div>
                    </div>`;
                    document.body.appendChild(modal);
                    const roomsModal = new bootstrap.Modal(modal);
                    roomsModal.show();
                    const closeLock = document.querySelectorAll('.closeLock');
                    const backdrop = document.querySelector('.modal-backdrop');
                    const modalRoomLock = document.querySelector('.modalRoomLock');
                    const roomsLock = document.querySelector('#roomsLock');

                    closeLock.forEach(element => {
                        element.addEventListener('click', function () {
                            roomsLock.classList.remove('show');
                            roomsLock.style.display = 'none';
                            roomsLock.remove();
                            backdrop.remove();
                            // roomsModal.remove();
                        });
                    });

                    roomsLock.addEventListener('click', function () {
                        console.log('parent');
                        if (!modalRoomLock.contains(event.target)) {
                            console.log('enfant')
                            backdrop.remove();
                            roomsLock.remove();
                        }
                    });

                    const clue_show = document.querySelector('.clue_show');
                    const clue_show_content1 = document.querySelector('.clue_show_content');

                    clue_show.addEventListener('click', function () {
                        clue_show_content1.classList.remove('dnone');
                        if (clue_show_content1.innerHTML == "null") {
                            clue_show_content1.innerHTML = 'Pas d\'indice';
                        }
                    });

                    const rooms_unlock_key = document.querySelector('#rooms_unlock_key');
                    const room_control_key = document.querySelector('.room_control_key');
                    rooms_unlock_key.addEventListener('keyup', function () {
                        if (rooms_unlock_key.value == dataGlobal.room[i]['unlock_word']) {
                            room_control_key.innerHTML = 'Clé valide';
                        } else {
                            room_control_key.innerHTML = 'Clé invalide';
                        }
                    });



                });

            }
        }



    })
    .catch(error => {
        console.error(error);
    });