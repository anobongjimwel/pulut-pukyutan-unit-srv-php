<div class="ui sticky inverted menu" style="position: sticky; top: 0; padding: 0 15px">
    <a href="dashboard.php">
        <div class="item computerOnly">
            <img src="<?php echo $path['whiteLogo'] ?>">
        </div>
    </a>
    <div class="item phoneOnly aligned center" id="left-side-dropdown-phone">
        <img src="<?php echo $path['whiteLogo'] ?>">
    </div>
    <a class="browse item computerOnly" id="left-side-dropdown">
        Pulot-Pukyutan: Unit SN-48X53Z
        <i class="dropdown icon"></i>
    </a>
    <div class="ui right dropdown item" id="right-side-menu">
        Michael Jackson
        <i class="dropdown icon"></i>
        <div class="ui text menu" style="display: none; background-color: #1B1C1D !important">
            <div style='color: white !important' class="item">Profile</div>
            <div style='color: white !important' class="item">Settings</div>
            <div style='color: white !important' class="item"><a href="login.php">Logout</a></div>
        </div>
    </div>
</div>
<div class="ui flowing basic admission popup inverted">
    <div class="ui three column relaxed divided grid">
        <div class="column">
            <h4 class="ui header">Waste Unit</h4>
            <div class="ui inverted link list">
                <a class="item" href="dashboard.php">Dashboard</a>
                <a class="item">Operation Status</a>
                <a class="item" href="statistics.php">Statistics</a>
                <a class="item" href='schedules.php'>Schedules</a>
                <a class="item">Unit Details</a>
            </div>
        </div>
        <div class="column">
            <h4 class="ui header">Database</h4>
            <div class="ui inverted link list">
                <a class="item">Biodegradeable</a>
                <a class="item">Non-biodegradeable</a>
                <a class="item">Unspecifieds</a>
                <a class="item">Export</a>
            </div>

        </div>
        <div class="column">
            <h4 class="ui header">Communication</h4>
            <div class="ui inverted  link list">
                <a class="item" href="messaging.php">Short Message System (SMS)</a>
            </div>
        </div>
    </div>
</div>