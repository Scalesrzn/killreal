<div class='map'>
    <div class="mapstext">
        <div>
            <span class="text">Как нас найти?</span>
        </div>
        <div class="logo">
            <img  src="../gallery/logo2.jpg" alt="СкладовщикЪ">
        </div>
    </div>
    <div class="maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3615.0637163725296!2d39.72400297065095!3d54.61328841879548!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4149e23d10f85765%3A0x8f8c8c884de2af41!2z0KDRj9C30LDQvdGB0LrQuNC5INCz0L7RgdGD0LTQsNGA0YHRgtCy0LXQvdC90YvQuSDRgNCw0LTQuNC-0YLQtdGF0L3QuNGH0LXRgdC60LjQuSDRg9C90LjQstC10YDRgdC40YLQtdGCICjQoNCT0KDQotCjKQ!5e0!3m2!1sru!2sru!4v1569236646682!5m2!1sru!2sru"   style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>
<div class="timeSys">
        <?php

            $dateTime = date('l jS \of F Y h:i:s A');
            echo '<span>','The Time: ', $dateTime,'     ', 'Info: ' , $_SERVER['SERVER_NAME'], '</span>';
         ?>
</div>