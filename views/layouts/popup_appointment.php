<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery_mask.js"></script>
<script type="text/javascript" src="/js/popup_appointment.js"></script>
<div class="popup_appointment">
    <div class="popup_appointment_body">
        <h2 class="popup_appointment_body_header">
            Персональная информация
            <span onclick="destroy()" class="close-btn">X</span>
        </h2>
        <div class="popup_appointment_body_content">
            <div class="Registration-appointment ">
                    <select class="Registration-appointment_departments-list" name="" id="">
                        <option selected value="">Выберите Отделение</option>
                    </select>
                    <select class="Registration-appointment_doctors-list">
                        <option selected value="">Выберите врача</option>
                    </select>
                    <div class="Registration-appointment_choose-time hide">
                        <table>
                            <caption>Дата для записи</caption>
                            <tbody class="table_body">
                                <tr>
                                    <?php
                                        $week = date("w");
                                        $week = $week > 0? $week:7; 
                                        $date = date('d', strtotime('-'.($week-1).' days'));
                                        $days = ['Пн', 'Вт', 'Ср','Чт','Пт','Сб','Вс'];
                                        $Firstday = date('d-m-Y', strtotime('-'.($week-1).' days'));
                                        $d = new DateTime($Firstday);
                                        foreach($days as $key => $item):
                                    ?>
                                        <th><?=($d->format('d')).'-'.$item?></th>
                                    <?php 
                                        $d->modify('+1day');
                                    endforeach;?>
                                </tr>
                                <?php 
                                for($i = 0; $i < 7; $i++): 
                                    $d = new DateTime($Firstday);
                                ?>
                                    <tr>
                                        <?php for($j = 0; $j < 7; $j++): 
                                            $day = $date+$j;
                                        ?>

                                            <td class="CantChoose"><span onclick="chooseTime(this, '1<?=$i?>', '<?=$d->format('d')?>')">1<?=$i?>:00</span></td>
                                        <?php 
                                        $d->modify('+1day');
                                        endfor;?>
                                    </tr>
                                <?php endfor;?>                            
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <div class="popup_appointment_body_buttons">
            <button class="Button" name="Send" type="button">Записаться</button>
        </div>
    </div>
</div>