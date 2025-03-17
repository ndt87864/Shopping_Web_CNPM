<?php
$user_id = $_SESSION['user_id'];
$query_user = query("SELECT username,msg_id,user_photo FROM users WHERE user_id = " . escape_string($user_id));
confirm($query_user);
$row_user = fetch_array($query_user);
$user_name = $row_user['username'];
$current_user_id = $row_user['msg_id'];
$user_photo = $row_user['user_photo'];
$other_user_id = $_GET['message_id'];
$query_user2 = query("SELECT username,user_photo FROM users WHERE msg_id = " . escape_string($other_user_id));
confirm($query_user2);
$row_user2 = fetch_array($query_user2);
$user_name = $row_user2['username'];
$user_photo2 = $row_user2['user_photo'];
if (isset($_POST['submit_msg'])) {
    if (!empty($_POST['msg'])) {
        $message = mysqli_real_escape_string($connection, $_POST['msg']);
        $query = "INSERT INTO messages (sender_id, receiver_id, msg, date) VALUES ('$current_user_id', '$other_user_id', '$message', NOW())";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            echo "Lỗi khi lưu tin nhắn: " . mysqli_error($connections);
        } else {
            redirect("index_user.php?message&message_id=$other_user_id ");
        }
    }
}
$query = "SELECT * FROM messages WHERE (sender_id=$current_user_id AND receiver_id=$other_user_id)  OR (sender_id=$other_user_id AND receiver_id=$current_user_id)";
$result = mysqli_query($connection, $query);
if (!$result) {
    echo "Lỗi khi truy vấn tin nhắn: " . mysqli_error($connection);
}
?>
<div class="col-12">
    <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Dịch vụ hỗ trợ </h3>
        </div>
        <div id="chat">
            <div class="box-body">
                <div class="direct-chat-messages">
                    <?php while ($row = mysqli_fetch_assoc($result)):
                        $date = date('H:i:s d-m-Y', strtotime($row['date'])); ?>
                        <?php
                        if ($row['sender_id'] == $current_user_id) { ?>

                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Bạn</span>
                                </div>
                                <img class="direct-chat-img" src="../../kresources/uploads/<?php echo $user_photo ?>"
                                    alt="message user image">
                                <div class="direct-chat-text">
                                    <?php echo $row['msg']; ?>
                                </div>
                                <span class="direct-chat-timestamp pull-right">
                                    <?php echo $date; ?>
                                </span>
                            </div>
                        <?php } elseif ($row['sender_id'] == $other_user_id) { ?>

                            <div class="direct-chat-msg left">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Admin:
                                        <?php echo $user_name; ?>
                                    </span>
                                </div>
                                <img class="direct-chat-img" src="../../kresources/uploads/<?php echo $user_photo ?>"
                                    alt="message user image">
                                <div class="direct-chat-text">
                                    <?php echo $row['msg']; ?>
                                </div><br>
                                <?php echo $date; ?>
                            </div>
                        <?php }
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="flex-container">
                    <input type="text" class="custom-form" name="msg" placeholder="Nhập tin nhắn">
                    <button type="submit" name="submit_msg">
                    <i class="fas fa-paper-plane btn btn-primary"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var chatMessages = document.querySelector('.direct-chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
</script>
<script>
    setInterval(function () {
        $('#chat').load(location.href + ' #chat', function () {
            var chatMessages = document.querySelector('.direct-chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    }, 2000);
</script>