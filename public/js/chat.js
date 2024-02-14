// handle the reciver id
let recieverID = null;

// for contacts
let contacts = document.querySelectorAll(".discussion");
console.log(contacts);
contacts.forEach((contact) => {
    contact.addEventListener("click", (e) => {
        recieverID = contact.dataset.reciever;
        console.log(recieverID);
        // fetchChatHistory();
    });
});

// handle fetching the chat history from the server
function fetchChatHistory() {
    axios
        .post("/messages", {
            reciever: recieverID,
        })
        .then((response) => {
            console.log(response.data);
            showMessages(response.data);
        })
        .catch((error) => {
            console.error(error);
        });
}
