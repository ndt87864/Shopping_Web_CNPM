<link href="css/support.css" rel="stylesheet">
<div class="card-support col-md-6">
    <h5 class="card-title text-center" style="margin-top: 20px;">LIÊN HỆ TRỰC TUYẾN</h5>
    <h7 class="card-title text-center" style="margin-left:205px;">Danh sách QTV:</h7>
    <div class="card-body">
        <ui class="contacts">
            <?php
            $sql = "SELECT username, msg_id,user_photo FROM users WHERE user_level = 2";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg_id = $row['msg_id'];

                    $query3 = query("SELECT * FROM messages WHERE sender_id=$msg_id OR receiver_id=$msg_id ORDER BY msg_id DESC");
                    confirm($query3);
                    $row3 = fetch_array($query3)
                        ?>
                    <li><a class="custom-link form-control" href="index_user.php?message&message_id= <?php echo $row['msg_id']; ?>">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="../../kresources/uploads/<?php echo $row['user_photo'] ?>"
                                        class="rounded-circle admin_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span>
                                        <?php echo $row["username"]; ?>
                                    </span>
                                    <?php
                                    if ($row3['sender_id'] == $msg_id) { ?>


                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">
                                                    Bạn:
                                                    <?php echo $row3['msg']; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php } elseif ($row3['receiver_id'] == $msg_id) { ?>

                                        <div class="direct-chat-msg left">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">
                                                    <?php echo $row["username"]; ?>:
                                                    <?php echo $row3['msg']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </a><br />
                    </li>
                <?php }
            } else {
                echo "Trợ giúp trực tuyến đang bận , thử lại sau ít phút ! ";
            }
            ?>
        </ui>
    </div>
    <br />
</div>