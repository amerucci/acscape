function modal() {
    const the_rooms = document.querySelector('.the_rooms');
    const frisk = document.querySelector('.frisk');
    // const furniture_modal = document.querySelector('.furniture_modal');


    the_rooms.addEventListener('click', function () {
        document.querySelector('#roomsModal').classList.add('show');
        document.querySelector('#roomsModal').style.display = 'block';
    });
    frisk.addEventListener('click', function () {
        document.querySelector('#friskModal').classList.add('show');
        document.querySelector('#friskModal').style.display = 'block';
        document.querySelector('#friskModal').style.opacity = '1';
    });
    // furniture_modal.addEventListener('click', function () {
    //     document.querySelector('#furnitureModal').classList.add('show');
    //     document.querySelector('#furnitureModal').style.display = 'block';
    //     document.querySelector('#friskModal').style.opacity = '0';


    // });
    const close = document.querySelectorAll('.close');
    close.forEach(element => {
        element.addEventListener('click', function () {
            document.querySelector('#roomsModal').classList.remove('show');
            document.querySelector('#roomsModal').style.display = 'none';
            document.querySelector('#friskModal').classList.remove('show');
            document.querySelector('#friskModal').style.display = 'none';
            // document.querySelector('#furnitureModal').classList.remove('show');
            // document.querySelector('#furnitureModal').style.display = 'none';

        });
    });
};
modal();
// furniture modal disabled in construction 

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

let dataGlobal = []; // variable globale dataGlobal
let dataGlobalUnlock = [] // variable globale dataGlobal deverouillé


let roomID = 0;
let li_room
const roomsList = document.querySelector('.rooms_list');
const penality = document.querySelector('.penality');
const navInGameTitle = document.querySelector('.room_active');
let room_open
let openRoomCalled = false;


let li_furniture
const furnitureList = document.querySelector('.furniture_list')
const frisk_btn = document.querySelector('.frisk_btn')


