const isLocal = window.location.hostname === "localhost" || window.location.hostname === '127.0.0.1';

const backend_ = isLocal ? "../backend/" : "https://rhino-primary-fish.ngrok-free.app/auth_system/backend/";

const login_ = backend_ + "login.php";
const logout_ = backend_ + "logout.php";
const action_ = backend_ + "action.php";
const home_page = "home.html";
const login_page = "login.html";

const page = window.location.pathname.split('/').pop();

async function run_auth(){
    const auth = await fetch(backend_+'auth_js.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'ngrok-skip-browser-warning': 'true'
        }
        });
    const logged_in = await auth.json(); 
    if (logged_in.success && page == login_page){
        window.location.href = home_page;
    }else if (!logged_in.success && page != login_page){
        login();
        // alert('Please Log In to Continue...');
    }
}

run_auth();

function alertErr(error){
    alert("Server Error!!!");
    console.log(error);
}

function login(){
    window.location.href = login_page;
}

let permitted = true;

function btn_ui_behavior(me,clicked){
    if(clicked){
        me.disabled = true;
        me.style.cursor = "progress";
    }else{
        me.disabled = false;
        me.style.cursor = "pointer";
    }
}

const header = {headers: { 'ngrok-skip-browser-warning': 'true' }};

