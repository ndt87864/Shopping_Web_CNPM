<link href="css/support.css" rel="stylesheet">
<div class="card-support col-md-6">
    <h5 class="card-title text-center">Người dùng khiếu nại</h5>
    <div class="card-body">
        <ui class="contacts">
            <?php
            $query = query("SELECT username, msg_id,user_photo FROM users WHERE user_level = 1");
            confirm($query);
            $count = 0;
            if (mysqli_num_rows($query) > 0) {
                // Hiển thị dữ liệu từ mỗi hàng của bảng
                while ($row = fetch_array($query)) {
                    $msg_id = $row['msg_id'];
                    $query2 = query("SELECT * FROM messages");
                    confirm($query2);
                    while ($row2 = fetch_array($query2)) {
                        if ($row2["sender_id"] == $msg_id || $row2["receiver_id"] == $msg_id) {
                            $count = 1;
                        }
                    }
                    if ($count == 1) {
                        $query3 = query("SELECT * FROM messages WHERE sender_id=$msg_id OR receiver_id=$msg_id ORDER BY msg_id DESC");
                        confirm($query3);
                        $row3 = fetch_array($query3)
                            ?>
                        <li><a class="custom-link form-control" href="index.php?messages&message_id= <?php echo $row['msg_id']; ?>">
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
                    $count = 0;
                }
            } else {
                echo "Không có người dùng khiếu nại ";
            }
            ?>
        </ui>
    </div>
    <br />
</div>