function populatePosts(info) {
    const gridContainer = document.body.querySelector('.grid');
    const column = document.createElement('div');
    column.classList.add('playlist')

    const iframeContainerHTML = `<iframe title="deezer-widget" src="https://widget.deezer.com/widget/dark/playlist/${info['playlist_deezer_id']}" width="100%" height="500" frameborder="0" allowtransparency="true" allow="encrypted-media; clipboard-write"></iframe>`
    column.innerHTML += iframeContainerHTML;

    // <i class="like-button fas fa-heart"></i>
    likeButton = document.createElement('i');
    likeButton.classList.add('like-button', 'fas', 'fa-heart');
    likeButton.addEventListener('click', resolveLike);
    likeButton.dataset.id = info['id'];
    if (info['like']) {
        likeButton.classList.add('liked');
    }

    column.appendChild(likeButton);

    const chatbox = document.createElement('div');
    chatbox.classList.add('chatbox');
    chatbox.textContent = info['user']['username'];
    column.appendChild(chatbox);

    gridContainer.appendChild(column);
}

function resolveLike(event) {
    async function resolveResponse(resp) {
        if (resp.status !== 200) {
            return Promise.reject('Bad response');
        }
        return Promise.resolve(resp.data);
    }
    const postId = encodeURIComponent(event.currentTarget.dataset.id);
    function resolveResponseCode(respCode) {
        if (respCode === 'Unlike') {
            event.target.classList.add('liked');
        } else {
            event.target.classList.remove('liked');
        }
    }

    // Check if playlist is liked or not
    if (event.target.classList.contains('liked')) {
        axios.delete(`/like-playlist/${postId}`).then(resolveResponse).then(resolveResponseCode);
    } else {
        axios.post(`/like-playlist/${postId}`).then(resolveResponse).then(resolveResponseCode);
    }
}

function jsonHandler(jsonResp) {
    for (const key in jsonResp) {
        populatePosts(jsonResp[key]);
    }
}

function responseHandler(resp) {
    if (resp.status !== 200) {
        return Promise.reject("Bad Response");
    }
    return Promise.resolve(resp.data)
}

function checkOverflowAndAddTooltip() {
    const chatboxes = document.querySelectorAll('.chatbox');

    chatboxes.forEach((chatbox) => {
        const isOverflowing = chatbox.offsetWidth < chatbox.scrollWidth;

        if (isOverflowing) {
            chatbox.setAttribute('title', chatbox.textContent);
        }
    });
}

axios.get('/homelist').then(responseHandler).then(jsonHandler);
var hamburgerMenu = document.querySelector('.hamburger-menu');
var navigationDrawer = document.getElementById('navigation-drawer');
var backdrop = document.getElementById('backdrop');

hamburgerMenu.addEventListener('click', function () {
    navigationDrawer.classList.toggle('open');
    backdrop.classList.toggle('visible');
});

backdrop.addEventListener('click', function () {
    navigationDrawer.classList.remove('open');
    backdrop.classList.remove('visible');
});


const hearts = document.querySelectorAll('.like-button');
hearts.forEach((heart) => {
    heart.addEventListener('click', function () {
        heart.classList.toggle('liked');
    });
});

checkOverflowAndAddTooltip();
