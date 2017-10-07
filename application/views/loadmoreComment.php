
        <?php if(!empty($comments)): ?>
        <?php foreach($comments as $k=>$comment){  ?>
        <li class="col-xs-12"> 
            <div class="row">
                <div class="col-xs-12">
                    <div class="avatar">
                        <a href="<?php echo base_url("home/profile/".$comment->user_id); ?>"> 
                            <?php if (isset($comment->profile_pic) && !empty($comment->profile_pic)): ?>
                                <img src="<?php echo base_url("uploads/user-pic/" . $comment->profile_pic); ?>">
                            <?php else: ?>
                                <img src="<?php echo base_url() ?>assets/images/dis_adv_03.jpg">
                            <?php endif; ?>
                        </a> 
                    </div>

                    <div class="content">
                        <div class="meta">
                            <a href="<?php echo base_url("home/profile/".$comment->user_id); ?>"> 
                                <strong class="name">
                                        <?php if($comment->first_name && $comment->last_name){
                                                    echo ucwords($comment->first_name." ".$comment->last_name);
                                               }else{
                                                    echo ucwords($comment->username);
                                               }
                                        ?>
                                </strong>
                            </a> 
                            <p><strong><?php echo humanTime(strtotime($comment->created_date),2)." ago" ?></strong></p>
                        </div>
                        <p class="ui__p"><?php echo $comment->data ?></p>
                    </div>
                </div>
            </div>
        </li>
        <?php  } ?> 
     <?php endif; ?> 