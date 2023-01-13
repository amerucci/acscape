if (window.location.href.includes("admin")) {
    document.querySelector('footer').style.display = "none";
    document.querySelector('nav').classList.add("navbar-navAdmin");
}

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


oneLoad = {
    value: true
};

function displayNoneAllContainer() {
    const container = document.querySelectorAll('.container-fluid');
    container.forEach(el => {
        el.classList.add('dnone');
        el.classList.add('fade');
    });
}

function removeDisplayNoneAllContainer() {
    const container = document.querySelectorAll('.container-fluid');
    container.forEach(el => {
        el.classList.remove('dnone');
        el.classList.remove('fade');
    });
}


if (window.location.href == "http://juldev.fr/" || window.location.href == "https://juldev.fr/") {
    displayNoneAllContainer();
    if (document.getElementById('loader') != null) {
        setTimeout(function () {
            document.getElementById('loader').classList.add('show');
            document.getElementById('loader').classList.remove('dnone');
        }, 200);
    }
    document.onreadystatechange = function () {
        if (document.readyState == "complete") {
            let storedValue = JSON.parse(sessionStorage.getItem("oneLoad"));
            if (storedValue === null || storedValue) {
                setTimeout(function () {
                    document.getElementById('loader').classList.remove('show');
                    document.getElementById('loader').remove();
                    oneLoad.value = false;
                    sessionStorage.setItem("oneLoad", oneLoad.value);
                    removeDisplayNoneAllContainer()
                }, 2000);
            } else {
                removeDisplayNoneAllContainer()
                document.getElementById('loader').remove();
            }
        }
    }
}



let screen = window.screen;
let oneTouch = true

if (window.location.href.includes("ingame")) {
    document.onreadystatechange = function () {
        if (document.readyState == "complete") {
            setTimeout(function () {
                document.getElementById('loader').classList.add('fade');
                document.getElementById('loader').remove();
            }, 2000);
            setTimeout(function () {
                document.getElementById('loader').remove();
                document.querySelector('.nb-0').click();
                if (document.getElementById("roomsOpen")) {
                    document.getElementById("roomsOpen").addEventListener("click", function () {
                        if (oneTouch == true) {
                            setInterval(updateCountdown, 1000);
                        }
                        oneTouch = false;
                    });
                }
            }, 2100);
        }
    }


    document.querySelector('.navbar-nav').classList.add("navbar-navInGame");
    document.querySelector('.nav-links').classList.add("nav-links-InGame");
    document.querySelector('.nav-header').classList.add("nav-header-InGame");
    document.querySelector('.nav-logo > img:nth-child(1)').classList.add("nav-logo-InGame");
    document.querySelector('.nav > .nav-btn').classList.add("nav-btn-InGame");
    document.querySelector('.navLog').classList.add("navnavLog-InGame");
    document.querySelector('.nav').style.zIndex = "1";
    document.querySelector('.nav').style.position = "relative";
    document.querySelector('.ingame_container_background').style.backgroundRepeat = "no-repeat";
    document.querySelector('.ingame_container_background').style.backgroundPosition = "center";
    document.querySelector('body').style.backgroundRepeat = "no-repeat";
    document.querySelector('body').style.backgroundPosition = "center";
    document.querySelector('.footer_acs').style.background = "transparent";
    document.querySelector('.footer_acs').style.height = "auto";
    document.querySelector('footer').setAttribute('data-footer', "none")


} else {
    // document.querySelector('.navbar-nav').classList.remove("navbar-navInGame");

}


const legals_mentions = document.querySelector('.legals_mentions');

async function fetchMentions() {
    const response = await fetch('/public/app/mentions.json');
    const data = await response.json();
    return data;
};

let dataMl

legals_mentions.addEventListener('click', () => {


    fetchMentions().then(data => {

        dataMl = data.mentions_legales;


        const modal = document.createElement('div');
        modal.classList.add('modal', 'fade');
        modal.id = 'exampleModal';
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'exampleModalLabel');
        modal.setAttribute('aria-hidden', 'true');
        modal.innerHTML = `
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mentions légales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body wiki_modal d-flex justify-content-center align-items-center flex-column">
    <h3>Utilisation d'une Iframe</h3>
    <p class="w-75">${dataMl.iframe.description}</p>
    <p class="w-75">${dataMl.iframe.attribution}</p>
    <p class="w-75">${dataMl.iframe.licence.nom}</p>
    <p class="w-75">${dataMl.iframe.licence.url}</p>
    <p class="w-75">${dataMl.iframe.respect_des_droits}</p>
    </div>
</div>
</div>
`;
        document.body.appendChild(modal);
        const modalBootstrap = new bootstrap.Modal(modal);
        modalBootstrap.show();

        const wiki_modal = document.querySelector('.wiki_modal');

        modal.addEventListener('hidden.bs.modal', function () {
            modal.remove();
        });
    });
});

// scroll to top
if (document.querySelector('.toTop')) {
    const toTop = document.querySelector('.toTop');
    toTop.addEventListener('click', () => {
        window.scrollTo(0, 0);
    });
}

function deleteRecord() {
    if (confirm("Voulez-vous vraiment supprimer cet enregistrement ? Cette action est irréversible.")) {
        document.getElementById("deleteForm").submit();
    }
}