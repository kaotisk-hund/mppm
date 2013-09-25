<?php
function footnotes(){
    include 'variables.php';
    echo '<footer class="row">
        <div class="large-12 columns">
            <hr />
            <div class="row">
                <div class="large-12 columns">
                    <p>This is MPPM ';
    include 'VERSION';
    echo '</p>
                </div>
            </div>
        </div>
    </footer>';
}
?>