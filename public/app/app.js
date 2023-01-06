if (window.location.href == "http://acscape/" || window.location.href ==
    "http://acscape/index" || window.location.href == "http://acscape/show") {
    document.querySelector('.navbar').style.position = "absolute";
} else {
    document.querySelector('.navbar').style.position = "relative";
}

if (window.location.href.includes("admin")) {
    document.querySelector('footer').style.display = "none";
}

let screen = window.screen;

if (window.location.href.includes("ingame")) {
    document.onreadystatechange = function () {
        if (document.readyState == "complete") {
            setTimeout(function () {
                document.getElementById('loader').classList.add('fade');
            }, 2000);
            setTimeout(function () {
                document.getElementById('loader').remove();
            }, 2100);
        }
    }
    document.querySelector('.navbar').style.color = "white";
    document.querySelector('.navLog').style.marginRight = "5%";
    document.querySelector('.navLog').style.background = "transparent";
    // document.querySelector('.ingame_container_background').style.backgroundImage = "url(assets/front/ingame/bg_ingame.jpg)";
    document.querySelector('body').style.backgroundImage = "url(assets/front/ingame/bg_ingame.webp)";
    document.querySelector('.navbar-nav').classList.add("navbar-navInGame");
    document.querySelector('.navbar-nav').style.marginLeft = "2%";
    document.querySelector('.navbar-nav').style.width = "50% !important";
    if (screen.width < 1440) {
        document.querySelector('.ingame_container_background').style.backgroundSize = "contain";
        document.querySelector('body').style.backgroundSize = "contain";
        document.querySelector('.navbar-nav').style.marginLeft = "0%";
    } else {
        document.querySelector('.ingame_container_background').style.backgroundSize = "cover";
        document.querySelector('body').style.backgroundSize = "cover";
    }

    document.querySelector('.ingame_container_background').style.backgroundRepeat = "no-repeat";
    document.querySelector('.ingame_container_background').style.backgroundPosition = "center";
    document.querySelector('body').style.backgroundRepeat = "no-repeat";
    document.querySelector('body').style.backgroundPosition = "center";
    document.querySelector('.footer_acs').style.background = "transparent";
    document.querySelector('.footer_acs').style.height = "auto";
    document.querySelector('footer').setAttribute('data-footer', "none")


} else {
    document.querySelector('.navbar-nav').classList.remove("navbar-navInGame");

}


const legals_mentions = document.querySelector('.legals_mentions');
// create modal boostrap5 for mentions légales
// fetch from public/app/mentions.json

async function fetchMentions() {
    const response = await fetch('public/app/mentions.json');
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