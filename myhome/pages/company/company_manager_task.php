<?php $date=new JDF();
if(!empty($my)){ ?>
    <div>
        <?php foreach($my as $b){ ?>
            <div>
                <input type="hidden" value="<?= $b['task_id'] ?>">
                <div><?= $date->jdate('Y/m/d H:i',strtotime($b['time'])) ?></div>
                <div><?= $b['status'] ?></div>
                <?php if(!empty($b['info'])){ ?>
                    <input type="hidden" value="<?= $b['info']['id'] ?>">
                    <div><?= $b['info']['title'] ?></div>
                    <div><?= $b['info']['description'] ?></div>
                    <?php if(!empty($b['info']['result'])){ ?>
                        <div><?= $b['info']['result'] ?></div>
                    <?php }else{ ?>
                        <a>add result</a>
                    <?php } ?>
                    <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['time'])) ?></div>
                    <?php if($b['info']['dead_time']){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['dead_time'])) ?></div>
                    <?php } if(!empty($b['info']['run_time'])){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['run_time'])) ?></div>
                    <?php }else{ ?>
                        <a>add run time</a>
                    <?php } if(!empty($b['info']['suggest_time'])){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['suggest_time'])) ?></div>
                    <?php }else{ ?>
                        <a>add suggest time</a>
                    <?php } 
                } ?>
            </div>
        <?php } ?>
    </div>
<?php }
if(!empty($other)){ ?>
    <div>
        <?php foreach($other as $b){ ?>
            <div>
                <input type="hidden" value="<?= $b['task_id'] ?>">
                    <!--request time-->
                <div><?= $date->jdate('Y/m/d H:i',strtotime($b['time'])) ?></div>
                <div><?= $b['status'] ?></div>
                <?php if(!empty($b['info'])){ ?>
                    <input type="hidden" value="<?= $b['info']['id'] ?>">
                    <div><?= $b['info']['title'] ?></div>
                    <div><?= $b['info']['description'] ?></div>
                    <?php if(!empty($b['info']['result'])){ ?>
                        <div><?= $b['info']['result'] ?></div>
                    <?php } ?>
                    <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['time'])) ?></div>
                    <?php if($b['info']['dead_time']){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['dead_time'])) ?></div>
                    <?php }else{ ?>
                        <a>add dead time</a>
                    <?php } if(!empty($b['info']['run_time'])){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['run_time'])) ?></div>
                    <?php } if(!empty($b['info']['suggest_time'])){ ?>
                        <div><?= $date->jdate('Y/m/d H:i',strtotime($b['info']['suggest_time'])) ?></div>
                    <?php }
                } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>