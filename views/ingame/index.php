<div class="tools d-flex gap-5">
    <div class="the_rooms d-flex justify-content-center align-items-center gap-2" data-toggle="modal"
        data-target="#roomsModal">
        <iconify-icon icon="material-symbols:meeting-room-outline"></iconify-icon>
        <p class="m-0 rooms_modal">les salles</p>
    </div>

    <div class="frisk d-flex justify-content-center align-items-center gap-2" data-toggle=" modal"
        data-target="#friskModal">
        <iconify-icon icon="uil:search-alt"></iconify-icon>
        <p class="m-0 frisk_modal">fouiller</p>
    </div>

    <div class="inventories d-flex justify-content-center align-items-center gap-2" data-toggle=" modal"
        data-target="#inventoriesModal">
        <iconify-icon icon="ph:suitcase-simple-bold"></iconify-icon>
        <p class="m-0 inventories_modal">votre inventaire</p>
    </div>
</div>

<!-- Modal rooms-->
<div class="modal fade modal-lg" id="roomsModal" tabindex="-1" role="dialog" aria-labelledby="roomsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="roomsModalLabel">Les salles disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;"></iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- Modal frisk -->
<div class="modal fade modal-lg" id="friskModal" tabindex="-1" role="dialog" aria-labelledby="friskModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="friskModalLabel">Fouiller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;"></iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- Modal inventories -->
<div class="modal fade modal-lg" id="inventoriesModal" tabindex="-1" role="dialog"
    aria-labelledby="inventoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="inventoriesModalLabel">Votre inventaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <iconify-icon icon="akar-icons:cross" style="color: #d31e44;"></iconify-icon>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<script>
    const the_rooms = document.querySelector('.the_rooms');
    const frisk = document.querySelector('.frisk');
    const inventories = document.querySelector('.inventories');
    the_rooms.addEventListener('click', function () {
        document.querySelector('#roomsModal').classList.add('show');
        document.querySelector('#roomsModal').style.display = 'block';
    });
    frisk.addEventListener('click', function () {
        document.querySelector('#friskModal').classList.add('show');
        document.querySelector('#friskModal').style.display = 'block';
    });
    inventories.addEventListener('click', function () {
        document.querySelector('#inventoriesModal').classList.add('show');
        document.querySelector('#inventoriesModal').style.display = 'block';
    });

    const close = document.querySelectorAll('.close');
    close.forEach(element => {
        element.addEventListener('click', function () {
            document.querySelector('#roomsModal').classList.remove('show');
            document.querySelector('#roomsModal').style.display = 'none';
            document.querySelector('#friskModal').classList.remove('show');
            document.querySelector('#friskModal').style.display = 'none';
            document.querySelector('#inventoriesModal').classList.remove('show');
            document.querySelector('#inventoriesModal').style.display = 'none';

        });
    });
</script>