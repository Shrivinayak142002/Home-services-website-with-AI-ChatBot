<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chatbot</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('Chatbot/static/styles/style.css') }}" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <!-- partial:index.partial.html -->
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-bug"></i> Chatbot <i class="fas fa-bug"></i>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Chatbot</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to ChatBot! Go ahead and send me a message. 😄
                    </div>
                </div>
            </div>

        </main>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" id="textInput" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
    <!-- partial -->
    <script src='https://use.fontawesome.com/releases/v5.0.13/js/all.js'></script>
    <script>
        const msgerForm = get(".msger-inputarea");
        const msgerInput = get(".msger-input");
        const msgerChat = get(".msger-chat");



        const BOT_IMG = "chatbot.png";
        const PERSON_IMG = "man.png";
        const BOT_NAME = "ChatBot";
        const PERSON_NAME = "You";

        msgerForm.addEventListener("submit", event => {
            event.preventDefault();

            const msgText = msgerInput.value;
            if (!msgText) return;

            appendMessage(PERSON_NAME, PERSON_IMG, "right", msgText);
            msgerInput.value = "";
            botResponse(msgText);
        });

        function appendMessage(name, img, side, text) {
            //   Simple solution for small apps
            const msgHTML = `
<div class="msg ${side}-msg">
  <div class="msg-img" style="background-image: url(${img})"></div>

  <div class="msg-bubble">
    <div class="msg-info">
      <div class="msg-info-name">${name}</div>
      <div class="msg-info-time">${formatDate(new Date())}</div>
    </div>

    <div class="msg-text">${text}</div>
  </div>
</div>
`;

            msgerChat.insertAdjacentHTML("beforeend", msgHTML);
            msgerChat.scrollTop += 500;
        }

        function botResponse(rawText) {

            // Bot Response
            $.get("/get", {
                msg: rawText
            }).done(function(data) {
                console.log(rawText);
                console.log(data);
                const msgText = data;
                appendMessage(BOT_NAME, BOT_IMG, "left", msgText);

            });

        }


        // Utils
        function get(selector, root = document) {
            return root.querySelector(selector);
        }

        function formatDate(date) {
            const h = "0" + date.getHours();
            const m = "0" + date.getMinutes();

            return `${h.slice(-2)}:${m.slice(-2)}`;
        }
    </script>

</body>

</html>