require('./bootstrap');

const messages_el = document.getElementById("messages");
const name_input = document.getElementById("name");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");

message_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let has_errors = false;

    if (name_input.value == '') {
      alert("Please enter a name");
      has_errors = true;
    }
    if (message_input.value == '') {
        alert("Please enter a message");
        has_errors = true;
    }
    if (has_errors) {
        return;
    }

    const options = {
        method: 'post',
        url: '/send-message',
        data: {
            name: name_input.value,
            message: message_input.value
        }
    }

    axios(options);
});

window.Echo.channel('chat')
    .listen('.message', (e) => {
        messages_el.innerHTML += '<div class="message"><strong>' + e.name + ':</strong>' + e.message
        + '</div>';
    })

