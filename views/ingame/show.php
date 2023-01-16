<div class="modal-content furnitureLock">
    <div class="modal-header">

        <h5 class="modal-title mx-auto d-flex align-items-center gap-3" id="furnitureModalLockLabel">${furniture.title}
        </h5>

        <button type="button" class="closeLock" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                <iconify-icon icon="akar-icons:cross" style="color: #d31e44;" width="35" height="35">
                </iconify-icon>
            </span>
    </div>
    <div class="d-flex  clue_show desc_container fade show w-100 gap-1">
        <img src="/assets/pictures/furnitures/${furniture['picture']}" class="img_furniture" alt="" width="100%"
            height="100%">
        <p class="description_room">${furniture['description']}</p>
    </div>
    <div class="modal-body d-flex flex-column flex-md-row">

        <div class="d-flex flex-column clue_show w-50 gap-1 input_container ">
            <div class="w-100">
                <div class="d-flex">
                    <input type="text" class="form-control" id="furniture_key_unlock"
                        placeholder="Entrer la clé pour ${furniture.title}">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="furniture_key_unlock_btn">
                        <iconify-icon class="key_btn" icon="fluent-emoji-high-contrast:old-key"></iconify-icon>
                    </button>
                </div>
                <div class="d-flex align-items-center gap-5"></div>
                <p class="furniture_reward dnone"></p>
            </div>
            <div class="d-flex flex-column switch_container fade show">
                <div class="progress w-100 h-100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated furniture_unlock_statut"
                        role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0"
                        aria-valuemax="100" style="width: 100%"></div>
                </div>
                <p class="text-center penality_info mt-2"></p>
            </div>
        </div>
        <div class="d-flex flex-column w-50 align-items-center gap-3 clue_container">
            <div class="d-flex gap-3 justify-content-center w-100">
                <button class="clue_show1 my-2 px-2">Indice 1</button>
                <button id="timelaps" class="clue_show2 my-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="30s après la découverte du 1er indice">indice 2</button>
                <button class="clue_show3 my-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="30s après la découverte du 2nd indice">indice 3</button>
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
    </div> `;