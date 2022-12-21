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

let timelaps = 30;


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
let room_open;
let backdrop;
let modals = document.querySelectorAll('.modal');
let input_container;

let switch_container;
let switch_try;
let checkTry;

let li_furniture; // élément créé dynamiquement à l'ouverture d'un furniture pour le contenue d'une modal
let furnitureLi;
const furnitureList = document.querySelector('.furniture_list')
const frisk_btn = document.querySelector('.frisk_btn')
let filteredFurniture = []; // tableau filtré de furniture.room_id = roomID. Se remplit au click d'une room à l'injection de l'id dans roomID
let filteredFurnitureLength = 0; // longueur du tableau filtré de furniture.room_id = roomID. Se remplit au click d'une room à l'injection de l'id dans roomID stocké en varaible globale sous la forme d'un number, pour éviter des problèmes de variable undefined pour les boucles for. 
let filteredFurnitureChange = []

let clue_show_content1;
let clue_show_content2;
let clue_show_content3;
let clue_btn_content;
let clue_show_container;
let roomsClue = [];
let roomsClueUnique = [];
let textarea_title_sticky;
let textareaSticky;
let copy;


let createstickyOpac = document.querySelector('#createstickyOpac');

let arrayMax = [];
let max = 0

let endgame_win = document.querySelector('.endgame_win');
let buttonConfetti = document.querySelector('.buttonConfetti');


function removeToptoBottom() {
    setTimeout(() => {
        penality.classList.remove('topToBottom');
    }, 2000);
}


