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
let dataGlobalUnlock = [] // variable globale dataGlobal deverouillé


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

let room_open
let openRoomCalled = false;


main()
    .then(data => {

        dataGlobalUnlock.push(dataGlobal);


        for (let i = 0; i < dataGlobal.room.length; i++) {



            li = document.createElement('li');
            li.classList.add('rooms_list_item', `nb-${i}`);
            li.innerHTML = dataGlobalUnlock[0].room[i].title;
            roomsList.appendChild(li);

            let roomsArray = [];
            for (let j = 3; j < roomsList.childNodes.length; j++) {
                roomsArray.push(roomsList.childNodes[j]);
            }

            if (dataGlobal.room[i]['padlock'] == "yes" && roomsArray[i].classList.contains('room_unlock_open') == false) {
                roomsList.appendChild(li).style.color = 'red';
            } else {
                roomsList.appendChild(li).style.color = 'black';
            }

            roomsArray[i].addEventListener('click', function () {


                if (dataGlobalUnlock[0].room[i]['padlock'] == "no") {
                    roomsArray[i].classList.add('room_unlock_open');
                    const modal = document.createElement('div');
                    modal.classList.add('modal', 'fade', 'modal-lg');
                    modal.setAttribute('id', 'roomsOpen');
                    modal.classList.add('room_open');
                    modal.setAttribute('tabindex', '-1');
                    modal.setAttribute('role', 'dialog');
                    modal.setAttribute('aria-labelledby', 'roomsModalOpenLabel');
                    modal.setAttribute('aria-hidden', 'true');
                    modal.innerHTML = `
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modalRoomOpen">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title  mx-auto" id="roomsModalOpenLabel">${this.innerHTML} est ouverte</h5>
                                                            <button type="button" class="closeOpen" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                                                    </iconify-icon>
                                                                </span>
                                                        </div>
                                                            <div class="modal-body">
                                                                <p>${dataGlobal.room[i].reward}</p>
                                                            </div>
                                                    </div>
                                                </div>`;
                    document.body.appendChild(modal);
                    const roomsOpenModal = new bootstrap.Modal(modal);
                    roomsOpenModal.show();

                    const closeOpen = document.querySelectorAll('.closeOpen');
                    const backdrop = document.querySelector('.modal-backdrop');
                    const modalRoomOpen = document.querySelector('.modalRoomOpen');
                    const roomsOpen = document.querySelector('#roomsOpen');

                    function room_modalOpen_remove() {
                        roomsOpen.remove();
                        backdrop.remove();
                    }

                    closeOpen.forEach(element => {
                        element.addEventListener('click', function () {
                            room_modalOpen_remove();
                        });
                    });

                    roomsOpen.addEventListener('click', function () {
                        if (!modalRoomOpen.contains(event.target)) {
                            backdrop.remove();
                            roomsOpen.remove();
                            modalRoomOpen.remove();
                        }
                    });

                }

                if (dataGlobal.room[i]['padlock'] == "yes" && roomsArray[i].classList.contains('room_unlock_open') == false) {

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
                                           <p class="clue_show1">Indice :</p>
                                           <p class="clue_show_content dnone">${dataGlobal.room[i]['clue']}</p>            
                                        </div>
                                    <input type="text" class="form-control" id="rooms_unlock_key" placeholder="Entrer la clé pour ${this.innerHTML} ">
                                    <p class="room_control_key"></p>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" id="rooms_unlock_btn">Déverrouiller</button>
                                    <p class="reward dnone"></p>
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

                    function room_modal_remove() {
                        roomsLock.remove();
                        backdrop.remove();
                    }

                    closeLock.forEach(element => {
                        element.addEventListener('click', function () {
                            room_modal_remove();
                        });
                    });

                    roomsLock.addEventListener('click', function () {
                        if (!modalRoomLock.contains(event.target)) {
                            backdrop.remove();
                            roomsLock.remove();
                        }
                    });

                    const clue_show1 = document.querySelector('.clue_show1');
                    const clue_show_content1 = document.querySelector('.clue_show_content');

                    clue_show1.addEventListener('click', function () {
                        clue_show_content1.classList.remove('dnone');
                        if (clue_show_content1.innerHTML == "null") {
                            clue_show_content1.innerHTML = 'Pas d\'indice';
                        }
                    });

                    const rooms_unlock_key = document.querySelector('#rooms_unlock_key');
                    const room_control_key = document.querySelector('.room_control_key');
                    const rooms_unlock_btn = document.querySelector('#rooms_unlock_btn');
                    const reward = document.querySelector('.reward');
                    let room_try = 3;
                    rooms_unlock_btn.addEventListener('click', function () {
                        if (rooms_unlock_key.value == dataGlobal.room[i]['unlock_word']) {
                            room_control_key.innerHTML = 'Clé valide';
                            reward.classList.remove('dnone');
                            reward.innerHTML = `${dataGlobal.room[i]['reward']}`;
                            dataGlobal.room[i]['padlock'] = "no";
                            dataGlobal.room[i]['unlock_word'] = null;
                            roomsArray[i].classList.add('room_unlock_open');
                            roomsArray[i].style.color = 'black';
                            dataGlobalUnlock.push(dataGlobal);
                            if (dataGlobalUnlock.length > 1) {
                                dataGlobalUnlock.pop();
                            }
                            setTimeout(room_modal_remove, 2000);

                        } else {
                            room_try--;
                            room_control_key.innerHTML = `Clé invalide ! Encore ${room_try} essais avant une pénalité de 5 minutes`;
                            if (room_try == 0) {
                                room_control_key.innerHTML = `Dommage vous avez une pénalité de 5 minutes !`;
                                room_try = 3;
                                countdown = countdown - 300;
                            }

                        }
                    });
                    document.addEventListener('keydown', function (e) {
                        if (e.key == 'Enter') {
                            rooms_unlock_btn.click();
                        }
                    });

                };
            })
        }
    })
    .catch(error => {
        console.error(error);
    });