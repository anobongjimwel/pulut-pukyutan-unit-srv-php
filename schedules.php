<?php
    include_once 'classes/Scheduler.php';
    $scheduler = new \pulut\Scheduler();
    if (isset($_POST['changeScheds'])) {
        if (isset($_POST['days']) && (is_object($_POST['days']) || is_array($_POST['days']))) {
            $days = array();
            foreach ($_POST['days'] as $selected) {
                array_push($days, $selected);
            }
            $scheduler->changeSchedules($days);
        } else {
            $scheduler->clearSchedules();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Collection Schedules</title>
        <?php include_once 'helpers/gen-inc.php' ?>
    </head>


    <body>
        <?php include_once 'components/header.php' ?>
        <div class="fluid container">
           <font style="color: white; font-size: 30px;">Schedules</font>
                <div class="ui stackable grid">
                    <div class="four wide column">
                        <br />
                        <form method="post" action="schedules.php">
                            <div class="ui toggle checkbox" style="border-radius: 10px 10px 0 0; width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="sunday" <?php echo $scheduler->getIfChecked($scheduler::MONDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="1">
                                <label for="sunday" style="color: white !important">Monday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="monday" <?php echo $scheduler->getIfChecked($scheduler::TUESDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="2">
                                <label for="monday" style="color: white !important">Tuesday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="tuesday" <?php echo $scheduler->getIfChecked($scheduler::WEDNESDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="3">
                                <label for="tuesday" style="color: white !important">Wednesday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="wednesday" <?php echo $scheduler->getIfChecked($scheduler::THURSDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="4">
                                <label for="wednesday"  style="color: white !important">Thursday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="thursday" <?php echo $scheduler->getIfChecked($scheduler::FRIDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="5">
                                <label for="thursday"  style="color: white !important">Friday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="friday" <?php echo $scheduler->getIfChecked($scheduler::SATURDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="6">
                                <label for="friday"  style="color: white !important">Saturday</label>
                            </div>
                            <br />
                            <div class="ui toggle checkbox" style="border-radius: 0 0 10px 10px;width: 100%; background-color: rgba(255, 255, 255, 0.2); padding: 10px;">
                                <input id="saturday" <?php echo $scheduler->getIfChecked($scheduler::SUNDAY) ? 'checked="checked"' : '' ?> type="checkbox" name="days[]" value="7">
                                <label for="saturday"  style="color: white !important">Sunday</label>
                            </div>
                            <br /><br />
                            <button class="ui button rounded blue" name="changeScheds" type="submit">Update Schedules</button>
                        </form>
                        <br /><br />
                        <?php
                            if (isset($_POST['changeScheds'])) {
                                echo "<font style=\"font-size: 20px; color: white\" id=\"msg\">Schedules of collection updated!</font>";
                            }
                        ?>

                    </div>
                    <div class="twelve wide column">
                        <br />
                        <div style="padding: 10px; height: 100%; width: 100%; border-radius: 10px 10px 0 0; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.1))">
                            <font style="font-size: 20px; color: white">Upcoming Schedules of Trash Collection</font>
                            <br /><br />
                            <?php
                                foreach ($scheduler->getTwoWeekLongDates(date('Y-m-d')) as $date) {
                                    if ($scheduler->compareDate($date)) {
                                        echo "<div class=\"ui stackable grid\">";
                                            echo "<div class=\"computerOnly one wide column\" style=\"color: white\">";
                                            echo "<font style=\"font-size: 23px;\">".$scheduler->returnShortMonth($date)."</font>";
                                            echo "<br /><font style=\"font-size: 40px;\">".$scheduler->returnDay($date)."</font>";
                                            echo "</div>";
                                            echo "<div class=\"computerOnly fifteen wide column\" style=\"overflow-x: hidden; color: white\">";
                                            echo "<br />";
                                            echo "<font style=\"white-space: nowrap; font-size: 40px; line-height: 1.2; position: relative; top: -20px;\">".$scheduler->returnLongDateFmt($date)."</font>";
                                            echo "</div>";
                                            echo "<div class=\"phoneOnly column\" style=\"overflow-x: hidden; color: white\">";
                                            echo "<br />";
                                            echo "<font style=\"font-size: 20px;\"><font style='font-size: 40px'>".$scheduler->returnShortMonth($date)." ".$scheduler->returnDay($date)."</font><br /> ".$scheduler->returnLongDateFmt($date)."</font>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php include_once "components/endScript.php" ?>
            </div>
        </div>
    </body>
</html>