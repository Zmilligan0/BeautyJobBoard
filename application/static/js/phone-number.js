const msg = document.querySelector(".v-message");
const svg = document.querySelector(".svg-info");
const resendButton = document.querySelector(".resend");
const changeButton = document.querySelector(".change");
const sendButton = document.querySelector(".send-button");
const phone = document.querySelector(".phone-input");

setTimeout(() => {
    msg.textContent = "The verification code has expired please try again";
    console.log("Delayed for 1 second.");
    msg.classList.remove("text-primary");
    msg.classList.add("text-danger");

    svg.classList.remove("text-primary");
    svg.classList.add("text-danger");

    resendButton.style.display = "none";
    changeButton.style.display = "none";

    sendButton.removeAttribute("disabled");
}, 5 * 60 * 1000);
