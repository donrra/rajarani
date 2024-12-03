<script type="text/javascript">
    $(document).ready(function() {

        //if submit button is clicked
        $('#submit').click(function() {
            var urlbaseDir = "<?php echo Yii::app()->request->baseUrl; ?>";
            var comment = $('textarea[name=comment]');
            if (comment.val() == '') {
                comment.addClass('hightlight');
                return false;
            } else
                comment.removeClass('hightlight');

            //organize the data properly
            var data = 'comment=' + encodeURIComponent(comment.val());

            //disabled all the text fields
            $('.text').attr('disabled', 'true');

            //show the loading sign
            $('.loading').show();

            //start the ajax
            $.ajax({
                //this is the php file that processes the data and send mail
                url: urlbaseDir + '/profile/process',
                //GET method is used
                type: "POST",
                //pass the data			
                data: data,
                //Do not cache the page
                cache: false,
                //success
                success: function(html) {
                    $('.form').fadeOut('slow');
                    $('.done').fadeIn('slow');
                }
            });

            //cancel the submit button default behaviours
            return false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#message_body').focus(function() {
            if ($(this).attr("placeholder"))
                $(this).attr("placeholder", '');
        })

        $('#message_body').blur(function() {
            if ($(this).attr("placeholder") == '')
                $(this).attr("placeholder", 'Message');
        })
    })
    var time_interval = setInterval(
            function() {
                $.ajax({
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/message/view/dropdownrefresh?message_id=<?php echo $_GET['message_id'] ?>",
                                        type: 'post',
                                        cache: false,
                                        success: function(html) {
                                            $("#dropdown").html(html);
                                        }
                                    })
                                }, 5000);

</script>




