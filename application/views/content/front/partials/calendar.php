<?php
    require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
    require_once Router::$Scripts["Calendar"];
?>
<div id="DateSelector">
    <div class="month">
      <div id="PrevMonth" class="w3-col s1 m1 l1 prev w3-center my-pointer" style="cursor: pointer;">&#10094;</div>
      <div class="w3-col s10 m10 l10 w3-center my-pointer">
        <span id="calendar-monthyear">
            <?php
                echo Calendar::GetMonth(Calendar::GetMonthNumber()).' '.Calendar::GetYear();
            ?>
        </span>
      </div>
      <div id="NextMonth" class="w3-col s1 m1 l1 prev w3-center my-pointer" style="cursor: pointer;">&#10095;</div>
    </div>

    <ul id="calendar-weekdays" class="weekdays w3-center">
        <?php echo Calendar::GenerateWeekdays(); ?>
    </ul>

    <ul id="calendar-days" class="days">
      <?php echo Calendar::GenerateCalendar(6,2017) ?>
    </ul>
</div>

<script>

    //var calendar;
    //if(!calendar)
    //{
        var calendar = new Calendar();

        $('#PrevMonth').on('click',function () {
            calendar.PreviousMonth();
        });
        $('#NextMonth').on('click',function () {
            calendar.NextMonth();
        });
    //}
</script>