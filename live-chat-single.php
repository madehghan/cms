
<style>
    .chat-container {
      width: 400px;
      margin: 0 auto;
      border: 1px solid #ccc;
      padding: 10px;
    }
    
    .message {
      margin-bottom: 10px;
    }
    
    .sender {
      display: flex;
      align-items: flex-end;
    }
    
    .receiver {
      display: flex;
      align-items: flex-start;
      justify-content: flex-end; /* Align messages to the right */
    }
    
    .profile-picture {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-left: 10px; /* Adjust the margin to create space between the profile picture and message bubble */
      margin-right: 0; /* Remove the right margin */
    }
    
    .message-bubble {
      max-width: 70%;
      padding: 8px 12px;
      border-radius: 10px;
      background-color: #dcf8c6;
      text-align: left; /* Align text to the left */
    }
    
    .receiver .message-bubble {
      background-color: #f0f0f0;
      text-align: right; /* Align text to the right */
    }
    
    .time-place {
      font-size: 12px;
      color: #999;
    }
  </style>
<div class="box_cnrl">
    
    
<?php if(!isset($_GET['user1'])): ?>
  <div style="height:30vh;padding-top:15vh;">
  <center>یک گفتگو را انتخاب نمایید!</center>
  </div>
<?php endif; ?>

<?php if(isset($_GET['user1'])): ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
  // Function to load chat messages
  function loadChat() {
    var variableName = "<?php echo $_GET['user2'] ?>"; // Replace "example" with your PHP variable's value

    $.ajax({
      url: "fetch_messages.php",
      type: "GET",
      data: { variable: variableName }, // Pass the variable as data
      success: function(response) {
        $("#chat-messages").html(response);
      }
    });
  }
      
      // Function to send a new message
      function sendMessage() {
        var senderId = $("#sender-id").val();
        var message = $("#new-message").val();
        if (message.trim() !== "") {
          $.ajax({
            url: "send_message.php",
            type: "POST",
            data: { senderId: senderId, message: message },
            success: function(response) {
              $("#new-message").val("");
              loadChat(); // Reload chat messages
            }
          });
        }
      }
      
      // Load initial chat messages
      loadChat();
      
      // Refresh chat messages every 1 second
      setInterval(function() {
        loadChat();
      }, 1000);
      
      // Handle send button click
      $("#send-button").click(function() {
        sendMessage();
      });
      
      // Handle Enter key press in textarea
      $("#new-message").keypress(function(event) {
        if (event.which === 13 && !event.shiftKey) {
          event.preventDefault();
          sendMessage();
        }
      });
    });
  </script>
<?php endif; ?>
  <?php $user2 = $_GET['user2']; ?>
  
    <div id="chat-messages"></div>
    
    <!-- Select sender ID -->
    <select id="sender-id" style="display:none;">
      <option value="<?php echo $user2 ?>">Sender</option>
      <option value="receiver">Receiver</option>
    </select>
    
    <div class="message sender">
      <!-- Sender message content -->
    </div>
    
    <div class="message receiver">
      <!-- Receiver message content -->
    </div>

<?php if(isset($_GET['user1'])): ?>
  <div class="fixed-bottom flex-column-reverse" style="z-index: 1000000;">
    <textarea id="new-message" placeholder="چیزی تایپ کنید..." class="form-control"></textarea>
    <button id="send-button" style="display:none;">Send</button>
  </div>
<?php endif ?>
    
    
    
</div>