<?php $this->pageTitle = Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<article class="container">
    <em class="shadow_1"></em>
    <div class="wrapper">
        <div class="succes_msg" style="display:none;"></div>
        <div class="white_body">
            <div class="left_container">
                <div class="left_block equal">
                    <!-- message list -->
                    <section class="top_block">
                        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
                        <aside class="msg_profile">
                            <?php
                            if ($viewedMessage->sender_id == Yii::app()->user->getId()) {
                                $photoid = $viewedMessage->receiver_id;
                            } else {
                                $photoid = $viewedMessage->sender_id;
                            }
                            $sendermodel = User::model()->findByAttributes(array('id' => $photoid));

                            if ($sendermodel->profile->avatar != NULL) {
                                $circularthumbimg = Yii::app()->request->baseUrl . '/' . $sendermodel->profile->avatar;
                            } else {
                                $circularthumbimg = Yii::app()->request->baseUrl . '/user_avatar/thumb/default.jpg';
                            }
                            ?><figure>
                                <div class="pro_img circular" style="background: url(<?php echo $circularthumbimg; ?>) no-repeat;"><img src="<?php echo $circularthumbimg; ?>" />
                                </div></figure>
                            <div class="msg_title">
                                <?php if ($isIncomeMessage): ?>
                                    <h4 class="message-from">From:

                                        <?php
                                        if ($viewedMessage->getSenderName() == 'admin') {
                                            echo ($viewedMessage->getSenderName() == 'admin') ? 'The Rajarani Team' : $viewedMessage->getSenderName();
                                        } else {


                                            $language = Yii::app()->language;
                                            if (Yii::app()->language == 'en')
                                                $language = 'uk';

                                            echo CHtml::link(($viewedMessage->getSenderName() == 'admin') ? 'The Rajarani Team' : $viewedMessage->getSenderName(), Yii::app()->baseurl . '/' . $language . '/user/profile/' . $viewedMessage->getSenderName());
                                        }
                                        ?></h4>
                                <?php else: ?>
                                    <h4 class="message-to">To: </h4>
                                    <?php echo CHtml::link($viewedMessage->getReceiverName(), array('/user/profile/' . $viewedMessage->getReceiverName())); ?>
                                <?php endif; ?>
                                <p class="msg">
                                    <?php
                                    if (strlen($viewedMessage->subject) > 30) {
                                        echo strrev(stristr(strrev(substr(CHtml::encode($viewedMessage->subject), 0, 30)), ' ')) . " ...";
                                    } elseif (strlen($viewedMessage->subject) == 0) {
                                        echo '';
                                    } else {
                                        echo CHtml::encode($viewedMessage->subject);
                                    }
                                    ?>
                                </p>
                                <p class="date">
                                    <?php
                                    $tmp = date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at));
                                    $date = new DateTime($tmp);
                                    echo $date->format('l, F jS');
                                    ?>.</p>
                            </div>
                            <div class="right top_space" id="dropdown">
                                <div class="dropdown s_dropdown"  id="vmaction">
                                    <span class="select">Actions</span>
                                    <ul>
                                        <li id="spam"><span>Mark as spam</span></li>

                                        <?php
                                        $user_Senderon = Yii::app()->db->createCommand("select * from online_users where user_id='" . $viewedMessage->sender_id . "' and online=1")->queryRow();
                                        $user_Receiveron = Yii::app()->db->createCommand("select * from online_users where user_id='" . $viewedMessage->receiver_id . "' and online=1")->queryRow();
                                        if ($viewedMessage->sender_id != Yii::app()->user->getId()) {
                                            if ($user_Senderon) {
                                                ?>
                                                <li id="chat"><span onclick="javascript:chatWith('<?php echo $viewedMessage->getSenderName(); ?>')">Chat</span></li><?php
                                            }
                                        } elseif ($viewedMessage->receiver_id != Yii::app()->user->getId()) {
                                            if ($user_Receiveron) {
                                                ?><li id="chat"><span onclick="javascript:chatWith('<?php echo $viewedMessage->getReceiverName(); ?>')">Chat</span></li><?php }
                                    }
                                        ?>
                                        <li id="delete"><span>Delete</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </aside>
                    </section>
                    <section class="content_block2">

                        <?php
                        $blckeduser = Yii::app()->db->createCommand("select * from  user_profile_block where blocked_by='" . $viewedMessage->sender_id . "' and blocked='" . $viewedMessage->receiver_id . "' or blocked_by='" . $viewedMessage->receiver_id . "' and blocked='" . $viewedMessage->sender_id . "'")->queryRow();
                        if ($viewedMessage->type != 1 && Yii::app()->user->checkAccess('Message.Compose.Compose') && !$blckeduser) {
                            $senduserstatus = Yii::app()->db->createCommand("select status from users where id='" . $viewedMessage->sender_id . "'")->queryRow();
                            $recieveuserstatus = Yii::app()->db->createCommand("select status from users where id='" . $viewedMessage->receiver_id . "'")->queryRow();
                            if ($senduserstatus['status'] != 2 && $recieveuserstatus['status'] != 2) {
                                ?>
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'message-form',
                                    'enableAjaxValidation' => false,
                                ));
                                ?>

                                <?php echo $form->errorSummary($message); ?>
        <?php echo $form->hiddenField($message, 'receiver_id'); ?>
        <?php echo $form->error($message, 'receiver_id'); ?>
                                <aside class="field_2">
                                    <p class="icons">
                                        <a href="#" class="link_ico1"></a>
                                        <a href="#" class="cam_ico1"></a>
                                    </p>
                                    <p>
                                        <?php echo $form->hiddenField($message, 'subject', array('size' => 20, 'maxlength' => 20, 'value' => 'Re:' . CHtml::encode($viewedMessage->subject))); ?>
                                        <?php echo $form->hiddenField($message, 'message', array('size' => 20, 'value' => $viewedMessage->message)); ?>
        <?php echo $form->hiddenField($message, 'parent_id', array('size' => 20, 'value' => $viewedMessage->id)); ?>
                                        <?php echo $form->textArea($message, 'body', array('rows' => 10, 'cols' => 45, 'placeholder' => 'Message', 'id' => 'message_body', 'class' => 'textarea')); ?>
                                    </p>
                                    <p class="greenbtn">
        <?php echo CHtml::submitButton(MessageModule::t("Send message")); ?>
                                        <em></em></p>
                                    <div class="clear"></div>
                                </aside>
                                <?php $this->endWidget(); ?>
                                <?php
                            }
                        }
                        ?>
                        <aside class="msg_text_block">
                            <div class="msg_text" >
                                <p><?php
                        echo nl2br(CHtml::decode($viewedMessage->body));
                        ?></p>
                            </div>

                            <?php
                            if ($viewedMessage->message != NULL)
                                foreach ($messagehistory as $histmessage):
                                    if ($histmessage['id'] != $viewedMessage->id) {
                                        ?>
                                        <div class="msg_yellow">
                                            <h5><?php
                                                $username = Yii::app()->db->createCommand("select username from users where id='" . $histmessage['sender_id'] . "'")->queryRow();

                                                echo $username['username'];
                                                ?> 
                                                <span><?php echo MessageModule::t('Replied'); ?>
            <?php echo compare_dates(strtotime($histmessage['created_at'])); ?></span>
                                            </h5>
                                            <div class="text_block">
                                                <p>
                                                    <?php
                                                    echo nl2br(CHtml::encode($histmessage['body']));
                                                    ?></p>
                                            </div>
                                        </div>

        <?php } endforeach ?>

                        </aside>

                    </section>
                    <!-- message list End -->
                </div>

            </div>
            <div class="right_container equal">

                    <?php $this->widget('application.modules.user.components.sideprofilewidget'); ?>                
                <section class="block-space">
<?php $this->widget('application.components.sitecomment'); ?>
                </section>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</article>

<script type="text/javascript">
    $(document).ready(function() {

        $('div #vmaction li').click(function()
        {

            if ($(this).attr('id') == 'delete')
            {
                var confmsg = confirm('Do you want to delete the message?');
                var msgid =<?php echo $_GET['message_id'] ?>;
                if (confmsg)
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo Yii::app()->request->baseUrl; ?>/message/delete",
                        datatype: "json",
                        data: {id: msgid, actiontype: 'ajax'},
                        success: function(complete) {
                            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/message";
                        }
                    })
                return false;
            }
            if ($(this).attr('id') == 'spam')
            {
                var msgid = $('#Message_parent_id').val();
                $.ajax({
                    type: 'GET',
                    url: "<?php echo Yii::app()->request->baseUrl; ?>/message/spam",
                    datatype: "json",
                    data: {id: msgid, actiontype: 'ajax'},
                    success: function(complete) {
                        window.location = "<?php echo Yii::app()->request->baseUrl; ?>/message";
                    }
                })
                return false;


            }
        });

    });
</script>