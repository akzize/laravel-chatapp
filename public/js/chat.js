// this function uis only to get html elements
function htmlElement(selector, all = false) {
    // the all param is for getting all the elements
    return all
        ? document.querySelectorAll(selector)
        : document.querySelector(selector);
} // htmlElement function END

// handle the reciver id
let recieverID = null;

// for contacts
let contacts = htmlElement(".discussion", true);
console.log(contacts);
contacts.forEach((contact) => {
    contact.addEventListener("click", (e) => {
        recieverID = contact.dataset.reciever;
        console.log(recieverID);
        fetchChatHistory();
    });
});

// handle showing messages when they're fetched
// Or the new message that is sent
function showMessagesOrMessage(user_messages) {
    console.log("enside ", user_messages);
    // the messages board
    const chatBoard = htmlElement("#messages-chat");
    let recievedMessage = `<div class="message">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text"> 9 pm at the bar if possible 😳</p>
                        </div>`;

    let sentMessage = `<div class="message text-only">
                            <div class="response">
                                <p class="text"> When can we meet ?</p>
                            </div>
                        </div>`;
    if (Array.isArray(user_messages)) {
        chatBoard.innerHTML = "";
        user_messages.forEach(({ id, sender, reciever, message }) => {
            chatBoard.innerHTML +=
                loggedInUser === sender
                    ? `<div class="message text-only">
                            <div class="response">
                                <p class="text">${message}</p>
                            </div>
                        </div>`
                    : `<div class="message">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text">${message}</p>
                        </div>`;
        });
    } else {
        // getting the message send 
        const { id, sender, reciever, message } = user_messages.message;

        chatBoard.innerHTML +=
            loggedInUser === sender
                ? `<div class="message text-only">
                            <div class="response">
                                <p class="text">${message}</p>
                            </div>
                        </div>`
                : `<div class="message">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
                                <div class="online"></div>
                            </div>
                            <p class="text">${message}</p>
                        </div>`;

        // console.error("user_messages is not an array:", user_messages);
    }
}

// handle fetching the chat history from the server
function fetchChatHistory() {
    fetch("/chat", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": htmlElement('meta[name="csrf-token"]').getAttribute(
                "content"
            ),
        },
        body: JSON.stringify({
            reciever: recieverID,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((response) => {
            console.log(response);
            showMessagesOrMessage(response);
        })
        .catch((error) => {
            console.error("from fetch: ", error);
        });
    /* axios
        .post("/chat", {
            reciever: recieverID,
        })
        .then((response) => {
            console.log(response.data);
            // showMessages(response.data);
        })
        .catch((error) => {
            console.error(error);
        }); */
}

// handle sending messages

const btnSendMessage = htmlElement("#send_message_btn");
const inputMessage = htmlElement("#write-message");

btnSendMessage.onclick = (e) => {
    // alert('Message Sent');
    e.preventDefault();
    fetch("/send-message", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": htmlElement('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
            message: inputMessage.value,
            sender: loggedInUser,
            reciever: recieverID,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((response) => {
            console.log(response.message);
            // to show the message in the sender board
            showMessagesOrMessage(response.message);
            inputMessage.value = "";
        })
        .catch((error) => {
            console.error(error);
        });
};
console.log(btnSendMessage);

// handle sending messages end

// initialize the listner for the new messages
window.Echo.private(`privatechat.${loggedInUser}`).listen(
    "PrivateMessageSent",
    (message) => {
        showMessagesOrMessage(message)
        console.log(message);
    }
);