main()
    .then(data => {

        dataGlobalUnlock.push(dataGlobal); // copie de dataGlobal dans dataGlobalUnlock pour pouvoir modifier les valeurs de dataGlobalUnlock sans modifier dataGlobal




        for (let i = 0; i < dataGlobal.room.length; i++) {


            arrayMax.push(dataGlobal.room[i].n_room);
            max = Math.max(...arrayMax);



            li_room = document.createElement('li');
            li_room.classList.add('rooms_list_item', `nb-${i}`);
            li_room.innerHTML = dataGlobalUnlock[0].room[i].title;
            roomsList.appendChild(li_room);


            let roomsArray = [];
            for (let j = 3; j < roomsList.childNodes.length; j++) {
                roomsArray.push(roomsList.childNodes[j]);
            }

            let padlock = document.createElement('iconify-icon');
            padlock.setAttribute('icon', 'uis:padlock');
            padlock.setAttribute('width', '60');
            padlock.setAttribute('height', '60');
            padlock.classList.add('padlock');

            let padlock_open = document.createElement('iconify-icon');
            padlock_open.setAttribute('icon', 'uil:unlock-alt');
            padlock_open.setAttribute('width', '60');
            padlock_open.setAttribute('height', '60');
            padlock_open.classList.add('padlock_open');

            // roomsArray[i].appendChild(padlock);

            function padlock_img() {
                if (dataGlobal.room[i]['padlock'] == "yes" && roomsArray[i].classList.contains('room_unlock_open') == false) {
                    roomsArray[i].style.color = 'grey';
                    padlock_open.remove();
                    roomsArray[i].appendChild(padlock);


                } else {
                    roomsArray[i].style.color = 'black';
                    padlock.remove();
                    roomsArray[i].appendChild(padlock_open);
                }
            }
            padlock_img();


            roomsArray[i].addEventListener('click', function (roomClick) { // ouverture de la modal room ouverte(padlock='no') ou fermé(padlock='yes') et l'ensemble des fonctions permettant les actions sur les salles

                roomLockID = dataGlobal.room[i].id;
                padlock_img();

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
                                                            <h5 class="modal-title mx-auto d-flex align-items-center gap-3" id="roomsModalOpenLabel">${this.innerHTML}</h5>
                                                            <button type="button" class="closeOpen" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                                                    </iconify-icon>
                                                                </span>
                                                        </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-center align-items-center gap-2 flex-column">
                                                                <h5 class="msg_open">Salle dévérouillée voyons ce qu'elle contient.</h5>
                                                                <p my-4>${dataGlobal.room[i].reward}</p>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>`;
                    document.body.appendChild(modal);
                    const roomsOpenModal = new bootstrap.Modal(modal);
                    roomsOpenModal.show();

                    let msg_open = document.querySelector('.msg_open');
                    if (dataGlobal.room[i].n_room == "1") {
                        msg_open.innerHTML = "Cette salle est déjà ouverte, mais pouvez la fouiller pour partir à la recherches d'indices. <br> Peut-être que vous trouverez quelque chose qui vous aidera à ouvrir la salle suivante.";
                    }

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
                                    
                                            <h5 class="modal-title mx-auto d-flex align-items-center gap-3" id="roomsModalLockLabel">${this.innerHTML}</h5>
                                      
                                        <button type="button" class="closeLock" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                                </iconify-icon>
                                            </span>
                                    </div>
                                    <div class="d-flex  clue_show input_container fade show w-100 gap-1">
                                    <p class="description_room">${dataGlobal.room[i]['description']}</p>
                                    </div>
                                        <div class="modal-body d-flex">
                        
                                                <div class="d-flex flex-column clue_show input_container fade show w-50 gap-1">
                                                    <div class="w-100">
                                                      <div class="d-flex">
                                                          <input type="text" class="form-control" id="rooms_unlock_key" placeholder="Entrer la clé pour ${dataGlobal.room[i]['title']}">
                                                          <button type="button" class="btn btn-primary btn-lg btn-block" id="rooms_unlock_btn"><iconify-icon class="key_btn" icon="fluent-emoji-high-contrast:old-key"></iconify-icon></button>
                                                          </div>
                                                          <div class="d-flex align-items-center gap-5"></div>
                                                    </div>
                                                        <div class="d-flex flex-column switch_container fade show">
                                                            <div class="progress w-100 h-100">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated room_control_key" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                                            </div>
                                                            <p class="text-center penality_info"></p>
                                                        </div>
                                               
                                            </div>

                                            <p class="reward dnone w-75 d-flex justify-content-center align-items-center"></p>
                                              <div id="clue_btn_content" class="d-flex flex-column w-50 align-items-center gap-3">
                                                  <div class="d-flex gap-3 justify-content-center w-100">
                                                      <button class="clue_show1 my-2 px-2" >Indice 1</button> 
                                                      <button id="timelaps" class="clue_show2 my-2 px-2" >indice 2</button>
                                                      <button class="clue_show3 my-2 px-2" >indice 3</button>
                                                  </div>
                                                  <div class="d-flex gap-2 justify-content-center align-items-center mx-auto h-100 w-100">
                                                  <div class="clue_show1_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class="d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                      
                                                  </div>
                                                  <div class="clue_show2_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class="d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                    
                                                  </div>
                                                  <div class="clue_show3_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class=" d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                     
                                                  </div>
                                                 </div>
                                              </div>
                                              
                                        </div>       
                                        </div>
                                </div>
                            </div>`;
                    document.body.appendChild(modal);
                    const roomsModal = new bootstrap.Modal(modal);
                    roomsModal.show();

                    modal.addEventListener('hidden.bs.modal', function (modalRemove) {
                        modal.remove();
                    })


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
                        return;
                    }


                    // CLue ************
                    let t = 0; // variable t pour calculer les pénalités si ouverte une fois ou plus, en combinaison d'un ajout de propriété dans l'objet.
                    let tl = 0; // variable tl pour calculer l'interval entre chaque indice
                    clue_btn_content = document.querySelector('#clue_btn_content');
                    switch_container = document.querySelector('.switch_container');
                    input_container = document.querySelector('.input_container');

                    let clue_show1 = document.querySelector('.clue_show1');
                    clue_show1.setAttribute('data_id', `${dataGlobal.room[i]['id']}`);
                    clue_show_content1 = document.querySelector('.clue_show1_content');

                    let clue_show2 = document.querySelector('.clue_show2');
                    clue_show2.setAttribute('data_id', `${dataGlobal.room[i]['id']}`);
                    clue_show_content2 = document.querySelector('.clue_show2_content');

                    let clue_show3 = document.querySelector('.clue_show3');
                    clue_show3.setAttribute('data_id', `${dataGlobal.room[i]['id']}`);
                    clue_show_content3 = document.querySelector('.clue_show3_content');

                    // roomsClue.push([clue_show1.getAttribute('data_id'), clue_show2.getAttribute('data_id'), clue_show3.getAttribute('data_id')]);

                    if (clue_show_content1.innerHTML == "null") {
                        clue_show1.classList.add('dnone');
                        clue_show2.classList.add('dnone');
                        clue_show3.classList.add('dnone');
                    }


                    if (clue_show_content2.innerHTML = dataGlobal.room[i]['clue2'] == null) {
                        clue_show2.classList.add('dnone');
                        clue_show3.classList.add('dnone');
                    }

                    if (clue_show_content3.innerHTML = dataGlobal.room[i]['clue3'] == null) {
                        clue_show3.classList.add('dnone');
                    }




                    clue_show1.addEventListener('click', function () {

                        clue_show_content1.classList.toggle('dnone');
                        clue_show_content2.classList.add('dnone');
                        clue_show_content3.classList.add('dnone');
                        clue_show_content1.innerHTML = `<p>${dataGlobal.room[i]['clue']}</p><iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;
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
                        copy = document.querySelectorAll('.copy');
                        copy.forEach((copy) => {
                            copy.addEventListener('click', function () {
                                createstickyOpac.click()
                                textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                textareaSticky = document.querySelectorAll('.textareaSticky');
                                textarea_title_sticky[textarea_title_sticky.length - 1].value = `${dataGlobal.room[i]['title']}`;
                                textareaSticky[textareaSticky.length - 1].value = `indice n°1 \n${dataGlobal.room[i]['clue']}`;
                            })
                        })

                    });

                    clue_show2.addEventListener('click', function () {
                        clue_show_content2.classList.toggle('dnone');
                        clue_show_content1.classList.add('dnone');
                        clue_show_content3.classList.add('dnone');
                        clue_show_content2.innerHTML = `${dataGlobal.room[i]['clue2']}<iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;

                        if (!dataGlobalUnlock[0].room[i].clue2Found) {
                            if (t == 1) {
                                t++;
                                penality.classList.add('topToBottom');
                                penality.textContent = "-30 sec";
                                countdown = countdown - 30;
                                removeToptoBottom()
                                dataGlobalUnlock[0].room[i].clue2Found = "yes";
                            }
                        }
                        copy = document.querySelectorAll('.copy');
                        copy.forEach((copy) => {
                            copy.addEventListener('click', function () {
                                createstickyOpac.click()
                                textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                textareaSticky = document.querySelectorAll('.textareaSticky');
                                textarea_title_sticky[textarea_title_sticky.length - 1].value = `${dataGlobal.room[i]['title']}`;
                                textareaSticky[textareaSticky.length - 1].value = `indice n°2 \n${dataGlobal.room[i]['clue2']}`;
                            })
                        })

                    });


                    clue_show3.addEventListener('click', function () {

                        clue_show_content3.classList.toggle('dnone');
                        clue_show_content1.classList.add('dnone');
                        clue_show_content2.classList.add('dnone');
                        clue_show_content3.innerHTML = `${dataGlobal.room[i]['clue3']}<iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;

                        if (!dataGlobalUnlock[0].room[i].clue3Found) {
                            if (t == 2) {
                                t++;
                                penality.classList.add('topToBottom');
                                penality.textContent = "-30 sec";
                                countdown = countdown - 30;
                                removeToptoBottom()
                                dataGlobalUnlock[0].room[i].clue3Found = "yes";
                            }
                        }
                        copy = document.querySelectorAll('.copy');
                        copy.forEach((copy) => {
                            copy.addEventListener('click', function () {
                                createstickyOpac.click()
                                textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                textareaSticky = document.querySelectorAll('.textareaSticky');
                                textarea_title_sticky[textarea_title_sticky.length - 1].value = `${dataGlobal.room[i]['title']}`;
                                textareaSticky[textareaSticky.length - 1].value = `indice n°3 \n${dataGlobal.room[i]['clue3']}`;
                            })
                        })
                    });


                    const roomsModalLockLabel = document.getElementById('roomsModalLockLabel');
                    const rooms_unlock_key = document.querySelector('#rooms_unlock_key');
                    const room_control_key = document.querySelector('.room_control_key');
                    const rooms_unlock_btn = document.querySelector('#rooms_unlock_btn');
                    const reward = document.querySelector('.reward');
                    const progress_bar = document.querySelector('.progress-bar');
                    let room_try = 3;
                    backdrop = document.querySelector('.closeLock');
                    const penality_info = document.querySelector('.penality_info');
                    room_control_key.innerHTML = `<span class="h-100 d-flex justify-content-center align-items-center tryNumber">${room_try}</span>`;

                    // room_control_key.innerHTML = `<span class="m-0">${room_try}</span><span class="m-0">-</span><span class="m-0">3</span>`;

                    // room_control_key.innerHTML = `<p class="m-0">${room_try}</p><p>/3 essais</p> <span class="d-flex align-items-center w-75"><iconify-icon icon="fluent-mdl2:chronos-logo"></iconify-icon><p class="m-0">-5 minutes si vous épuisez vos essais</p></span>`;
                    rooms_unlock_btn.addEventListener('click', function () {
                        if (rooms_unlock_key.value == '') {
                            e.preventDefault;
                        }
                        if (rooms_unlock_key.value == dataGlobal.room[i]['unlock_word']) {
                            rooms_unlock_btn.disabled = true;
                            // room_control_key.innerHTML = '<span>bravo</span>';
                            // reward.classList.remove('dnone');
                            reward.innerHTML = `${dataGlobal.room[i]['reward']}`;
                            dataGlobal.room[i]['padlock'] = "no";
                            // dataGlobal.room[i]['unlock_word'] = null;
                            roomsArray[i].classList.add('room_unlock_open');
                            roomsArray[i].style.color = 'black';
                            padlock.remove();
                            padlock_open.remove();
                            // roomsModalLockLabel.innerHTML = `${dataGlobal.room[i].title} <iconify-icon icon="uil:unlock-alt" width="60" height="60"></iconify-icon>`;
                            // clue_btn_content.classList.add('dnone');
                            roomsArray[i].appendChild(padlock_open);
                            dataGlobalUnlock.push(dataGlobal);
                            if (dataGlobalUnlock.length > 1) {
                                dataGlobalUnlock.pop();
                            }
                            backdrop.click();
                            roomsArray[i].click();

                        } else {
                            room_try--;
                            progress_bar.style.width = `${(room_try / 3) * 100}%`;
                            rooms_unlock_key.value = '';
                            // room_control_key.innerHTML = `Clé invalide ! ${room_try}/3 essais`;
                            // room_control_key.innerHTML = `<span class="m-0">${room_try}</span><span class="m-0">-</span><span class="m-0">3</span>`;
                            room_control_key.innerHTML = `<span class="h-100 d-flex justify-content-center align-items-center tryNumber">${room_try}</span>`;
                            if (room_try == 0) {
                                penality_info.innerHTML = `<span class="d-flex align-items-center justify-content-center endTry gap-3"><iconify-icon class="moveLr" icon="fluent-mdl2:chronos-logo"></iconify-icon><p class="m-0">-5min</p></span>`;
                                setTimeout(function () {
                                    room_try = 3;
                                    // penality_info.innerHTML = 'Réessayer avec 3 nouveaux essais';
                                    progress_bar.style.width = `${(room_try / 3) * 100}%`;
                                    room_control_key.innerHTML = `<span class="m-0">${room_try}</span>`;
                                    penality_info.innerHTML = "";
                                }, 2000)
                                penality.classList.add('topToBottom');
                                penality.innerHTML = "-5 min";
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

                if (dataGlobal.room[i].n_room == max && roomsArray[i].classList.contains('room_unlock_open')) {
                    endgame_win.classList.remove('dnone');

                    setInterval(function () {
                        buttonConfetti.click();
                    }, 200)


                }


            })

        }

        // FURNITURE
        frisk_btn.addEventListener('click', function () {

            furnitureList.innerHTML = "";


            dataGlobal.furniture.forEach(furniture => {
                if (furniture.room_id === roomID) {


                    furnitureLi = document.createElement('li');
                    furnitureLi.classList.add('furniture_list_item');
                    let title = furniture.title;
                    if (title.length > 10) {
                        title = title.substring(0, 10) + '...';
                    }
                    furnitureLi.setAttribute('data-id', furniture.id);
                    furnitureLi.innerHTML = `<button class="m-0 actionFurniture">${furniture.action}</button>${title}`;
                    furnitureList.appendChild(furnitureLi);



                    let padlock = document.createElement('iconify-icon');
                    padlock.setAttribute('icon', 'uis:padlock');
                    padlock.setAttribute('width', '60');
                    padlock.setAttribute('height', '60');
                    padlock.classList.add('padlock');

                    let padlock_open = document.createElement('iconify-icon');
                    padlock_open.setAttribute('icon', 'uil:unlock-alt');
                    padlock_open.setAttribute('width', '60');
                    padlock_open.setAttribute('height', '60');
                    padlock_open.classList.add('padlock_open');




                    if (furniture.padlock == "yes") {
                        furnitureLi.style.color = "grey";

                        furnitureLi.appendChild(padlock);

                    } else {
                        furnitureLi.style.color = "white";
                        padlock.remove();
                        furnitureLi.appendChild(padlock_open);
                    }

                    furnitureList.appendChild(furnitureLi);







                    if (furniture.padlock == "yes" && !furnitureLi.classList.contains('furniture_unlock')) {


                        furnitureLi.addEventListener('click', function (event) {



                            const modal = document.createElement('div');
                            modal.classList.add('modal', 'fade', 'modal-lg');
                            modal.setAttribute('id', 'furniture_modal');
                            modal.setAttribute('tabindex', '-1');
                            modal.setAttribute('aria-labelledby', 'furniture_modal_label');
                            modal.setAttribute('aria-hidden', 'true');
                            modal.innerHTML = `<div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content furnitureLock">
                                <div class="modal-header">
        
                                        <h5 class="modal-title mx-auto d-flex align-items-center gap-3" id="furnitureModalLockLabel">${furniture.title}</h5>
        
                                    <button type="button" class="closeLock" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                                            </iconify-icon>
                                        </span>
                                </div>
                                <div class="d-flex  clue_show input_container fade show w-100 gap-1">
                                    <p class="description_room">${furniture['description']}</p>
                                    </div>
                                    <div class="modal-body d-flex">
        
                                        <div class="d-flex flex-column clue_show w-50 gap-1">
                                          <div class="w-100">
                                              <div class="d-flex">
                                                  <input type="text" class="form-control" id="furniture_key_unlock" placeholder="Entrer la clé pour ${furniture.title}">
                                                  <button type="button" class="btn btn-primary btn-lg btn-block" id="furniture_key_unlock_btn"><iconify-icon class="key_btn" icon="fluent-emoji-high-contrast:old-key"></iconify-icon></button>
                                                  </div>
                                                  <div class="d-flex align-items-center gap-5"></div>
                                              <p class="furniture_reward dnone"></p>
                                          </div>    
                                          <div class="d-flex flex-column switch_container fade show">
                                          <div class="progress w-100 h-100">
                                              <div class="progress-bar progress-bar-striped progress-bar-animated furniture_unlock_statut" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                          </div>
                                          <p class="text-center penality_info"></p>
                                      </div>
                                        </div>
                                          <div class="d-flex flex-column w-50 align-items-center gap-3">
                                              <div class="d-flex gap-3 justify-content-center w-100">
                                                  <button class="clue_show1 my-2 px-2" >Indice 1</button> 
                                                  <button id="timelaps" class="clue_show2 my-2 px-2" disabled>indice 2</button>
                                                  <button class="clue_show3 my-2 px-2" disabled>indice 3</button>
                                              </div>
                                              <div class="d-flex gap-2 justify-content-center align-items-center mx-auto h-100 w-100">
                                              <div class="clue_show1_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class="d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                      
                                                  </div>
                                                  <div class="clue_show2_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class="d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                    
                                                  </div>
                                                  <div class="clue_show3_content dnone d-flex justify-content-center align-items-center w-100 h-75 mx-2">
                                                      <p class=" d-flex justify-content-center align-items-center w-100 h-75 mx-2"></p>
                                                     
                                                  </div>
                                              </div>
                                          </div>
                                    </div>  `;
                            document.body.appendChild(modal);
                            const furniture_modal = new bootstrap.Modal(modal);
                            furniture_modal.show();
                            modal.addEventListener('hidden.bs.modal', function () {
                                modal.remove();
                            })

                            const furnitureModalLockLabel = document.getElementById('furnitureModalLockLabel');
                            switch_try = document.querySelector('.switch_try');
                            checkTry = document.querySelector('.check_try');

                            // CLue ************
                            let t = 0; // variable t pour calculer les pénalités si ouverte une fois ou plus, en combinaison d'un ajout de propriété dans l'objet.
                            let tl = 0; // variable tl pour calculer l'interval entre chaque indice
                            const clue_btn_content = document.querySelector('#clue_btn_content');

                            let clue_show1 = document.querySelector('.clue_show1');
                            clue_show1.setAttribute('data_id', `${furniture['id']}`);
                            clue_show_content1 = document.querySelector('.clue_show1_content');

                            let clue_show2 = document.querySelector('.clue_show2');
                            clue_show2.setAttribute('data_id', `${furniture['id']['id']}`);
                            clue_show_content2 = document.querySelector('.clue_show2_content');

                            let clue_show3 = document.querySelector('.clue_show3');
                            clue_show3.setAttribute('data_id', `${furniture['id']['id']}`);
                            clue_show_content3 = document.querySelector('.clue_show3_content');


                            // ************************************************************************************************
                            // ************************************************************************************************

                            // roomsClue.push([clue_show1.getAttribute('data_id'), clue_show2.getAttribute('data_id'), clue_show3.getAttribute('data_id')]);

                            if (clue_show_content1.innerHTML == "null") {
                                clue_show1.classList.add('dnone');
                                clue_show2.classList.add('dnone');
                                clue_show3.classList.add('dnone');
                            }


                            if (clue_show_content2.innerHTML = furniture['clue2'] == null) {
                                clue_show2.classList.add('dnone');
                                clue_show3.classList.add('dnone');
                            }

                            if (clue_show_content3.innerHTML = furniture['clue3'] == null) {
                                clue_show3.classList.add('dnone');
                            }

                            clue_show1.addEventListener('click', function () {
                                console.log('clue1');
                                clue_show_content1.classList.toggle('dnone');
                                clue_show_content2.classList.add('dnone');
                                clue_show_content3.classList.add('dnone');
                                clue_show_content1.innerHTML = `<p>${furniture['clue']}</p><iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;
                                if (!furniture.clue1Found) {
                                    if (t == 0) {
                                        t++;
                                        penality.classList.add('topToBottom');
                                        penality.textContent = "-30 sec";
                                        countdown = countdown - 30;
                                        removeToptoBottom()
                                        furniture.clue1Found = "yes";
                                    }
                                }
                                copy = document.querySelectorAll('.copy');
                                copy.forEach((copy) => {
                                    copy.addEventListener('click', function () {
                                        createstickyOpac.click()
                                        textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                        textareaSticky = document.querySelectorAll('.textareaSticky');
                                        textarea_title_sticky[textarea_title_sticky.length - 1].value = `${furniture['title']}`;
                                        textareaSticky[textareaSticky.length - 1].value = `indice n°1 \n${furniture['clue']}`;
                                    })
                                })

                            });

                            clue_show2.addEventListener('click', function () {
                                clue_show_content2.classList.toggle('dnone');
                                clue_show_content1.classList.add('dnone');
                                clue_show_content3.classList.add('dnone');
                                clue_show_content2.innerHTML = `${furniture['clue2']}<iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;

                                if (!furniture.clue2Found) {
                                    if (t == 1) {
                                        t++;
                                        penality.classList.add('topToBottom');
                                        penality.textContent = "-30 sec";
                                        countdown = countdown - 30;
                                        removeToptoBottom()
                                        furniture.clue2Found = "yes";
                                    }
                                }
                                copy = document.querySelectorAll('.copy');
                                copy.forEach((copy) => {
                                    copy.addEventListener('click', function () {
                                        createstickyOpac.click()
                                        textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                        textareaSticky = document.querySelectorAll('.textareaSticky');
                                        textarea_title_sticky[textarea_title_sticky.length - 1].value = `${furniture['title']}`;
                                        textareaSticky[textareaSticky.length - 1].value = `indice n°2 \n${furniture['clue2']}`;
                                    })
                                })

                            });


                            clue_show3.addEventListener('click', function () {

                                clue_show_content3.classList.toggle('dnone');
                                clue_show_content1.classList.add('dnone');
                                clue_show_content2.classList.add('dnone');
                                clue_show_content3.innerHTML = `${dataGlobal.room[i]['clue3']}<iconify-icon class="copy" icon="clarity:copy-to-clipboard-line"></iconify-icon></button>`;

                                if (!dataGlobalUnlock[0].room[i].clue3Found) {
                                    if (t == 2) {
                                        t++;
                                        penality.classList.add('topToBottom');
                                        penality.textContent = "-30 sec";
                                        countdown = countdown - 30;
                                        removeToptoBottom()
                                        dataGlobalUnlock[0].room[i].clue3Found = "yes";
                                    }
                                }
                                copy = document.querySelectorAll('.copy');
                                copy.forEach((copy) => {
                                    copy.addEventListener('click', function () {
                                        createstickyOpac.click()
                                        textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
                                        textareaSticky = document.querySelectorAll('.textareaSticky');
                                        textarea_title_sticky[textarea_title_sticky.length - 1].value = `${dataGlobal.room[i]['title']}`;
                                        textareaSticky[textareaSticky.length - 1].value = `indice n°3 \n${dataGlobal.room[i]['clue3']}`;
                                    })
                                })
                            });



                            const furniture_key_unlock = document.querySelector('#furniture_key_unlock');
                            const furniture_key_unlock_btn = document.querySelector('#furniture_key_unlock_btn');
                            const furniture_reward = document.querySelector('.furniture_reward');
                            const furniture_unlock_statut = document.querySelector('.furniture_unlock_statut');
                            let furniture_unlock_try = 3;
                            furniture_unlock_statut.innerHTML = `<span class="h-100 d-flex justify-content-center align-items-center tryNumber">${furniture_unlock_try}</span>`;
                            const progress_bar = document.querySelector('.progress-bar');
                            const penality_info = document.querySelector('.penality_info');
                            backdrop = document.querySelector('.closeLock');
                            furniture_key_unlock_btn.addEventListener('click', function (e) {


                                if (furniture_key_unlock.value == furniture.unlock_word) {
                                    furniture_key_unlock_btn.disabled = true;
                                    furniture.padlock = 'no';
                                    furniture_unlock_statut.innerHTML = '<span>bravo</span><iconify-icon icon="uil:unlock-alt" width="60" height="60"></iconify-icon>';
                                    furniture_reward.innerHTML = furniture.reward;
                                    if (furniture_reward.innerHTML == "" || furniture_reward.innerHTML == null) {
                                        furniture_reward.innerHTML = "Vous avez trouvé le bon code, mais il n'y s'y trouve rien";
                                    }
                                    furnitureModalLockLabel.innerHTML = `${furniture.title} <iconify-icon icon="uil:unlock-alt" width="60" height="60"></iconify-icon>`;
                                    dataGlobalUnlock.push(dataGlobal);
                                    if (dataGlobalUnlock.length > 1) {
                                        dataGlobalUnlock.pop();
                                    }
                                    backdrop.click();
                                    let close = document.querySelector('.close');

                                    close.click();
                                    frisk_btn.click();
                                    furnitureLi.classList.add('furniture_unlock');

                                    const modal = document.createElement('div');
                                    modal.classList.add('modal', 'fade');
                                    modal.id = 'modalF_open';
                                    modal.setAttribute('tabindex', '-1');
                                    modal.setAttribute('aria-labelledby', 'modalF_open');
                                    modal.setAttribute('aria-hidden', 'false');
                                    modal.innerHTML = `
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content modalFurnitureOpen">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalF_open">${furniture.title}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="furniture_reward">${furniture.reward}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `;
                                    document.body.appendChild(modal);
                                    const myModal = new bootstrap.Modal(modal);
                                    myModal.show();



                                    modal.addEventListener('hidden.bs.modal', function () {
                                        modal.remove();
                                    });

                                } else {
                                    furniture_unlock_try--;
                                    progress_bar.style.width = `${(furniture_unlock_try / 3) * 100}%`;
                                    furniture_key_unlock.value = "";
                                    furniture_unlock_statut.innerHTML = `<span class="h-100 d-flex justify-content-center align-items-center tryNumber">${furniture_unlock_try}</span>`;
                                    if (furniture_unlock_try == 0) {

                                        penality_info.innerHTML = `<span class="d-flex align-items-center justify-content-center endTry gap-3"><iconify-icon class="moveLr"  icon="fluent-mdl2:chronos-logo"></iconify-icon><p class="m-0">-5min</p></span>`;
                                        setTimeout(function () {
                                            furniture_unlock_try = 3;
                                            progress_bar.style.width = `${(furniture_unlock_try / 3) * 100}%`;
                                            furniture_unlock_statut.innerHTML = `<span class="h-100 d-flex justify-content-center align-items-center tryNumber">${furniture_unlock_try}</span>`;
                                            penality_info.innerHTML = "";
                                        }, 2000)
                                        penality.classList.add('topToBottom');
                                        penality.innerHTML = "-5 min";
                                        furniture_unlock_try = 3;
                                        countdown = countdown - 300;
                                        removeToptoBottom()

                                    }
                                }


                            });

                            document.addEventListener('keydown', function (e) {
                                if (e.key == 'Enter') {
                                    if (furniture_key_unlock.value == furniture.unlock_word) {
                                        furniture_key_unlock_btn.click();
                                        e.preventDefault;
                                        return;
                                    }
                                    if (furniture_key_unlock.value == '') {
                                        e.preventDefault;
                                        return;
                                    } else {
                                        furniture_key_unlock_btn.click();
                                        e.preventDefault;
                                        return;
                                    }
                                }
                            });


                        });
                    }


                    if (furniture.padlock == 'no') {
                        furnitureLi.classList.add('furniture_unlock');
                        furnitureLi.addEventListener('click', function (event) {
                            const modal = document.createElement('div');
                            modal.classList.add('modal', 'fade');
                            modal.id = 'modalF_open';
                            modal.setAttribute('tabindex', '-1');
                            modal.setAttribute('aria-labelledby', 'modalF_open');
                            modal.setAttribute('aria-hidden', 'false');
                            modal.setAttribute('data-bs-backdrop', 'true');
                            modal.setAttribute("pointer-events", "auto")
                            modal.innerHTML = `
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content modalFurnitureOpen">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalF_open">${furniture.title}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class='furniture_reward">${furniture.reward}</p>                                            
                                        </div>
                                    </div>
                                </div>
                                `;
                            document.body.appendChild(modal);
                            const myModal = new bootstrap.Modal(modal);
                            myModal.show();
                            modal.addEventListener('hidden.bs.modal', function () {
                                modal.remove();
                            });

                        });
                    }





                }
            });


            if (furnitureList.childElementCount == 0) {
                furnitureList.innerHTML = "<p>Aucun meuble à fouiller</p>";
            }
            if (roomID == 0) {
                furnitureList.innerHTML = "<p>Veuillez sélectionner une salle</p>";
            }

        });


    })
    .catch(error => {
        console.error(error);
    });


const wiki = document.querySelector('.wiki');
wiki.addEventListener('click', function () {
    // create modal bootstrap5 for iframe
    const modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.id = 'wikiModal';
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('aria-labelledby', 'wikiModal');
    modal.setAttribute('aria-hidden', 'false');
    modal.setAttribute("pointer-events", "auto")
    modal.innerHTML = `
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wikiModal">Wiki</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body wiki_modal">
               <iframe src="https://fr.m.wikipedia.org" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>
    `;
    document.body.appendChild(modal);
    const modalBootstrap = new bootstrap.Modal(modal);
    modalBootstrap.show();
    modal.addEventListener('hidden.bs.modal', function () {
        modal.remove();
    });
})

// sticky
document.addEventListener('DOMContentLoaded', () => {
    const stickyArea = document.querySelector(
        '#stickies-container'
    );

    const createStickyButton = document.querySelector(
        '#createstickyOpac'
    );

    const createCanvas_btn = document.querySelector('#createDraw');


    if (!document.querySelector(".textareaSticky") == false) {
        document.querySelector(".textareaSticky").addEventListener('click', function () {
            console.log("click");
        });
    }


    const stickyTitleInput = document.querySelector('#stickytitle');
    const stickyTextInput = document.querySelector('#stickytext');

    const deleteSticky = e => {
        e.target.parentNode.remove();
    };

    const deleteCanvas = e => {
        e.target.parentNode.remove();
    }

    let isDragging = false;
    let dragTarget;

    let lastOffsetX = 0;
    let lastOffsetY = 0;

    function drag(e) {
        if (!isDragging) return;

        // console.log(lastOffsetX);

        dragTarget.style.left = e.clientX - lastOffsetX + 'px';
        dragTarget.style.top = e.clientY - lastOffsetY + 'px';
    }

    function createSticky() {
        const newSticky = document.createElement('div');
        const html = `<textarea class="textarea_title_sticky w-100" maxlength="18" placeholder="Titre"></textarea><span class="dashedLine"></span><textarea class="w-100 textareaSticky" placeholder="contenue" cols="24" rows="8"></textarea><canvas class="drawing-canvas dnone mx-auto"></canvas><span class="deletesticky">&times;</span>`
        newSticky.classList.add('drag', 'sticky');
        newSticky.innerHTML = html;
        newSticky.style.backgroundColor = randomColor();
        stickyArea.append(newSticky);
        positionSticky(newSticky);
        if (document.querySelectorAll('.sticky').length > 0) {
            const textarea_title_sticky = document.querySelectorAll('.textarea_title_sticky');
            textarea_title_sticky.forEach(textarea_title_sticky => {
                textarea_title_sticky.addEventListener('keydown', (event) => {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                    }
                })
            });
        }
        applyDeleteListener();
        clearStickyForm();
    }

    function createCanvas() {
        // Créer un canvas et l'ajouter au DOM
        const canvas_container = document.createElement('div');
        const canvas_delete = document.createElement('span')
        const canvas_rubber = document.createElement('span')
        canvas_rubber.classList.add('rubber_btn')
        canvas_rubber.innerHTML = '<iconify-icon icon="jam:rubber"></iconify-icon>'
        canvas_delete.innerHTML = "&times"
        canvas_delete.classList.add('canva_delete');
        canvas_container.classList.add('canvas_container', 'drag')
        const canvas = document.createElement('canvas');
        canvas.classList.add('drawing-canvas');
        canvas_container.appendChild(canvas)
        canvas_container.appendChild(canvas_delete)
        canvas_container.appendChild(canvas_rubber)
        stickyArea.append(canvas_container);
        positionCanvas(canvas);

        // Récupérer le contexte du canvas pour pouvoir dessiner dessus
        const ctx = canvas.getContext('2d');

        // Initialiser les variables pour le dessin
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        // Gérer le début et la fin du dessin lorsque l'utilisateur presse et relâche le bouton de la souris
        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        });
        canvas.addEventListener('mouseup', () => isDrawing = false);

        // Gérer le mouvement de la souris et dessiner un segment de ligne entre la position précédente et la position actuelle
        canvas.addEventListener('mousemove', (e) => {
            if (!isDrawing) return;

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();

            [lastX, lastY] = [e.offsetX, e.offsetY];
        });
        applyDeleteCanvas();
        applyRubberCanvas();
    }



    function clearStickyForm() {
        stickyTitleInput.value = '';
        stickyTextInput.value = '';
    }

    function rubberCanvas() {
        ctx.clearRect();
    }

    function positionCanvas() {
        const canvas = document.querySelector('.drawing-canvas');
        canvas.style.left = window.innerWidth / 2 - canvas.clientWidth / 2 + 'px';
        canvas.style.top = canvas.clientHeight / 2 + 'px';
    }

    function positionSticky(sticky) {
        sticky.style.left =
            window.innerWidth / 2 -
            sticky.clientWidth / 2 +
            (650 + Math.round(Math.random() * 50)) +
            'px';
        sticky.style.top =
            sticky.clientHeight / 2 +
            (0 + Math.round(Math.random() * 50)) +
            'px';
    }

    function randomColor() {
        const r = 200 + Math.floor(Math.random() * 56);
        const g = 200 + Math.floor(Math.random() * 56);
        const b = 200 + Math.floor(Math.random() * 56);
        return 'rgb(' + r + ',' + g + ',' + b + ')';
    }


    function applyDeleteListener() {
        let deleteStickyButtons = document.querySelectorAll(
            '.deletesticky'
        );
        deleteStickyButtons.forEach(dsb => {
            dsb.removeEventListener('click', deleteSticky, false);
            dsb.addEventListener('click', deleteSticky);
        });
    }

    function applyDeleteCanvas() {
        let deleteCanvasBtn = document.querySelectorAll('.canva_delete');
        deleteCanvasBtn.forEach(dc => {
            dc.removeEventListener('click', deleteCanvas, false);
            dc.addEventListener('click', deleteCanvas)
        })
    }

    function applyRubberCanvas() {
        let rubberCanvasBtn = document.querySelectorAll('.rubber_btn')
        rubberCanvasBtn.forEach(rcb => {
            rcb.removeEventListener('click', rubberCanvas, false);
            rcb.addEventListener('click', function () {
                console.log("ok");
            })
            // rcb.addEventListener('click', rubberCanvas);
        })
    }

    window.addEventListener('mousedown', e => {
        if (!e.target.classList.contains('drag')) {
            return;
        }
        dragTarget = e.target;
        dragTarget.parentNode.append(dragTarget);
        lastOffsetX = e.offsetX;
        lastOffsetY = e.offsetY;
        // console.log(lastOffsetX, lastOffsetY);
        isDragging = true;
    });
    window.addEventListener('mousemove', drag);
    window.addEventListener('mouseup', () => (isDragging = false));

    createStickyButton.addEventListener('click', createSticky);
    createCanvas_btn.addEventListener('click', createCanvas);

    applyDeleteListener();
    applyDeleteCanvas();
    applyRubberCanvas();

});



// Toolbox
const toolBox_btn = document.querySelector('#toolBox_btn');
const toolbox_content = document.querySelector('#toolbox_content');
const espaceVoid = document.querySelector('#espaceVoid')

toolBox_btn.addEventListener('click', () => {
    espaceVoid.classList.toggle('dnone');
    toolbox_content.classList.toggle('dnone');

});

party.confetti(runButton, {
    count: party.variation.range(200, 400),
    spread: party.variation.range(200, 400),
    zindex: 999999999999,
});