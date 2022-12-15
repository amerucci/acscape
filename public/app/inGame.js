function modalFixed() {
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
    // });
    const close = document.querySelectorAll('.close');
    close.forEach(element => {
        element.addEventListener('click', function () {
            document.querySelector('#roomsModal').classList.remove('show');
            document.querySelector('#roomsModal').style.display = 'none';
            document.querySelector('#friskModal').classList.remove('show');
            document.querySelector('#friskModal').style.display = 'none';
        });
    });
};
modalFixed();
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

let timelaps = 5

function clueTimer() {
    timelaps--;

    let minutes = Math.floor(timelaps / 60);
    let seconds = timelaps % 60;

    // Formater les minutes et les secondes avec des zéros au début (pour obtenir un format 00:00)
    minutes = minutes.toString().padStart(2, "0");
    seconds = seconds.toString().padStart(2, "0");

    if (timeLapsElement = document.getElementById("timelaps") != null) {
        timeLapsElement = document.getElementById("timelaps");

        if (timelaps < 0) {
            timeLapsElement.innerHTML = 'indice 2'
            return;
        }
    }

    timeLapsElement.innerHTML = seconds;
}
// setInterval(clueTimer, 1000);


async function getData() {
    try {
        const response = await fetch('/acscape/ingame/data');
        if (response.ok) {
            const data = await response.json();
            dataGlobal = data.data; // les données global formaté pour éviter le dataGlobal[0]....

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
let dataGlobalUnlock = [] // variable globale dataGlobal modifié pour pouvoir dévérouiller les rooms et les furniture


let roomID = 0; // id de la room ouverte stocké en number dans la portée globale pour pouvoir l'utiliser dans la fonction de filtrage de furniture
let roomLockID = 0;
let li_room // élément créé dynamiquement à l'ouverture d'une room pour le contenue d'une modal 
const roomsList = document.querySelector('.rooms_list');
const penality = document.querySelector('.penality');
const navInGameTitle = document.querySelector('.room_active');
let room_open
// let openRoomCalled = false;


let li_furniture // élément créé dynamiquement à l'ouverture d'un furniture pour le contenue d'une modal
const furnitureList = document.querySelector('.furniture_list')
const frisk_btn = document.querySelector('.frisk_btn')
let filteredFurniture = []; // tableau filtré de furniture.room_id = roomID. Se remplit au click d'une room à l'injection de l'id dans roomID
let filteredFurnitureLength = 0; // longueur du tableau filtré de furniture.room_id = roomID. Se remplit au click d'une room à l'injection de l'id dans roomID stocké en varaible globale sous la forme d'un number, pour éviter des problèmes de variable undefined pour les boucles for. 

function removeToptoBottom() {
    setTimeout(() => {
        penality.classList.remove('topToBottom');
    }, 2000);
}


main()
    .then(data => {

        dataGlobalUnlock.push(dataGlobal); // copie de dataGlobal dans dataGlobalUnlock pour pouvoir modifier les valeurs de dataGlobalUnlock sans modifier dataGlobal




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


            roomsArray[i].addEventListener('click', function (roomClick) { // ouverture de la modal room ouverte(padlock='no') ou fermé(padlock='yes') et l'ensemble des fonctions permettant les actions sur les salles

                roomLockID = dataGlobal.room[i].id;

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
                                                            <button type="button" class="closeOpen" data-bs-dismiss="modal" aria-label="Close">
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

                    //si une room contiens la classe activeR on injecte l'id de la room, et on opère une filtration de furniture par room_id = roomID
                    if (roomsArray[i].classList.contains('activeR') && roomID == roomID) {
                        roomID = dataGlobal.room[i].id;
                        filteredFurniture = dataGlobalUnlock[0].furniture.filter(furniture => furniture.room_id == roomID);
                        filteredFurnitureLength = filteredFurniture.length;
                    }

                    modal.addEventListener('hidden.bs.modal', function () {
                        modal.remove();
                    });

                }

                if (dataGlobal.room[i]['padlock'] == "yes" && roomsArray[i].classList.contains('room_unlock_open') == false) {


                    function createModal_Room_Lock() {
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
                                        <h5 class="modal-title  mx-auto" id="roomsModalLockLabel">${dataGlobal.room[i]['title']} est fermée</h5>
                                        <button type="button" class="closeLock" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                                </iconify-icon>
                                            </span>
                                    </div>
                                        <div class="modal-body">
                                        
                                                <div class="d-flex gap-2 clue_show">
                                                <div class="d-flex flex-column w-100">
                                                    <div class="d-flex gap-3 justify-content-center">
                                                        <button class="clue_show1 my-2" >Indice 1</button>
                                                        
                                                            <button id="timelaps" class="clue_show2 my-2" disabled>indice 2</button>
                                                           
                                                            <button class="clue_show3 my-2" disabled>indice 3</button>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <p class="clue_show1_content dnone">${dataGlobal.room[i]['clue']}</p>
                                                                <p class="clue_show2_content dnone ">${dataGlobal.room[i]['clue2']}</p>
                                                                <p class="clue_show3_content dnone">${dataGlobal.room[i]['clue3']}</p>
                                                    </div>    
                                                                                            </div>
                                                </div>
                                            <input type="text" class="form-control" id="rooms_unlock_key" placeholder="Entrer la clé pour ${dataGlobal.room[i]['title']} ">
                                            <p class="room_control_key"></p>
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="rooms_unlock_btn">Déverrouiller</button>
                                            <p class="reward dnone"></p>
                                        </div>
                                </div>
                            </div>`;
                        document.body.appendChild(modal);
                        const roomsModal = new bootstrap.Modal(modal);
                        roomsModal.show();

                        modal.addEventListener('hidden.bs.modal', function (modalRemove) {
                            modal.remove();
                        })

                    }
                    createModal_Room_Lock();


                    function clue_show() {

                        let t = 0; // variable t pour calculer les pénalités si ouverte une fois ou plus, en combinaison d'un ajout de propriété dans l'objet.
                        let tl = 0; // variable tl pour calculer l'interval entre chaque indice
                        const clue_show1 = document.querySelector('.clue_show1');
                        const clue_show_content1 = document.querySelector('.clue_show1_content');
                        const clue_show2 = document.querySelector('.clue_show2');
                        const clue_show_content2 = document.querySelector('.clue_show2_content');
                        const clue_show3 = document.querySelector('.clue_show3');
                        const clue_show_content3 = document.querySelector('.clue_show3_content');



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

                        if (dataGlobalUnlock[0].room[i].id == roomLockID) {
                            clue_show1.addEventListener('click', function () {

                                clue_show_content1.classList.toggle('dnone');
                                clue_show_content2.classList.add('dnone');
                                clue_show2.classList.add('timelaps');
                                clue_show_content3.classList.add('dnone');
                                if (clue_show2.classList.contains('timelaps') && tl == 0) {
                                    tl++;
                                    setInterval(clueTimer, 1000);
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
                        }
                    }

                    clue_show();



                    function rooms_unlock() {
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
                            } else {
                                room_try--;
                                rooms_unlock_key.value = '';
                                room_control_key.innerHTML = `Clé invalide ! Encore ${room_try} essais avant une pénalité de 5 minutes`;
                                if (room_try == 0) {
                                    room_control_key.innerHTML = `Dommage vous avez une pénalité de 5 minutes !`;
                                    setTimeout(function () {
                                        room_control_key.innerHTML = 'vous avez 3 nouveaux essais pour trouver le bon code';
                                    }, 2000)
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
                                if (rooms_unlock_key.value == '') {
                                    e.preventDefault;
                                    return;
                                } else {
                                    rooms_unlock_btn.click();
                                    e.preventDefault;
                                    return;
                                }
                            }
                        });
                    }
                    rooms_unlock();

                };

            })

        }


        frisk_btn.addEventListener('click', function () {
            furnitureList.innerHTML = "";
            if (roomID == 0) {
                furnitureList.innerHTML = "<p>Veuillez sélectionner une salle</p>";
            }
            for (let i = 0; i < filteredFurniture.length; i++) {

                const furniture = document.createElement('li');
                furniture.classList.add('furniture_list_item');
                furniture.innerHTML = filteredFurniture[i].title;
                furnitureList.appendChild(furniture);
            }

            for (let i = 0; i < filteredFurnitureLength; i++) {

                furnitureList.childNodes[i].addEventListener('click', function () {
                    modalF();
                });

                function modalF() {
                    const modal = document.createElement('div');
                    modal.classList.add('modal', 'fade');
                    modal.setAttribute('id', 'furniture_modal');
                    modal.setAttribute('tabindex', '-1');
                    modal.setAttribute('aria-labelledby', 'furniture_modal_label');
                    modal.setAttribute('aria-hidden', 'true');
                    modal.innerHTML = `
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="furniture_modal_label">${filteredFurniture[i]['title']}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>${filteredFurniture[i]['description']}</p>
                                        <div class="d-flex gap-2 clue_show">
                                            <div class="d-flex flex-column w-100">
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <button class="clue_show1 my-2">Indice 1</button>
                                                    <button class="clue_show2 my-2" disabled>indice 2</button>
                                                        <button class="clue_show3 my-2" disabled>indice 3</button>
                                                </div>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <p class="clue_show1_content dnone">${dataGlobal.furniture[i]['clue']}</p>
                                                        <p class="clue_show2_content dnone ">${dataGlobal.furniture[i]['clue2']}</p>
                                                        <p class="clue_show3_content dnone">${dataGlobal.furniture[i]['clue3']}</p>
                                                </div>    
                                            </div>
                                        </div>
                                            <div>
                                                <input type="text" class="form-control furniture_key_unlock"  placeholder="Votre réponse" aria-label="Votre réponse">
                                                <p class="furniture_unlock_statut"></p>
                                                <button class="btn btn-primary furniture_key_unlock_btn">Valider</button>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                    <p class="furniture_reward"></p>
                                    </div>
                                </div>
                            </div>
                            `;
                    document.body.appendChild(modal);
                    const furniture_modal = new bootstrap.Modal(modal);
                    furniture_modal.show();
                    modal.addEventListener('hidden.bs.modal', function () {
                        modal.remove();
                    })

                    function clue_show() {

                        let t = 0;
                        let tl = 0;

                        const clue_show1 = document.querySelector('.clue_show1');
                        const clue_show_content1 = document.querySelector('.clue_show1_content');
                        const clue_show2 = document.querySelector('.clue_show2');
                        const clue_show_content2 = document.querySelector('.clue_show2_content');
                        const clue_show3 = document.querySelector('.clue_show3');
                        const clue_show_content3 = document.querySelector('.clue_show3_content');


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
                            if (!dataGlobalUnlock[0].furniture[i].clue1Found) {
                                if (t == 0) {
                                    t++;
                                    penality.classList.add('topToBottom');
                                    penality.textContent = "-30 sec";
                                    countdown = countdown - 30;
                                    removeToptoBottom()
                                    dataGlobalUnlock[0].furniture[i].clue1Found = "yes";

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
                            if (!dataGlobalUnlock[0].furniture[i].clue2Found) {
                                if (t == 1) {
                                    t++;
                                    penality.classList.add('topToBottom');
                                    penality.innerHTML = "-30 sec";
                                    countdown = countdown - 30;
                                    removeToptoBottom()
                                    dataGlobalUnlock[0].furniture[i].clue2Found = "yes";
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
                            if (!dataGlobalUnlock[0].furniture[i].clue3Found) {
                                if (t == 2) {
                                    t++;
                                    penality.classList.add('topToBottom');
                                    penality.innerHTML = "-30 sec";
                                    countdown = countdown - 30;
                                    removeToptoBottom()
                                    dataGlobalUnlock[0].furniture[i].clue3Found = "yes";
                                }
                            }

                            if (clue_show_content3.innerHTML == "null") {
                                clue_show_content3.innerHTML = 'Pas d\'indice';
                            }
                        });
                    }
                    clue_show();

                    function furniture_unlock() {
                        const furniture_key_unlock = document.querySelector('.furniture_key_unlock');
                        const furniture_key_unlock_btn = document.querySelector('.furniture_key_unlock_btn');
                        const furniture_reward = document.querySelector('.furniture_reward');
                        const furniture_unlock_statut = document.querySelector('.furniture_unlock_statut');
                        let furniture_unlock_try = 3;

                        furniture_key_unlock_btn.addEventListener('click', function () {
                            if (furniture_key_unlock.value == dataGlobalUnlock[0].furniture[i].unlock_word) {
                                furniture_unlock_statut.innerHTML = "meuble ouvert";
                                furniture_reward.innerHTML = dataGlobalUnlock[0].furniture[i].reward;
                            } else {
                                furniture_unlock_try--;

                                furniture_key_unlock.value = "";
                                furniture_unlock_statut.innerHTML = `code incorrect encore ${furniture_unlock_try} essais`;
                                if (furniture_unlock_try == 0) {
                                    furniture_unlock_statut.innerHTML = "Dommage vous avez une pénalité de 5 minutes ! ";
                                    setTimeout(function () {
                                        furniture_unlock_statut.innerHTML = 'vous avez 3 nouveaux essais pour trouver le bon code';
                                    }, 2000)
                                    penality.classList.add('topToBottom');
                                    penality.innerHTML = "-5 min";
                                    furniture_unlock_try = 3;
                                    countdown = countdown - 300;
                                    removeToptoBottom()

                                }
                            }
                        });


                    }
                    furniture_unlock();

                }

            }
        });


    })
    .catch(error => {
        console.error(error);
    });