main()
    .then(data => {

        dataGlobalUnlock.push(dataGlobal);


        for (let i = 0; i < dataGlobal.room.length; i++) {



            li_room = document.createElement('li');
            li_room.classList.add('rooms_list_item', `nb-${i}`);
            li_room.innerHTML = dataGlobalUnlock[0].room[i].title;
            roomsList.appendChild(li_room);

            let roomsArray = [];
            for (let j = 3; j < roomsList.childNodes.length; j++) {
                roomsArray.push(roomsList.childNodes[j]);
            }


            if (dataGlobal.room[i]['padlock'] == "yes" && roomsArray[i].classList.contains('room_unlock_open') == false) {
                roomsList.appendChild(li_room).style.color = 'red';
            } else {
                roomsList.appendChild(li_room).style.color = 'black';
            }





            roomsArray[i].addEventListener('click', function (roomClick) {


                if (dataGlobalUnlock[0].room[i]['padlock'] == "no") {
                    navInGameTitle.innerHTML = dataGlobalUnlock[0].room[i].title;

                    const rooms_list_item = document.querySelectorAll('.rooms_list_item');
                    rooms_list_item.forEach(element => {
                        element.classList.remove('activeR');
                    });
                    roomsArray[i].classList.add('activeR');





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

                    if (roomsArray[i].classList.contains('activeR') && roomID == roomID) {
                        roomID = dataGlobal.room[i].id;
                        console.log("bien changé l'id de la room");
                    }

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
                                   
                                        <div class="d-flex gap-2 clue_show">
                                           <div class="d-flex flex-column w-100">
                                               <div class="d-flex gap-3 justify-content-center">
                                                   <button class="clue_show1 my-2">Indice 1</button>
                                                     <button class="clue_show2 my-2" disabled>indice 2</button>
                                                        <button class="clue_show3 my-2" disabled>indice 3</button>
                                               </div>
                                               <div class="d-flex gap-2 justify-content-center">
                                                   <p class="clue_show1_content dnone">${dataGlobal.room[i]['clue']}</p>
                                                        <p class="clue_show2_content dnone ">${dataGlobal.room[i]['clue2']}</p>
                                                        <p class="clue_show3_content dnone">${dataGlobal.room[i]['clue3']}</p>
                                               </div>    
                                                                                       </div>
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
                    const clue_show_content1 = document.querySelector('.clue_show1_content');
                    const clue_show2 = document.querySelector('.clue_show2');
                    const clue_show_content2 = document.querySelector('.clue_show2_content');
                    const clue_show3 = document.querySelector('.clue_show3');
                    const clue_show_content3 = document.querySelector('.clue_show3_content');
                    let t = 0;
                    let tl = 0;


                    function removeToptoBottom() {
                        setTimeout(() => {
                            penality.classList.remove('topToBottom');
                        }, 2000);
                    }

                    if (clue_show_content1.innerHTML == "null") {
                        clue_show1.classList.add('dnone');
                        clue_show2.classList.add('dnone');
                        clue_show3.classList.add('dnone');
                    }

                    if (clue_show_content2.innerHTML == "null") {
                        clue_show2.classList.add('dnone');
                        clue_show3.classList.add('dnone');
                    }

                    if (clue_show_content3.innerHTML == "null") {
                        clue_show3.classList.add('dnone');
                    }

                    clue_show1.addEventListener('click', function () {

                        clue_show_content1.classList.toggle('dnone');
                        clue_show_content2.classList.add('dnone');
                        clue_show2.classList.add('timelaps');
                        clue_show_content3.classList.add('dnone');
                        if (clue_show2.classList.contains('timelaps') && tl == 0) {
                            tl++;
                            setTimeout(function () {
                                clue_show2.disabled = false;
                            }, 5000);
                        }
                        if (!dataGlobalUnlock[0].room[i].clue1Found) {
                            if (t == 0) {
                                t++;
                                penality.classList.add('topToBottom');
                                penality.textContent = "-30 sec";
                                countdown = countdown - 30;
                                removeToptoBottom()
                                dataGlobalUnlock[0].room[i].clue1Found = "yes";

                            }
                        }


                        if (clue_show_content1.innerHTML == "null") {
                            clue_show_content1.innerHTML = 'Pas d\'indice';
                        }
                    });


                    clue_show2.addEventListener('click', function () {


                        clue_show_content2.classList.toggle('dnone');
                        clue_show_content1.classList.add('dnone');
                        clue_show_content3.classList.add('dnone');
                        clue_show3.classList.add('timelaps');
                        if (clue_show3.classList.contains('timelaps') && tl == 1) {
                            tl++;
                            setTimeout(function () {
                                clue_show3.disabled = false;
                            }, 5000);
                        }
                        if (!dataGlobalUnlock[0].room[i].clue2Found) {
                            if (t == 1) {
                                t++;
                                penality.classList.add('topToBottom');
                                penality.innerHTML = "-30 sec";
                                countdown = countdown - 30;
                                removeToptoBottom()
                                dataGlobalUnlock[0].room[i].clue2Found = "yes";
                            }
                        }

                        if (clue_show_content2.innerHTML == "null") {
                            clue_show_content2.innerHTML = 'Pas d\'indice';
                        }
                    });

                    clue_show3.addEventListener('click', function () {

                        clue_show_content3.classList.toggle('dnone');
                        clue_show_content1.classList.add('dnone');
                        clue_show_content2.classList.add('dnone');
                        if (!dataGlobalUnlock[0].room[i].clue3Found) {
                            if (t == 2) {
                                t++;
                                penality.classList.add('topToBottom');
                                penality.innerHTML = "-30 sec";
                                countdown = countdown - 30;
                                removeToptoBottom()
                                dataGlobalUnlock[0].room[i].clue3Found = "yes";
                            }
                        }

                        if (clue_show_content3.innerHTML == "null") {
                            clue_show_content3.innerHTML = 'Pas d\'indice';
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
                                penality.classList.add('topToBottom');
                                penality.innerHTML = "-5 min";
                                room_try = 3;
                                countdown = countdown - 300;
                                removeToptoBottom()
                            }

                        }
                    });
                    document.addEventListener('keydown', function (e) {
                        if (e.key == 'Enter') {
                            if (rooms_unlock_key.value == dataGlobal.room[i]['unlock_word']) {
                                rooms_unlock_btn.click();
                                e.preventDefault;
                                return;
                            }
                        }
                    });

                };

            })

        }



        frisk_btn.addEventListener('click', function () {
            if (roomID == 0) {
                furnitureList.innerHTML = "Veuillez sélectionner une salle";
            } else {
                furnitureList.innerHTML = "";
            }
            for (let f = 0; f < dataGlobal.furniture.length; f++) {

                if (dataGlobal.furniture[f].room_id == roomID) {
                    li_furniture = document.createElement('li');
                    li_furniture.classList.add('furniture_list_item', `nb-${f}`);
                    li_furniture.innerHTML = dataGlobal.furniture[f].title;
                    furnitureList.appendChild(li_furniture);
                }
                let furnitureArray = [];
                for (let j = 3; j < furnitureList.childNodes.length; j++) {
                    furnitureArray.push(furnitureList.childNodes[j]);
                }
            }
        });





    })
    .catch(error => {
        console.error(error);
    });