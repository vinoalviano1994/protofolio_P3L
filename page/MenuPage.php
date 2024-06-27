<?php
include '../component/userSidebar.php'
?>
<div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px
    solid #0f5a7a; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0,
    0.19);" >
    <div class="body d-flex justify-content-between">
        <h4>MENU LAINNYA</h4>
    </div>
    <div>
        
    </div>
    <hr>
    <table class="table ">
        
        <tbody>
            <?php

                    echo '
                <a href="../process/resetTerlambatInstrukturProcess.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="false">RESET TERLAMBAT INSTRUKTUR</a>
                ';


                
            
            ?>
        </tbody>
    </table>
</div>
</aside>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
</body>
</html>