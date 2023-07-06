function populateUsers(info) {
    const flexContainer = document.body.querySelector(".results-container");

    const card = document.createElement('div');
    card.classList.add("user-container");

    // <i class="follow-button fa-solid fa-user-plus"></i>
    const clickableFollowButton = document.createElement("i");

    clickableFollowButton.dataset.id = info['id'];
    clickableFollowButton.dataset.followed = info['followed'];

    if (!info['followed']) {
        clickableFollowButton.classList.add('follow-button', 'fa-solid', 'fa-user-plus');
    } else {
        clickableFollowButton.classList.add('follow-button', 'fa-solid', 'fa-user-minus', 'added');
    }

    const image = document.createElement('img');
    image.src = profileImageUrlBase + "/" + info['avatar'];
    image.style.width = '100%';

    const cardBody = document.createElement('div');
    cardBody.classList.add("textcontent-container");

    const usernameElem = document.createElement('h4');
    usernameElem.classList.add('dark:text-white');
    usernameElem.textContent = info['username'];
    cardBody.appendChild(usernameElem);

    flexContainer.append(card);
    card.append(image, cardBody, clickableFollowButton);

}

function followHandler(event) {
    const UID = event.target.dataset.id;

    async function followRespHandler(followResp) {
        if (followResp.status !== 200) {
            return Promise.reject("Bad Response!");
        }
        return Promise.resolve(followResp.data);
    }
    function textRespHandler(textResp) {
        const followBool = textResp === 'followed';
        event.target.dataset.followed = followBool;
        if (followBool) {
            event.target.classList.remove('fa-user-plus');
            event.target.classList.add('added');
            event.target.classList.add('fa-user-minus');
        } else {
            event.target.classList.remove('fa-user-minus');
            event.target.classList.remove('added');
            event.target.classList.add('fa-user-plus');
        }
    }

    const followBool = event.target.dataset.followed === 'true';
    if (followBool) {
        axios.delete(`/search-people`, {data: {follow: UID}}).then(followRespHandler).then(textRespHandler);
    } else {
        axios.post(`/search-people`, {follow: UID}).then(followRespHandler).then(textRespHandler);
    }

}


function searchSubmit(event) {
    event.preventDefault();
    if (document.body.querySelector(".results-container")) {
        document.body.querySelector(".results-container").innerHTML = "";
    }
    const searchedUser = encodeURIComponent(search_user_form['search'].value);

    async function searchedUserHandler(searchResp) {
        if (searchResp.status !== 200) {
            return Promise.reject("Bad Response");
        }
        return Promise.resolve(searchResp.data);
    }

    function jsonRespHandler(jsonResp) {
        console.log(jsonResp);
        const users = jsonResp['users'];
        for (let i = 0; i < users.length; i++) {
            populateUsers(users[i]);
        }
        const userResults = document.querySelectorAll('.follow-button');
        for (fbut of userResults) {
            fbut.addEventListener('click', followHandler);
        }
        const resContainer = document.querySelector('.results-container');
        resContainer.style.opacity = '1';
    }

    axios.get(`/search-people?searchedUser=${searchedUser}`).then(searchedUserHandler).then(jsonRespHandler);

}

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

const search_user_form = document.querySelector('.search-form');
search_user_form.addEventListener('submit', searchSubmit);
